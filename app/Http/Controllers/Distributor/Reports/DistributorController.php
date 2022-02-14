<?php

namespace App\Http\Controllers\Distributor\Reports;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DistributorRoute;
use App\Models\ProductQuantity;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\TripInventory;
use App\Models\User;

class DistributorController extends Controller
{
    public function __construct()
    {
        view()->share(
            "distributors",
            User::query()
                ->distributor()
                ->pluck("name", "id")
        );
    }
    public function index(Request $request)
    {
        return view("distributor.reports.distributors.index");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request)
    {
        $this->validate($request, [
            "distributor_id" => "required|integer|exists:users,id",
        ]);
        $trips_during_the_period = RouteTripReport::with([
            "distributor_transaction",
            "products",
        ])
            ->filterDistributor($request->distributor_id)
            ->ofYear($request->year)
            ->ofMonth($request->month)
            ->get();
        //trips statistics
        $roundsGroups = $trips_during_the_period->groupBy("round");
        $rounds_count = $roundsGroups->count();
        $routesGroups = $trips_during_the_period->groupBy(
            "route_trip.route_id"
        );
        $trips_counts = RouteTrips::whereIn(
            "route_id",
            $routesGroups->keys()
        )->count();
        $trips_counts_during_to_rounds = $trips_counts * $roundsGroups->count();
        $total_trips = TripInventory::whereIn(
            "round",
            $roundsGroups->keys()
        )->get();
        $total_trips_count = $total_trips->count();
        $accepted_trips_count = $total_trips->where("type", "accept")->count();
        $refused_trips_count = $total_trips->where("type", "refuse")->count();
        $total_routes_during_to_rounds_count =
            $trips_counts * $roundsGroups->count();
        $finishing_percentage =
            ($total_trips->count() /
                ($total_routes_during_to_rounds_count ?: 1)) *
            100;
        //end trips statistics

        //products statistics
        $products = $trips_during_the_period->pluck("products")->flatten();
        $products_group = $products->groupBy("product_id");
        $products_count = $products_group->count();

        $products_with_total_quantity = $products_group->map(function (
            $product_sells
        ) {
            $product = $product_sells->first()->product;
            return [
                "name" => $product->name,
                "bar_code" => $product->bar_code,
                "quantity" => $product_sells->sum("quantity"),
            ];
        });

        // end products statistics

        $total_cash = $trips_during_the_period->sum("cash");
        $trips_per_month = $trips_during_the_period->groupBy(function (
            $trips_during_period
        ) {
            return $trips_during_period->created_at->format("Y-m");
        });

        //cash and affiliate;
        $distributor = User::query()
            ->distributor()
            ->findOrFail($request->distributor_id);

        $total_per_month = $trips_per_month->map(function (
            $month_trips,
            $month
        ) use ($distributor) {
            $total_cash_per_month = $month_trips->sum("cash");
            $affiliate = 0;
            if ($total_cash_per_month >= $distributor->target) {
                $affiliate = $total_cash_per_month * $distributor->affiliate;
            }
            return [
                "month" => $month,
                "cash" => $total_cash_per_month,
                "affiliate" => $affiliate,
            ];
        });

        $total_affiliate = $total_per_month->sum("affiliate");

        return view("distributor.reports.distributors.show", [
            "rounds_count" => $rounds_count,
            "trips_counts" => $trips_counts,
            "total_trips_count" => $total_trips_count,
            "total_routes_during_to_rounds_count" => $total_routes_during_to_rounds_count,
            "trips_counts_during_to_rounds" => $trips_counts_during_to_rounds,
            "accepted_trips_count" => $accepted_trips_count,
            "refused_trips_count" => $refused_trips_count,
            "finishing_percentage" => $finishing_percentage,
            "products" => $products_with_total_quantity,
            "products_count" => $products_count,
            "cash" => $total_cash,
            "affiliate" => $total_affiliate,
        ]);
    }
}
