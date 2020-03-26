<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingBranch as Branch;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingSession;
use App\User;

class HomeController extends Controller
{
    public function index(){



        return view('AccountingSystem.home');
    }

    public function getBranches($id)
    {
    	$branches = Branch::select(['id', 'name'])->where('company_id', $id)->get();
    	return response()->json($branches);
    }

    public function getUsersByBranch($branch_id)
    {
    	$branch = Branch::findOrFail($branch_id);
    	$stores = $branch->stores()->get()->pluck('id')->toArray();
    	$safes = $branch->safes;
        $users = User::select(['id', 'name'])->whereIn('accounting_store_id', $stores)->get();
        $shifts = AccountingBranchShift::where('branch_id', $branch_id)->get();
    	return response()->json(['users' => $users, 'safes' => $safes, 'shifts' => $shifts]);
    }

    public function getProducts($id)
    {
    	$products = AccountingProduct::where('category_id', $id)->get();
    	return response()->json($products);
    }

    public function getSessions($id)
    {
        $sessions = AccountingSession::where('shift_id', $id)->get();
    	return response()->json($sessions);
    }
}
