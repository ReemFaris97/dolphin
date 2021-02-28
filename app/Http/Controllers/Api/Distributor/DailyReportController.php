<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\CarsResource;
use App\Http\Resources\Distributor\ProductsResource;
use App\Http\Resources\Distributor\ReportsResource;
use App\Http\Resources\Distributor\SettingResources;
use App\Models\AccountingSystem\AccountingSetting;
use App\Models\DistributorRoute;
use App\Models\RouteTripReport;
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
    use ApiResponses,DailyReportOperation;


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
            ->addSelect(DB::raw("sum(cash) as total_cash"))
            ->addSelect(DB::raw("sum(expenses) as total_expenses"))
            ->addSelect(DB::raw("sum(products_price) as total_products_price"));
        return $this->apiResponse(new ReportsResource($report->latest()->paginate($this->paginateNumber)));
    }

    public function productReport(Request $request)
    {
        $report = RouteTripReport::ofDistributor(auth()->id())->groupBy(DB::raw('Date(created_at)'))->withProductsPrice();

        if (request('from') != null && \request('to')) {
            $from = Carbon::parse(\request('from'));
            $to = Carbon::parse(\request('to'));

            $report = $report->whereBetween('created_at', [$from, $to]);
        }
        if (request()->route_trip_id !=null) {
            $report = $report->whereBetween('route_trip_id', $request->route_trip_id);
        }
        $report = $report
            ->select('*')
             ->addSelect(DB::raw("sum(cash) as total_cash"))
             ->addSelect(DB::raw("sum(expenses) as total_expenses"))
             ->addSelect(DB::raw("sum(products_price) as total_products_price"));
        //  ->addSelect(DB::raw("sum(products_price) as total_products_price"));
        return $report->latest()->paginate($this->paginateNumber);
    }
    public function store(Request $request)
    {
        $request['products'] = json_decode($request->products, true);
        $rules = [
            'cash'=>'nullable|numeric',
            'expenses'=>'nullable|numeric',
            'image'=>'required',
            'store_id' => 'required|integer|exists:stores,id',
            'products'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
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
