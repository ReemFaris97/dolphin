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
use Carbon\Carbon;
use DB;

class SellingMovementController extends Controller
{
    public function __construct()
    {
        view()->share(
            "distributors",
            User::query()
                ->where("is_distributor", "1")
                ->pluck("name", "id")
        );
    }
    public function index(Request $request)
    {
        return view("distributor.reports.selling_movement_report.index");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request)
    {
        $this->validate($request, ["day" => "required"]);
        /* 53 */
        $trips = TripInventory::select("*")
            ->withReportProducts()
            ->WithPreviousTripInventory()
            ->WithPreviousTripReport()
            ->withTripClientAndRoute()
            ->with([
                "products",
                "previous_trip_report",
                "previous_trip_inventory",
            ])
            ->FilterRoute($request->route_id)
            ->filterDistributor($request->distributor_id)
            ->filterWithDates($request->date_from, $request->date_to)
            ->whereDate("created_at", Carbon::parse($request->day))
            // dd($request->day);
            ->get();

        $products = $trips->pluck("product_items")->flatten(1);
        return view(
            "distributor.reports.selling_movement_report.show",
            compact("trips", "products")
        );
    }
}
