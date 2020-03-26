<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingDamage;
use App\Models\AccountingSystem\AccountingDamageProduct;
use App\Models\AccountingSystem\AccountingInventory;
use App\Models\AccountingSystem\AccountingInventoryProduct;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSaleItem;
use App\Models\AccountingSystem\AccountingSroreRequest;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingTransaction;
use Carbon\Carbon;
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
        $expire_products=[];
        //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $expire=new Carbon($product->expired_at);
                if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
                    $product_store=AccountingProductStore::find($item);
                    array_push($expire_products, $product_store);
                }
            }

        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {

            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $expire=$product->expired_at;
                $expire=new Carbon($product->expired_at);
                if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
                    $product_store=AccountingProductStore::find($item);
                    array_push($expire_products, $product_store);
                }
            }
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $product_quantity = AccountingProductStore::whereIn('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $expire=new Carbon($product->expired_at);
                if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
                    $product_store=AccountingProductStore::find($item);
                    array_push($expire_products, $product_store);
                }
            }
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $product = AccountingProduct::find(\request('product_id'));
            $expire=new Carbon($product->expired_at);
            if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
                $product_store=AccountingProductStore::where('store_id', \request('store_id'))->where('product_id', \request('product_id'))->first();

                array_push($expire_products, $product_store);
            }
        }
        else{
            $expire_products=[];
        }
        return view('AccountingSystem.reports.stores.expiredProducts', compact('expire_products'));
    }


    public function stagnants()
    {
        $from = request('from');
        $to = request('to');
        $stagnant_sales = [];
        //company_only
        if (\request('company_id') != Null && \request('branch_id') == Null && \request('store_id') == Null && \request('product_id') == Null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('store_id', 'product_id');

            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                    ->whereHas('sale', function ($query) use ($stores, $from, $to) {
                        $query->whereIn('store_id', $stores)->
                        whereBetween('created_at', [$from, $to]);

                    })->latest()->limit(1)->first();
                if ($last_item){
                    $date = new Carbon($last_item->created_at);
                    if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                        array_push($stagnant_sales, $last_item);
                    }
                }

            }
        } //company_and_branch_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') == Null && \request('product_id') == Null) {

            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                    ->whereHas('sale', function ($query) use ($stores, $from, $to) {
                        $query->whereIn('store_id', $stores)->
                        whereBetween('created_at', [$from, $to]);
                    })->latest()->limit(1)->first();
                if ($last_item){
                    $date = new Carbon($last_item->created_at);
                    if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                        array_push($stagnant_sales, $last_item);
                    }
                }
            }
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') == Null) {
            $product_quantity = AccountingProductStore::whereIn('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('quantity', 'product_id');
            $store_id = \request('store_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                    ->whereHas('sale', function ($query) use ($store_id, $from, $to) {
                        $query->where('store_id', $store_id)->
                        whereBetween('created_at', [$from, $to]);
                    })->latest()->limit(1)->first();

                if ($last_item){
                    $date = new Carbon($last_item->created_at);
                    if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                        array_push($stagnant_sales, $last_item);
                    }
                }
            }
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null) {
            $store_id = \request('store_id');
            $product = AccountingProduct::find(\request('product_id'));
            $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                ->whereHas('sale', function ($query) use ($store_id, $from, $to) {
                    $query->where('store_id', $store_id)->
                    whereBetween('created_at', [$from, $to]);
                })->latest()->limit(1)->first();
            if ($last_item){
                $date = new Carbon($last_item->created_at);
                if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                    array_push($stagnant_sales, $last_item);
                }
            }

        } else {
            $stagnant_sales = [];
        }

        return view('AccountingSystem.reports.stores.stagnantProducts', compact('stagnant_sales'));
    }




    public function movements()
    {
        $from = request('from');
        $to = request('to');
//        dd(request()->all());
        $requests=request()->all();
        //purchases
       if (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null && \request('type') == 'purchases') {
           $product = AccountingProduct::find(\request('product_id'));
           $store_id = \request('store_id');
           $purchases = AccountingPurchaseItem::where('product_id', '=', $product->id)
               ->whereHas('purchase', function ($query) use ($store_id, $from, $to) {
                   $query->where('store_id',$store_id);
               })->get();

        }elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null && \request('type') == 'sales') {
           $product = AccountingProduct::find(\request('product_id'));
           $store_id = \request('store_id');
           $sales= AccountingSaleItem::where('product_id', '=', $product->id)
               ->whereHas('sale', function ($query) use ($store_id, $from, $to) {
                   $query->where('store_id',$store_id);
               })->get();

       }elseif (\request('company_id') != Null && \request('branch_id') != Null && \request('store_id') != Null && \request('product_id') != Null && \request('type') == 'damaged') {
        $product = AccountingProduct::find(\request('product_id'));
        $store_id = \request('store_id');
        $damages = AccountingDamageProduct::where('product_id', '=', $product->id)
            ->whereHas('damage', function ($query) use ($store_id, $from, $to) {
                $query->where('store_id',$store_id);
            })->get();
    }

        else{
            $purchases=[];
            $sales=[];
            $damages=[];
        }

        return view('AccountingSystem.reports.stores.movementProducts', compact('purchases','requests','sales','damages'));
    }


}
