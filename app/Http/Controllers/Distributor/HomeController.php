<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Client;
use App\Models\DistributorCar;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $data = [
            'distributors_count'=>User::whereIsDistributor(1)->count(),
            'clients_count'=>Client::all()->count(),
            'stores_count'=>Store::all()->count(),
            'products_count'=>Product::all()->count(),
            'cars_count'=>DistributorCar::all()->count(),
        ];
        return view('distributor.home',compact('data'));
    }
}
