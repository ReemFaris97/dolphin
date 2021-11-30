<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Client;
use App\Models\DailyReport;
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
    public function index()
    {
        $routes = DistributorRoute::whereDate('created_at', Carbon::today())
            ->where('is_active', 1)->count();

        $trips_count = RouteTrips::whereDate('created_at', Carbon::today())->count();

        $refused_count = TripInventory::whereDate('created_at', Carbon::today())->whereType('refuse')->count();

        $daily_reports_count = DailyReport::whereDate('created_at', Carbon::today())->count();

        $total =  RouteTripReport::whereDate('created_at', Carbon::today())->sum('total_money');

        return view('distributor.home', compact('routes','trips_count',
            'refused_count','daily_reports_count','total'));
    }
}
