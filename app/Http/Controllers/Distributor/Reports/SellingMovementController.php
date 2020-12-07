<?php

namespace App\Http\Controllers\Distributor\Reports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttachedProducts;
use App\Models\Client;
use App\Models\DistributorTransaction;
use App\Models\RouteTrips;
use App\Models\TripInventory;
use App\Models\User;

class SellingMovementController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor', '1')->pluck('name', 'id'));
    }
    public function index(Request $request)
    {
        return view('distributor.reports.selling_movement_report.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request)
    {

        $trips_status = TripInventory::with('trip_report')->FilterRoute($request->route_id)->filterDistributor($request->distributor_id)->filterWithDates($request->date_from, $request->date_to)->get();

        dd($trips_status);
        return view('distributor.reports.selling_movement_report.show', compact('bill'));
    }
}
