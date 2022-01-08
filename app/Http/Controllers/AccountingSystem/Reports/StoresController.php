<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;
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
        $requests=request()->all();

        $from = request('from');
        $to = request('to');
        //company_only
        if (\request('company_id') != null && \request('branch_id') == null && \request('store_id') == null && \request('product_id') == null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
//            dd($stores);
            $damages_id = AccountingDamage::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->get();
        } //company_and_branch_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') == null && \request('product_id') == null) {
            $stores = AccountingStore::where('model_id', 1)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $damages_id = AccountingDamage::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->get();
        }

        //company_and_branch_and_store_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') == null) {
            $damages_id = AccountingDamage::where('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $damages = AccountingDamageProduct::whereIn('damage_id', $damages_id)->get();
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') != null) {
            $damages = AccountingDamageProduct::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->get();
        } else {
            $damages=[];
        }


        return view('AccountingSystem.reports.stores.damagedProducts', compact('damages', 'requests'));
    }



    public function inventory()
    {
        $requests=request()->all();
        $from = request('from');
        $to = request('to');
        //company_only
        if (\request('company_id') != null && \request('branch_id') == null && \request('store_id') == null && \request('product_id') == null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $inventory_id = AccountingInventory::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('inventory_id', $inventory_id)->get();
//             dd($inventories);
        } //company_and_branch_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') == null && \request('product_id') == null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $inventory_id = AccountingInventory::whereIn('store_id', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('inventory_id', $inventory_id)->get();
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') == null) {
            $inventory_id = AccountingInventory::where('store_id', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $inventories = AccountingInventoryProduct::whereIn('inventory_id', $inventory_id)->get();
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') != null) {
            $inventories = AccountingInventoryProduct::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->paginate(10);
        } else {
            $inventories=[];
        }

        return view('AccountingSystem.reports.stores.InventoryProducts', compact('inventories', 'requests'));
    }


    public function transactions()
    {
        $requests=request()->all();
        $from = request('from');
        $to = request('to');
        //company_only
        if (\request('company_id') != null && \request('branch_id') == null && \request('store_id') == null && \request('product_id') == null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $request_id = AccountingSroreRequest::whereIn('store_form', $stores)->orWhereIn('store_to', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $transactions = AccountingTransaction::whereIn('request_id', $request_id)->paginate(10);
        } //company_and_branch_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') == null && \request('product_id') == null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $request_id = AccountingSroreRequest::whereIn('store_form', $stores)->orWhereIn('store_to', $stores)->whereBetween('created_at', [$from, $to])->pluck('id');
            $transactions = AccountingTransaction::whereIn('request_id', $request_id)->paginate(10);
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') == null) {
            $request_id = AccountingSroreRequest::where('store_form', \request('store_id'))->orwhere('store_to', \request('store_id'))->orWhere('store_to', \request('store_id'))->whereBetween('created_at', [$from, $to])->pluck('id');
            $transactions = AccountingTransaction::whereIn('request_id', $request_id)->paginate(10);
        } //company_and_branch_and_store_and_product
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') != null) {
            $transactions = AccountingTransaction::where('product_id', \request('product_id'))->whereBetween('created_at', [$from, $to])->paginate(10);
        } else {
            $transactions=[];
        }

        return view('AccountingSystem.reports.stores.transactionProducts', compact('transactions', 'requests'));
    }


    public function deficiency()
    {
        $requests=request()->all();
        $deficiencies=[];

        //company_only
        if (\request('company_id') != null && \request('branch_id') == null && \request('store_id') == null && \request('product_id') == null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->pluck('quantity', 'product_id');

            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->whereIn('store_id', $stores)->sum('quantity');
                if ($product->min_quantity >= $quantites[$product->id]) {
                    array_push($deficiencies, $product);
                }
            }
//            dd($deficiencies);
        } //company_and_branch_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') == null && \request('product_id') == null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->whereIn('store_id', $stores)->sum('quantity');
                if ($product->min_quantity >= $quantites[$product->id]) {
                    array_push($deficiencies, $product);
                }
            }
        } //company_and_branch_and_store_only

        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') == null) {
            $store=\request('store_id');
            $product_quantity = AccountingProductStore::where('store_id', $store)->pluck('quantity', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if (isset($product)) {
                    $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->where('store_id', $store)->sum('quantity');
                    if ($product->min_quantity >= $quantites[$product->id]) {
                        array_push($deficiencies, $product);
                    }
                }
            }
        } else {
            $deficiencies=[];
            $stores=[];
            $quantites=[];
        }

        return view('AccountingSystem.reports.stores.deficiencyProducts', compact('deficiencies', 'stores', 'quantites', 'requests'));
    }



    public function expirations()
    {
        $requests=request()->all();
        $expire_products=[];
        $quantites=[];
        //company_only
        if (\request('company_id') != null && \request('branch_id') == null && \request('store_id') == null && \request('product_id') == null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->pluck('product_id', 'id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($item);
                $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->whereIn('store_id', $stores)->sum('quantity');

                $expire=new Carbon($product->expired_at);
                if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
//                    $product_store=AccountingProductStore::find($item);
                    if (!in_array($product, $expire_products)) {
                        array_push($expire_products, $product);
                    }
                }
            }
        } //company_and_branch_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') == null && \request('product_id') == null) {
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->pluck('product_id', 'id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($item);
                $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->whereIn('store_id', $stores)->sum('quantity');

                $expire=new Carbon($product->expired_at);
                if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
//                    $product_store=AccountingProductStore::find($item);
                    if (!in_array($product, $expire_products)) {
                        array_push($expire_products, $product);
                    }
                }
            }
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null && \request('product_id') == null) {
            $store=\request('store_id');
            $product_quantity = AccountingProductStore::where('store_id', $store)->pluck('product_id', 'id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($item);
                if (isset($product)) {
                    $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->where('store_id', $store)->sum('quantity');

                    $expire=new Carbon($product->expired_at);
                    if ($expire->diff(Carbon::now())->days <= $product->alert_duration) {
//                    $product_store=AccountingProductStore::find($item);
                        if (!in_array($product, $expire_products)) {
                            array_push($expire_products, $product);
                        }
                    }
                }
            }
//      dd($expire_products);
        } else {
            $expire_products=[];
        }
        return view('AccountingSystem.reports.stores.expiredProducts', compact('expire_products', 'quantites', 'requests'));
    }


    public function stagnants()
    {
        $requests=request()->all();
        $stagnant_sales = [];

        //company_only
        if (\request('company_id') != null && \request('branch_id') == null && \request('store_id') == null && \request('product_id') == null) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->pluck('store_id', 'product_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->whereIn('store_id', $stores)->sum('quantity');
                $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                    ->whereHas('sale', function ($query) use ($stores) {
                        $query->whereIn('store_id', $stores);
                    })->latest()->limit(1)->first();
                if ($last_item) {
                    $date = new Carbon($last_item->created_at);
                    if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                        array_push($stagnant_sales, $last_item);
                    }
                }
            }

