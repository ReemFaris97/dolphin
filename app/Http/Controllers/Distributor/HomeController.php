<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Client;
use App\Models\DistributorCar;
use App\Models\DistributorRoute;
use App\Models\Product;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\Store;
use App\Models\TripInventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
       $routes =DistributorRoute::whereDate('created_at',Carbon::today())->where('is_active',1)->pluck('round','id')->toArray();

        $trips_all_count=0;
        $trips_refused_count=0;
        $trips_accept_count=0;
       foreach ($routes as $key=>$round){
           $trips_count=RouteTrips::where('route_id',$key)->where('round',$round)->count();
           $trips_all_count +=$trips_count;
           $trips=RouteTrips::where('route_id',$key)->where('round',$round)->pluck('id');
            $trips_refused=TripInventory::whereIn('trip_id',$trips)->where('type','refuse')->count();
           $trips_refused_count+= $trips_refused;
           $trips_accept=TripInventory::whereIn('trip_id',$trips)->where('type','accept')->count();
           $trips_accept_count+= $trips_accept;
       }
        $data = [
            'trips_all_count'=>$trips_all_count,
            'trips_count'=>$trips_accept_count,
            'trips_refused_count'=>$trips_refused_count,
            'routes_count'=>DistributorRoute::whereDate('created_at',Carbon::today())->where('is_active',1)->count(),
            'routes_finished_count'=>DistributorRoute::whereDate('created_at',Carbon::today())->where('is_finished',1)->count(),
            'routes_not_finished_count'=>DistributorRoute::whereDate('created_at',Carbon::today())->where('is_finished',0)->count(),
            'sales_total'=>RouteTripReport::whereDate('created_at',Carbon::today())->sum('cash'),
        ];
        return view('distributor.home',compact('data'));
    }
}
