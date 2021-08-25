<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\CarsResource;
use App\Http\Resources\Distributor\ProductsResource;
use App\Http\Resources\Distributor\ReportsResource;
use App\Http\Resources\Distributor\SettingResources;
use App\Models\AccountingSystem\AccountingSetting;
use App\Models\DistributorRoute;
use App\Models\Expense;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DailyReportOperation;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;

class DailyReportController extends Controller
{
    use ApiResponses, DailyReportOperation;

    public function reports()
    {
        $report = RouteTripReport::ofDistributor(auth()->id())->groupBy(DB::raw('Date(created_at)'))->withProductsPrice();

        if (request('from') != null && \request('to')) {
            $from = Carbon::parse(\request('from'));
            $to = Carbon::parse(\request('to'));

            $report = $report->whereBetween('created_at', [$from, $to]);
        }
        $report = $report
            ->select('*')
            ->addSelect(DB::raw('sum(cash) as total_cash'))
            ->addSelect(DB::raw('sum(expenses) as total_expenses'))
            ->addSelect(DB::raw('sum(products_price) as total_products_price'));
        return $this->apiResponse(new ReportsResource($report->latest()->paginate($this->paginateNumber)));
    }

    public function productReport(Request $request)
    {
        $date = Carbon::parse($request->date);
        $report = RouteTripReport::query()
            ->ofDistributor(auth()->id())
            ->whereDate('route_trip_reports.created_at', $date)
            ->groupBy('product_id')
            ->withProductsPrice()
            ->selectRaw('
            sum(`total_quantity`)  as total_quantity,
            `price`,
            `product_id`,
            sum(`products_price`) as products_price ')
            ->addSelect(DB::raw('sum(cash) as total_cash'))
            ->addSelect(DB::raw('sum(visa) as total_visa'))
            ->addSelect(DB::raw('sum(total_money) as total_money'))
            ->addSelect(DB::raw('(select name from products where products.id = product_id limit 1 ) as product_name'))
            ->latest()->get();

        $expenses = Expense::whereDate('date', $date)->sum('amount');

        if (request('from') != null && \request('to')) {
            $from = Carbon::parse(\request('from'));
            $to = Carbon::parse(\request('to'));

            $report = $report->whereBetween('created_at', [$from, $to]);
        }
        $expenses = 0;
        if (request()->route_trip_report_id != null) {
            $report = $report->where('route_trip_reports.id', $request->route_trip_report_id);
            $route_trip = RouteTrips::with('reports')->whereHas('reports', function ($q) use ($request) {
                $q->where('id', $request->route_trip_report_id);
            })->first();
            $expenses = Expense::where('round', $route_trip->reports->first()->round)->where('distributor_route_id', $route_trip->route_id)->sum('amount');
        }

        $tax = AccountingSetting::find(82)->value;
        $report =   $report->map(function ($report) use ($tax) {
            $report['products_price'] = number_format(($report['products_price'] + ($report['products_price'] * ($tax / 100))), 4);

            return $report;
        });
        return $this->apiResponse([
            'reports' => $report,
            'products_price' => (string) $report->sum('products_price'),
            'total_cash' => (string) $report->sum('total_cash'),
            'total_visa' => (string) $report->sum('total_visa'),
            'total_money' => (string) $report->sum('total_money'),
            'total_remaining' =>  (string) (number_format($report->sum('products_price') - $report->sum('total_money'),4)),
            'total_quantities' => (string) ($report->sum('products_price') - $expenses),
            'total_expenses' => (string) $expenses
        ]);
    }

    public function store(Request $request)
    {
        $request['products'] = json_decode($request->products, true);
        $rules = [
            'cash' => 'nullable|numeric',
            'expenses' => 'nullable|numeric',
            'image' => 'required',
            'store_id' => 'required|integer|exists:stores,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer',
        ];
        $validation = $this->apiValidation($request, $rules);

        if ($validation instanceof Response) {
            return $validation;
        }
        $request['user_id'] = auth()->user()->id;
        $this->RegisterDailyReport($request);
        return $this->apiResponse('تم ملأ التقرير بنجاح');
    }
}