//            dd($quantites);
        } //company_and_branch_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') == null && \request('product_id') == null) {
            $filter['branch']=\request('branch_id');
            $stores = AccountingStore::where('model_id', \request('branch_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $product_quantity = AccountingProductStore::whereIn('store_id', $stores)->pluck('quantity', 'product_id');
//            dd($product_quantity);
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);

                $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->whereIn('store_id', $stores)->sum('quantity');

                $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                    ->whereHas('sale', function ($query) use ($stores) {
                        $query->whereIn('store_id', $stores);
                    })->latest()->limit(1)->first();
                if ($last_item) {
                    $date = new Carbon($last_item->created_at);
                    if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                        array_push($stagnant_sales, $last_item);
                    }
                }
            }
            //dd($quantites[4]);
        } //company_and_branch_and_store_only
        elseif (\request('company_id') != null && \request('branch_id') != null && \request('store_id') != null) {
            $store=\request('store_id');
            $product_quantity = AccountingProductStore::where('store_id', $store)->pluck('quantity', 'product_id');
            $store_id = \request('store_id');
            foreach ($product_quantity as $key => $item) {
                $product = AccountingProduct::find($key);
                if (isset($product)) {
                    $quantites[$product->id]=AccountingProductStore::where('product_id', '=', $product->id)->where('store_id', $store)->sum('quantity');
                    $last_item = AccountingSaleItem::where('product_id', '=', $product->id)
                    ->whereHas('sale', function ($query) use ($store_id) {
                        $query->where('store_id', $store_id);
                    })->latest()->limit(1)->first();

                    if ($last_item) {
                        $date = new Carbon($last_item->created_at);
                        if ($date->diff(Carbon::now())->days >= $product->num_days_recession) {
                            array_push($stagnant_sales, $last_item);
                        }
                    }
                }
            }
        } else {
            $stagnant_sales = [];
            $quantites=[];
        }

        return view('AccountingSystem.reports.stores.stagnantProducts', compact('stagnant_sales', 'quantites', 'requests'));
    }


    public function movements(Request $request)
    {
        $from = request('from');
        $to = request('to');
        $purchases=collect([]);
        $sales=collect([]);
        $damages=collect([]);

        if (\request('product_id') != null) {
            $purchases = AccountingPurchaseItem::query()
           ->where('product_id', $request->product_id)
           ->when(
               $request->from!=null,
               fn ($q) =>$q->where('created_at', '>=', $request->from)
           )
           ->when(
               $request->to!=null,
               fn ($q) =>$q->where('created_at', '<=', $request->to)
           )
           ->when(
               $request->store_id!=null,
               fn ($q) =>$q->whereHas(
                   'purchase',
                   fn ($q) =>$q->where('store_id', $request->store_id)
               )
           )
           ->get();
            $sales= AccountingSaleItem::query()
            ->where('product_id', $request->product_id)
            ->when(
                $request->from!=null,
                fn ($q) =>$q->where('created_at', '>=', $request->from)
            )
            ->when(
                $request->to!=null,
                fn ($q) =>$q->where('created_at', '<=', $request->to)
            )
            ->when(
                $request->store_id!=null,
                fn ($q) =>$q->whereHas(
                    'sale',
                    fn ($q) =>$q->where('store_id', $request->store_id)
                )
            )
        ->get();
            $damages = AccountingDamageProduct::query()
                ->where('product_id', $request->product_id)
                ->when(
                    $request->from!=null,
                    fn ($q) =>$q->where('created_at', '>=', $request->from)
                )
                ->when(
                    $request->to!=null,
                    fn ($q) =>$q->where('created_at', '<=', $request->to)
                )
                ->when(
                    $request->store_id!=null,
                    fn ($q) =>$q->whereHas(
                        'damage',
                        fn ($q) =>$q->where('store_id', $request->store_id)
                    )
                )
        ->get();
        }

        return view('AccountingSystem.reports.stores.movementProducts', compact('purchases', 'sales', 'damages'));
    }
    public function generalMovements(Request $request)
    {
        // dd($request->from, $request->to);
        $accounting_products=AccountingProduct::query()
        ->haveMovementBetween(
            $request->from??now()->toDateString(),
            $request->to??now()->toDateString()
        )
        ->get();

        // dd($accounting_products->first());
        return view('AccountingSystem.reports.stores.generalMovement', compact('accounting_products'));
    }
}


/* select * from `accounting_products` where ((exists (select * from `accounting_sales_items` where `accounting_products`.`id` = `accounting_sales_items`.`product_id` and DATE(created_at) between '2021-12-02' and '2021-12-02')) or (exists (select * from `accounting_purchases_items` where `accounting_products`.`id` = `accounting_purchases_items`.`product_id` and DATE(created_at) between '2021-12-02' and '2021-12-02')) or (exists (select * from `accounting_damages_products` where `accounting_products`.`id` = `accounting_damages_products`.`product_id` and DATE(created_at) between '2021-12-02' and '2021-12-02'))) */
