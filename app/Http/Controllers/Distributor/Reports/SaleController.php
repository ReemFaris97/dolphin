<?php

namespace App\Http\Controllers\Distributor\Reports;

use App\Models\TripInventory;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttachedProducts;
use App\Models\Client;
use App\Models\DistributorRoute;
use App\Models\DistributorSale;
use App\Models\DistributorTransaction;
use App\Models\Product;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\User;

class SaleController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor', '1')->pluck('name', 'id'));
        view()->share('clients', Client::query()->pluck('name', 'id'));
        view()->share('routes', DistributorRoute::query()->pluck('name', 'id'));
        view()->share('products', Product::query()->pluck('name', 'id'));
    }
    public function index(Request $request)
    {
        $sales=    DistributorSale::query();

        if ($request->has('user_id') && $request->user_id != null) {
            $sales = $sales->where('distributor_id', $request->user_id);
        }
        if ($request->has('client_id') && $request->client_id != null) {
            $sales = $sales->where('client_id', $request->client_id);
        }
        if ($request->input('from')!=null && $request->input('to')!=null) {
            $sales = $sales->whereBetween('created_at', [$request->from,$request->to]);
        }

        $sales=$sales->groupBy('distributor_id')->groupBy('product_id')
            ->groupBy('name')
            ->selectRaw('name,product_id,sum(price) as price,sum(quantity) as quantity')
            ->get()
            ->groupBy('distributor_id');
        $sales_distributors=User::where('is_distributor', 1)
                ->when(
                    $request->user_id != null,
                    fn ($builder) =>$builder->where('id', $request->user_id)
                )
                ->whereNotIn('id', $sales->keys())
                ->get(['id', 'name']);



        TripInventory::query()
                ->filterDistributor($request->user_id)
                ->fitlerClient($request->client_id)
                ->filterRoute($request->route_id)
                ->filterProduct($request->product_id)
                ->FilterWithDates($request->from, $request->to)
                ->get();

        return view('distributor.reports.sales.index', compact('sales', 'sales_distributors'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request, $id)
    {
        $bill=RouteTripReport::with([
            'inventory',
            'route_trip' => function ($builder) {
                $builder->with(['route' => function ($q) {
                    $q->with('user');
                }, 'client']);
            },
        ])->findOrFail($id);

        return view('distributor.reports.sales.show', compact('bill'));
    }
}
