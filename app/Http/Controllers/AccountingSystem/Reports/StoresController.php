<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingDamage;
use App\Models\AccountingSystem\AccountingDamageProduct;
use App\Models\AccountingSystem\AccountingInventoryProduct;
use App\Models\AccountingSystem\AccountingStore;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
;

class StoresController extends Controller
{
    
    public function damages()
   	{
   		$damages = AccountingDamageProduct::all()->reverse();
   		return view('AccountingSystem.reports.stores.damagedProducts', compact('damages'));
   	}


    public function damages_filter()
    {
        if (\request('company_id')) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches=AccountingBranch::where('company_id',\request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores=array_merge(json_decode($stores_branch),json_decode($stores_company));
            $damages=AccountingDamage::whereIn('store_id',$stores)->products()->get();
dd($damages);
        }




        return view('AccountingSystem.reports.stores.damagedProducts', compact('damages'));
    }


    public function inventory()
    {
        $inventories = AccountingInventoryProduct::all()->reverse();
        return view('AccountingSystem.reports.stores.inventoryProducts', compact('inventories'));
    }
}
