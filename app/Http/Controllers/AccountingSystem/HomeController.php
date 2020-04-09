<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Http\Controllers\Controller;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingProduct;

use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingBranch as Branch;

use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingSupplier;
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

    public function getstores($id)
    {
        $branch=AccountingBranch::find($id);

        $stores_branch = AccountingStore::select(['id', 'ar_name'])->where('model_id', $id)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->get();
        $stores_company = AccountingStore::select(['id', 'ar_name'])->where('model_id', $branch->company_id)->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->get();
        $_stores_branch= json_encode($stores_branch);
        $_stores_company= json_encode($stores_company);
        $stores=array_merge(json_decode($_stores_branch),json_decode($_stores_company));

        return response()->json($stores);
    }

    public  function getProductStore($id)
    {
        $store_products = AccountingProductStore::select(['id', 'product_id'])->where('store_id', $id)->get();
        $products = AccountingProduct::whereIn('id', $store_products)->select(['id', 'name'])->get();
        return response()->json($products);
    }
    public function getUsersByBranch($branch_id)
    {
    	$branch = Branch::findOrFail($branch_id);
    	$stores = $branch->stores()->get()->pluck('id')->toArray();
    	$safes = $branch->safes;
        $users = User::select(['id', 'name'])->whereIn('accounting_store_id', $stores)->get();
        $shifts = AccountingBranchShift::where('branch_id', $branch_id)->get();
        $suppliers = AccountingSupplier::where('branch_id', $branch_id)->get();
    	return response()->json(['users' => $users, 'safes' => $safes, 'shifts' => $shifts, 'suppliers' => $suppliers]);
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

    public function getSuppliers($id)
    {
        $suppliers = AccountingSupplier::where('branch_id', $id)->get();
        return response()->json($suppliers);
    }
}
