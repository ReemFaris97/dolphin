<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingBranch;

class HomeController extends Controller
{
    public function index(){



        return view('AccountingSystem.home');
    }

    public function getBranches($id)
    {
    	$branches = AccountingBranch::select(['id', 'name'])->where('company_id', $id)->get();
    	return response()->json($branches);
    }
}
