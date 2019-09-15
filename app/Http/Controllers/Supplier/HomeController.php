<?php

namespace App\Http\Controllers\Supplier;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){



        return view('suppliers.home');
    }
}
