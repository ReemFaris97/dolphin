<?php

namespace App\Http\Controllers\Distributor\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\DistributorRoute;
use App\Models\DistributorRouteReport;
use App\Models\User;
use Route;

class RouteController extends Controller
{
    public function __construct()
    {
        view()->share(
            "distributors",
            User::query()
                ->where("is_distributor", "1")
                ->pluck("name", "id")
        );
        view()->share("clients", Client::query()->pluck("name", "id"));
    }
    public function index(Request $request)
    {
        $query = DistributorRouteReport::query();
        if ($request->has("user_id") && $request->user_id != null) {
            $query = $query->where("user_id", $request->user_id);
        }

        if (
            $request->has("from") &&
            $request->has("to") &&
            $request->to != null &&
            $request->from != null
        ) {
            $query = $query->whereBetween("start_at", [
                $request->from,
                $request->to,
            ]);
        }
        $routes = $query->orderBy("start_at", "desc")->get();
        // dd($routes);
        return view("distributor.reports.routes.index", compact("routes"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request, $id)
    {
        $route = DistributorRoute::find($id);

        return view("distributor.reports.routes.show", compact("route"));
    }
}
