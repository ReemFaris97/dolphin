<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){



        return view('AccountingSystem.home');
    }
}
