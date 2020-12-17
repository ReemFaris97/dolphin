<?php

namespace App\Http\Controllers\Distributor\Reports;


use App\Models\RouteReport;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\TripInventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DistributorRoute;
use App\Models\User;
use Route;

class DistributorMovementController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor','1')->pluck('name', 'id'));


    }
    public function index(Request $request)
    {

        $query = RouteReport::query();
        if($request->has('user_id') && $request->user_id != null){
             $query = $query->where('user_id',$request->user_id);
        }
        if($request->has('from') && $request->has('to')  && $request->to != null  && $request->from != null){
            $query = $query->whereBetween('created_at',[$request->from,$request->to]);
        }
        $routes=$query->orderBy('created_at')->get();

        return view('distributor.reports.distributor_movements.index',compact('routes'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request,$id)
    {
        $route=RouteReport::find($id);
        $trips=TripInventory::with('trip')->whereRouteId($id)
            ->where('round',$route->round)->get();

        return view('distributor.reports.distributor_movements.show',compact('trips'));
    }
}
