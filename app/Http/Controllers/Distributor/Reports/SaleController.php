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
use App\Models\DistributorTransaction;
use App\Models\Product;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\User;

class SaleController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor','1')->pluck('name', 'id'));
        view()->share('clients', Client::query()->pluck('name', 'id'));
        view()->share('routes', DistributorRoute::query()->pluck('name', 'id'));
        view()->share('products', Product::query()->pluck('name', 'id'));

    }
    public function index(Request $request)
    {
        $query = RouteTripReport::query();
        if($request->has('user_id') && $request->user_id != null){
            $query = $query->OfDistributor($request->user_id);
        }
        if($request->has('client_id') && $request->client_id != null){
            $query = $query->OfClient($request->client_id);
        }
        if($request->has('from') && $request->has('to')){
            $query = $query->whereBetween('created_at',[$request->from,$request->to]);
        }
        $transactions=$query->orderBy('created_at')->get();

        if($request->has('from') && $request->has('to')) {
        $period = CarbonPeriod::create($request->from, $request->to);
          $day_count=  $period->count();
            $total_trips_count_all=0;
               $accepted_trips_count_all=0;
               $refused_trips_count_all=0;
               $trips_cash_all=0;
           foreach ( $period->toArray() as  $day){
            $trips_during_the_period = RouteTripReport::whereDate('created_at',$day->format('Y-m-d'))->get();
            $roundsGroups = $trips_during_the_period->groupBy('round');
            $routesGroups = $trips_during_the_period->groupBy('route_trip.route_id');
            $trips_counts = RouteTrips::whereIn('route_id', $routesGroups->keys())->count();
            $trips_counts_during_to_rounds =
                $trips_counts * $roundsGroups->count();
            $total_trips = TripInventory::whereIn('round', $roundsGroups->keys())->get();
            $total_trips_count = $total_trips->count();
            $accepted_trips_count = $total_trips->where('type', 'accept')->count();
            $refused_trips_count = $total_trips->where('type', 'refuse')->count();
           $trips_cash = $trips_during_the_period->sum('cash');
            $data[$day->format('Y-m-d')]=[
                'day'=>$day->format('m-d'),
                'total_trips'=>$total_trips_count,
                'accepted_trips'=>$accepted_trips_count,
                'refused_trips'=>$refused_trips_count,
                'trips_cash'=>$trips_cash
                ];

               $total_trips_count_all +=$total_trips_count;
               $accepted_trips_count_all +=$accepted_trips_count;
               $refused_trips_count_all +=$refused_trips_count;
               $trips_cash_all +=$trips_cash;
        }
            $dataAll=[
                'total_trips'=>$total_trips_count_all,
                'accepted_trips'=>$accepted_trips_count_all,
                'refused_trips'=>$refused_trips_count_all,
                'trips_cash'=>$trips_cash_all,
            ];

         }
 else{
            $data=[];
            $dataAll=['total_trips'=>0,'refused_trips'=>0,'trips_cash'=>0];
            $day_count=0;
        }
//
        return view('distributor.reports.sales.index',compact('transactions','data','day_count','dataAll'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request,$id)
    {
      $bill=RouteTripReport::with([
            'inventory',
            'route_trip' => function ($builder) {
                $builder->with(['route' => function ($q) {
                    $q->with('user');
                }, 'client']);
            },
        ])->findOrFail($id);

     return view('distributor.reports.sales.show',compact('bill'));
    }


}
