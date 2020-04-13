<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingBranchShift;
use App\Models\AccountingSystem\AccountingCompany;

use App\Models\AccountingSystem\AccountingOffer;
use App\Models\AccountingSystem\AccountingPackage;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSaleItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingItemDiscount;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingPurchaseReturnItem;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Traits\Viewable;
use App\User;
use Auth;
use Carbon\Carbon;
use Request as GlobalRequest;

class PurchaseReturnController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.purchaseReturns.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $puchaseReturns = AccountingPurchaseReturn::all();
        return $this->toIndex(compact('puchaseReturns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchases = AccountingPurchase::pluck('id', 'id')->toArray();

        $categories = AccountingProductCategory::pluck('ar_name', 'id')->toArray();
        $suppliers = AccountingSupplier::pluck('name', 'id')->toArray();
        $safes = AccountingSafe::pluck('name', 'id')->toArray();
        return $this->toCreate(compact('purchases', 'categories', 'suppliers', 'safes'));
    }


    public function show($id)
    {
        $purchaseReturn = AccountingPurchaseReturn::find($id);

        $product_items = AccountingPurchaseReturnItem::where('purchase_return_id', $id)->get();

        return $this->toShow(compact('purchaseReturn', 'product_items'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->all();


        $rules = [

            'supplier_id'=>'required|numeric|exists:accounting_suppliers,id',


        ];
        $this->validate($request, $rules);
        $return = AccountingPurchaseReturn::create($requests);
        $user=User::find(auth()->user()->id);
        $requests['branch_id']=($user->store->model_type=='App\Models\AccountingSystem\AccountingBranch')?$user->store->model_id:Null;
        $requests['company_id']=($user->store->model_type=='App\Models\AccountingSystem\AccountingCompany')?$user->store->model_id:Null;

        $return->update([
            'bill_num' =>$return->bill_num."-".$return->created_at->toDateString(),
            'branch_id'=>$requests['branch_id'],
            'company_id'=>$requests['company_id'],
            'user_id'=>auth()->user()->id,
            'store_id'=>$user->accounting_store_id,
        ]);

        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);
        $unit_id = collect($requests['unit_id']);
        $prices = collect($requests['prices']);
        $itemTax = collect($requests['itemTax']);
        $merges = $products->zip($qtys, $unit_id, $prices, $itemTax);
        $i = 1;
        foreach ($merges as $merge) {
            $product = AccountingProduct::find($merge['0']);
            if ($merge['2'] != 'main-' . $product->id) {
                $unit = AccountingProductSubUnit::where('product_id', $merge['0'])->where('id', $merge['2'])->first();
            }

                $item = AccountingPurchaseReturnItem::create([
                    'product_id' => $merge['0'],
                    'quantity' => $merge['1'],
                    'price' => $merge['3'],
                    'unit_id' => ($merge['2'] != 'main-' . $product->id) ? $unit->id : null,
                    'unit_type' => ($merge['2'] != 'main-' . $product->id) ? 'sub' : 'main',
                    'tax' => $merge['4'],
                    'price_after_tax' => $merge['3'] + $merge['4'],
                    'purchase_return_id' => $return->id
                ]);
                // $perc = $request->discount_item_percentage;
                // $val = $request->discount_item_value;
                $items = $request->items;
                foreach ($items as $key => $item1) {
                    if ($key == $i) {
                        foreach ($item1 as $ke => $item2) {

                            if ($ke == 'discount_item_percentage') {
                                foreach ($item2 as $k1 => $value) {
                                    if ($item2[$k1] != 0) {
                                        $discountItem = AccountingItemDiscount::create([
                                            'discount' => $item2[$k1],
                                            'discount_type' => 'percentage',
                                            'item_id' => $item->id,
                                            'type' => 'return',
                                            'affect_tax'=>$item1['discount_item_effectTax'][$k1]
                                        ]);
                                    }

                                }
                            } elseif ($ke == 'discount_item_value') {

                                foreach ($item2 as $k1 => $value) {
                                    if ($item2[$k1] != 0) {

                                        $discountItem = AccountingItemDiscount::create([
                                            'discount' => $item2[$k1],
                                            'discount_type' => 'amount',
                                            'item_id' => $item->id,
                                            'type' => 'return',
                                            'affect_tax'=>$item1['discount_item_effectTax'][$k1]
                                        ]);
                                    }

                                }

                            }
                        }

                    }
                }

                $i++;
                //update_product_quantity
                ///if-main-unit
                if($merge['2']!='main-'.$product->id){
                    $productstore=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->where('product_id',$merge['0'])->where('unit_id',$merge['2'])->first();
                    if($productstore) {
                        $productstore->update([
                            'quantity' => $productstore->quantity - $merge['1'],
                        ]);
                    }
                }else{
                    $productstore=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->where('product_id',$merge['0'])->where('unit_id',Null)->first();
                    if($productstore) {
                        $productstore->update([
                            'quantity' => $productstore->quantity - $merge['1'],
                        ]);
                    }
                }
/////////////////////////discount/////////////////
                if ($requests['discount_byPercentage'] != 0 && $requests['discount_byAmount'] == 0) {
                    $return->update([
                        'discount_type' => 'percentage',
                        'discount' => $requests['discount_byPercentage'],

                    ]);

                } elseif ($requests['discount_byAmount'] != 0 && $requests['discount_byPercentage'] == 0) {

                    $return->update([
                        'discount_type' => 'amount',
                        'discount' => $requests['discount_byAmount'],
                    ]);
                }


        }

        if ($return->payment == 'cash') {
            $store_id = auth()->user()->accounting_store_id;
            $store = AccountingStore::find($store_id);
            $safe = AccountingSafe::where('model_type', $store->model_type)->where('model_id', $store->model_id)->first();
            $safe->update([
                'amount' => $safe->amount + $return->total
            ]);
        }elseif ($return->payment == 'agel'){

            $supplier = AccountingSupplier::find($return->supplier_id);

            if ($supplier) {
                if($return->payment=='agel') {

                    $supplier->update([
                        'balance'=>$supplier->balance - $return->total
                    ]);

                }
            }
        }

        alert()->success('تمت عملية الاسترجاع بنجاح !')->autoclose(5000);
        return back();
    }

    public function store_returns(Request $request)
    {

        $requests = $request->all();
        $products = $requests['product_id'];
        $quantities = $requests['quantity'];
        $merges = $products->zip($quantities);
        foreach ($merges as $merge) {
            AccountingReturn::create([
                'product_id' => $merge[0],
                'quantity' => $merge[1],
                'user_id' => '',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


}
