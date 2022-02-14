<?php
namespace App\Traits;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingItemDiscount;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingPurchaseReturnItem;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\User;

trait PurchaseOperation
{
    //     /**
    //      * Boot the has password trait for a model.
    //      *
    //      * @return void
    //      */
    //     public static function createItem($request, $purchase)
    //     {
    //         $requests=$request->all();
    //         $products = collect($requests['product_id']);
    //         $qtys = collect($requests['quantity']);
    //         $unit_id = collect($requests['unit_id']);
    //         $prices = collect($requests['prices']);
    //         $itemTax = collect($request['itemTax']);
    //         $gifts = collect($requests['gifts']);

    //         $merges = $products->zip($qtys, $unit_id, $prices, $itemTax, $gifts);
    //         $i=1;

    //         foreach ($merges as $merge) {
    //             if ($merge[0]!=null &$merge[1]!=null &$merge[2]!=null &$merge[3]!=null) {
    //                 $product=AccountingProduct::find($merge['0']);

    //                 if ($merge['2']!='main-'.$product->id) {
    //                     $unit=AccountingProductSubUnit::where('product_id', $merge['0'])->where('id', $merge['2'])->first();
    //                     if ($unit) {
    //                         $unit->update([
    //                         'quantity'=>$unit->quantity + $merge['1']+$merge['5'],
    //                     ]);
    //                     }
    //                 } else {
    //                     $product->update([
    //                     'quantity'=>$product->quantity + $merge['1']+$merge['5'],
    //                 ]);
    //                 }
    // //            if($product->quantity>0){
    //                 $item= AccountingPurchaseItem::create([
    //                 'product_id'=>$merge['0'],
    //                 'quantity'=> $merge['1'],
    //                 'price'=>$merge['3'],
    //                 'unit_id'=>($merge['2']!='main-'.$product->id)?$unit->id:null,
    //                 'unit_type'=>($merge['2']!='main-'.$product->id)?'sub':'main',
    //                 'tax'=>$merge['4'],
    //                 'price_after_tax'=>$merge['3']+$merge['4'],
    //                 'expire_date'=>isset($requests['expire_date'])?$requests['expire_date']:null,
    //                 'gifts'=>$merge['5'],
    //                 'purchase_id'=>$purchase->id
    //             ]);
    //                 $items=$request->items;
    //                 foreach ($items as  $key=>$item1) {
    //                     if ($key==$i) {
    //                         foreach ($item1 as $ke=>$item2) {
    //                             if ($ke=='discount_item_percentage') {
    //                                 foreach ($item2 as $k1 => $value) {
    //                                     if ($item2[$k1]!=0) {
    //                                         $discountItem= AccountingItemDiscount::create([
    //                                     'discount'=> $item2[$k1],
    //                                     'discount_type'=>'percentage',
    //                                     'item_id'=>$item->id,
    //                                     'type'=>'purchase',
    //                                     'affect_tax'=>$item1['discount_item_effectTax'][$k1]??0,
    //                                 ]);
    //                                     }
    //                                 }
    //                             } elseif ($ke=='discount_item_value') {
    //                                 foreach ($item2 as $k1 => $value) {
    //                                     if ($item2[$k1]!=0) {
    //                                         $discountItem= AccountingItemDiscount::create([
    //                                 'discount'=> $item2[$k1],
    //                                 'discount_type'=>'amount',
    //                                 'item_id'=>$item->id,
    //                                 'type'=>'purchase',
    //                                 'affect_tax'=>$item1['discount_item_effectTax'][$k1]??0,
    //                                 ]);
    //                                     }
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }

    //                 $i++;

    //                 //update_product_quantity

    //                 ///if-main-unit

    //                 if ($merge['2']!='main-'.$product->id) {
    //                     $productstore=AccountingProductStore::where('store_id', auth()->user()->accounting_store_id)->where('product_id', $merge['0'])->where('unit_id', $merge['2'])->first();
    //                     if ($productstore) {
    //                         $productstore->update([
    //                          'quantity' => $productstore->quantity + $merge['1'],

    //                      ]);
    //                     }
    //                 } else {
    //                     $productstore=AccountingProductStore::where('store_id', auth()->user()->accounting_store_id)->where('product_id', $merge['0'])->where('unit_id', null)->first();
    // //              dd(auth()->user()->accounting_store_id);
    //                     if ($productstore) {
    //                         $productstore->update([
    //                          'quantity' => $productstore->quantity + $merge['1']+$merge['5'],
    //                      ]);
    //                     }

    //                     /////////////////////////discount/////////////////
    //                     if ($requests['discount_byPercentage']!=0&&$requests['discount_byAmount']==0) {
    //                         $purchase->update([
    //                     'discount_type'=>'percentage',
    //                     'discount'=>$requests['discount_byPercentage'],

    //                 ]);
    //                     } elseif ($requests['discount_byAmount']!=0&&$requests['discount_byPercentage']==0) {
    //                         $purchase->update([
    //                     'discount_type'=>'amount',
    //                     'discount'=>$requests['discount_byAmount'],
    //                 ]);
    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     public static function editItem($request, $purchase)
    //     {
    //         $requests=$request->all();
    //         $products_old = collect($requests['product_id']);
    //         $qtys_old = collect($requests['quantity_old']);
    //         $unit_id_old = collect($requests['unit_id_old']);
    //         $prices_old = collect($requests['prices_old']);
    //         $itemTax_old = collect($request['itemTax_old']);
    //         $gifts_old = collect($requests['gifts_old']);

    //         $merges_old = $products_old->zip($qtys_old, $unit_id_old, $prices_old, $itemTax_old, $gifts_old);
    //         foreach ($merges_old as  $merge) {
    //             $product=AccountingProduct::find($merge['0']);

    //             $item_old=AccountingPurchaseItem::where('purchase_id', $purchase->id)->where('product_id', $merge[0])->first();

    //             //////////////////////////////تعديل  كميات المستودع
    //             ///////////////////الفرق  بيين  الكميات +الهدايا  القديمه والجدييده
    //             // dd($item_old->quantity + $item_old->gifts-($merge['1']+$merge['5']));
    //             if ($item_old) {
    //                 $result=$item_old->quantity + $item_old->gifts -($merge['1']+$merge['5']);

    //                 if ($merge['2']!='main-'.$product->id) {
    //                     $unit=AccountingProductSubUnit::where('product_id', $merge['0'])->where('id', $merge['2'])->first();

    //                     if ($unit) {
    //                         $unit->update([
    //                         'quantity'=>$unit->quantity +$result,
    //                     ]);
    //                         /////////////////////////////////////////////بعد  التعديل

    //                         $item_old->update([
    //                         'product_id'=>$merge['0'],
    //                         'quantity'=> $merge['1'],
    //                         'price'=>$merge['3'],
    //                         'unit_id'=>($merge['2']!='main-'.$product->id)? $unit->id:null,
    //                         'unit_type'=>($merge['2']!='main-'.$product->id)?'sub':'main',
    //                         'tax'=>$merge['4'],
    //                         'price_after_tax'=>$merge['3']+$merge['4'],
    //                         'expire_date'=>isset($requests['expire_date'])?$requests['expire_date']:null,
    //                         'gifts'=>$merge['5'],
    //                         'purchase_id'=>$purchase->id
    //                     ]);
    //                     }
    //                 } else {
    //                     $product->update([
    //             'quantity'=>$product->quantity + $result ,
    //         ]);

    //                     $item_old->update([
    //             'product_id'=>$merge['0'],
    //             'quantity'=> $merge['1'],
    //             'price'=>$merge['3'],
    //             'unit_id'=>null,
    //             'unit_type'=>'main',
    //             'tax'=>$merge['4'],
    //             'price_after_tax'=>$merge['3']+$merge['4'],
    //             'expire_date'=>isset($requests['expire_date'])?$requests['expire_date']:null,
    //             'gifts'=>$merge['5'],
    //             'purchase_id'=>$purchase->id
    //         ]);
    //                     // dd($item_old);
    //                 }
    //             }
    //         }
    //     }
    public function returns($request)
    {
        $requests = $request->all();
        $rules = [
            "supplier_id" => "required|numeric|exists:accounting_suppliers,id",
            "store_id" => "required|numeric|exists:accounting_stores,id",
        ];
        $this->validate($request, $rules);
        $return = AccountingPurchaseReturn::create($requests);
        $user = User::find(auth()->user()->id);
        $requests["branch_id"] =
            $user->store->model_type == AccountingBranch::class
                ? $user->store->model_id
                : null;
        $requests["company_id"] =
            $user->store->model_type == AccountingCompany::class
                ? $user->store->model_id
                : null;
        if ($requests["total"] == null) {
            $requests["total"] = $return->amount + $requests["totalTaxs"];
        }
        $return->update([
            "bill_num" =>
                $return->bill_num . "-" . $return->created_at->toDateString(),
            "branch_id" => $requests["branch_id"],
            "company_id" => $requests["company_id"],
            "user_id" => auth()->user()->id,
            "store_id" => $user->accounting_store_id,
            "total" => round($requests["total"], 2),
        ]);

        $products = collect($requests["product_id"]);
        $qtys = collect($requests["quantity"]);
        $unit_id = collect($requests["unit_id"]);
        $prices = collect($requests["prices"]);
        $itemTax = collect($requests["itemTax"]);
        $gifts = collect($requests["gifts"]);

        $merges = $products->zip($qtys, $unit_id, $prices, $itemTax, $gifts);
        $i = 1;
        foreach ($merges as $merge) {
            $unit = AccountingProductSubUnit::find($merge["2"]);
            $item = AccountingPurchaseReturnItem::create([
                "product_id" => $merge["0"],
                "quantity" => $merge["1"],
                "price" => $merge["3"],
                "unit_id" => $unit?->id,
                "unit_type" => $unit != null ? "sub" : "main",
                "tax" => $merge["4"],
                "price_after_tax" => $merge["3"] + $merge["4"],
                "gifts" => $merge["5"],
                "purchase_return_id" => $return->id,
            ]);
            // $perc = $request->discount_item_percentage;
            // $val = $request->discount_item_value;
            $items = $request->items ?? [];
            foreach ($items as $key => $item1) {
                if ($key == $i) {
                    foreach ($item1 as $ke => $item2) {
                        if ($ke == "discount_item_percentage") {
                            foreach ($item2 as $k1 => $value) {
                                if ($item2[$k1] != 0) {
                                    AccountingItemDiscount::create([
                                        "discount" => $item2[$k1],
                                        "discount_type" => "percentage",
                                        "item_id" => $item->id,
                                        "type" => "return",
                                        "affect_tax" =>
                                            $item1["discount_item_effectTax"][
                                                $k1
                                            ],
                                    ]);
                                }
                            }
                        } elseif ($ke == "discount_item_value") {
                            foreach ($item2 as $k1 => $value) {
                                if ($item2[$k1] != 0) {
                                    AccountingItemDiscount::create([
                                        "discount" => $item2[$k1],
                                        "discount_type" => "amount",
                                        "item_id" => $item->id,
                                        "type" => "return",
                                        "affect_tax" =>
                                            $item1["discount_item_effectTax"][
                                                $k1
                                            ],
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            $i++;

            /////////////////////////discount/////////////////
            if (
                $requests["discount_byPercentage"] != 0 &&
                $requests["discount_byAmount"] == 0
            ) {
                $return->update([
                    "discount_type" => "percentage",
                    "discount" => $requests["discount_byPercentage"],
                ]);
            } elseif (
                $requests["discount_byAmount"] != 0 &&
                $requests["discount_byPercentage"] == 0
            ) {
                $return->update([
                    "discount_type" => "amount",
                    "discount" => $requests["discount_byAmount"],
                ]);
            }
        }

        if ($return->payment == "cash") {
            $store_id = auth()->user()->accounting_store_id;
            $store = AccountingStore::find($store_id);
            $safe = AccountingSafe::where("model_type", $store->model_type)
                ->where("model_id", $store->model_id)
                ->first();
            $safe->update([
                "amount" => $safe->amount + $return->total,
            ]);
        } else {
            $supplier = AccountingSupplier::find($return->supplier_id);

            if ($supplier) {
                $supplier->update([
                    "balance" => $supplier->balance - $return->total,
                ]);
            }
        }

        alert()
            ->success("تمت عملية الاسترجاع بنجاح !")
            ->autoclose(5000);
        return back();
    }
}
