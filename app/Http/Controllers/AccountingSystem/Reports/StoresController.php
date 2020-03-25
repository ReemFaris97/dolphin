<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingDamage;
use App\Models\AccountingSystem\AccountingDamageProduct;
use App\Models\AccountingSystem\AccountingInventory;
use App\Models\AccountingSystem\AccountingInventoryProduct;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingSroreRequest;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingTransaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
;

class StoresController extends Controller
{
    


    public function damages()
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
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->paginate(10);
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $damages_id = AccountingDamage::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->paginate(10);
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $damages_id = AccountingDamage::where('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->paginate(10);
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $damages = AccountingDamageProduct::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->paginate(10);

        }else{
            $damages=[];
        }

//
//       dd($damages);


        return view('AccountingSystem.reports.stores.damagedProducts', compact('damages'));
    }



    public function inventory()
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
            $inventories = AccountingInventoryProduct::whereIn('inventory_id', $inventory_id)->paginate(10);
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $inventory_id = AccountingInventory::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('inventory_id', $inventory_id)->paginate(10);
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $inventory_id = AccountingInventory::where('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('inventory_id', $inventory_id)->paginate(10);
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $inventories = AccountingInventoryProduct::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->paginate(10);
        }
        else{
            $inventories=[];
        }

        return view('AccountingSystem.reports.stores.InventoryProducts', compact('inventories'));
    }


    public function transactions()
    {
        $from = request('from');
        $to = request('to');
        //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $request_id = AccountingSroreRequest::whereIn('store_form', $stores)->orWhereIn('store_to', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $transactions = AccountingTransaction::whereIn('request_id', $request_id)->paginate(10);
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $request_id = AccountingSroreRequest::whereIn('store_form', $stores)->orWhereIn('store_to', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $transactions = AccountingTransaction::whereIn('request_id', $request_id)->paginate(10);
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $request_id = AccountingSroreRequest::where('store_form', \request('store_id'))->orwhere('store_to', \request('store_id'))->orWhere('store_to', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $transactions = AccountingTransaction::whereIn('request_id', $request_id)->paginate(10);

        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $transactions = AccountingTransaction::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->paginate(10);
        }
        else{
            $transactions=[];
        }

        return view('AccountingSystem.reports.stores.transactionProducts', compact('transactions'));
    }


    public function deficiency()
    {
        $from = request('from');
        $to = request('to');
        $deficiencies=[];
        //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if ($product->min_quantity >= $item) {
                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {

            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if ($product->min_quantity >= $item) {
                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $product_quantity = AccountingProductStore::whereIn('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if ($product->min_quantity >= $item) {
                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $product = AccountingProduct::find(\request('product_id'));
            if ($product->min_quantity >= $product->quantity) {
                array_push($deficiencies, $product);
            }
        }
        else{
            $deficiencies=[];
        }

        return view('AccountingSystem.reports.stores.deficiencyProducts', compact('deficiencies'));
    }







    public function expirations()
    {
        $from = request('from');
        $to = request('to');
        $deficiencies=[];
        //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if ($product->expired_at >= $item) {
//                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {

            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if ($product->min_quantity >= $item) {
                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $product_quantity = AccountingProductStore::whereIn('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if ($product->min_quantity >= $item) {
                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $product = AccountingProduct::find(\request('product_id'));
            if ($product->min_quantity >= $product->quantity) {
                array_push($deficiencies, $product);
            }
        }
        else{
            $deficiencies=[];
        }
        return view('AccountingSystem.reports.stores.InventoryProducts', compact('inventories'));
    }




}
