<?php

namespace App\Http\Controllers\Distributor\Reports;


use App\Models\RouteTripReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttachedProducts;
use App\Models\Client;
use App\Models\DistributorTransaction;
use App\Models\RouteTrips;
use App\Models\User;

class ClientController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor','1')->pluck('name', 'id'));
        view()->share('clients', Client::query()->pluck('name', 'id'));
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
        return view('distributor.reports.clients.index',compact('transactions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request,$id)
    {
        //        $routetrip=AttachedProducts::where('transaction_id',$id)->where('model_type','App\Models\RouteTrips')->first();
        //        $transaction=DistributorTransaction::find($id);
        $bill = RouteTripReport::find($id);
        dd($bill);
        return view('distributor.reports.clients.show',compact('bill'));


    }






}
