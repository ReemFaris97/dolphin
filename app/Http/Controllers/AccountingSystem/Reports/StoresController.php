<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingDamage;
use App\Models\AccountingSystem\AccountingDamageProduct;
use App\Models\AccountingSystem\AccountingInventory;
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
   		return view('AccountingSystem.reports.stores.damagedProducts',compact('damages'));
   	}


    public function damages_filter()
    {
        $from = request('from');
        $to = request('to');
         //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $damages_id = AccountingDamage::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->get();
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $damages_id = AccountingDamage::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->get();
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $damages_id = AccountingDamage::where('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->get();
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $damages = AccountingDamageProduct::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->get();

        }

//
//       dd($damages);


        return view('AccountingSystem.reports.stores.damagedProducts', compact('damages'));
    }


    public function inventory()
    {
        $inventories = AccountingInventoryProduct::paginate(10);
        return view('AccountingSystem.reports.stores.InventoryProducts', compact('inventories'));
    }

    public function inventory_filter()
    {
        $from = request('from');
        $to = request('to');
        //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $inventory_id = AccountingInventory::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('damage_id', $inventory_id)->paginate(10);
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $inventory_id = AccountingInventory::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('damage_id', $inventory_id)->paginate(10);
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $inventory_id = AccountingInventory::where('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('damage_id', $inventory_id)->paginate(10);
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $inventories = AccountingInventoryProduct::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->paginate(10);
        }

        return view('AccountingSystem.reports.stores.InventoryProducts', compact('inventories'));
    }
}
