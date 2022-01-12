<?php

namespace App\Http\Controllers\AccountingSystem;

use App\DataTables\AccountingPurchasesDataTable;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingCompany;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingSupplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingItemDiscount;
use App\Models\AccountingSystem\AccountingProductStore;
// use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use App\Models\AccountingSystem\AccountingSafe;
 use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Traits\PurchaseOperation;
use App\Traits\Viewable;
use App\Models\User;

class PurchaseController extends Controller
{
    use Viewable;
    use PurchaseOperation;
    private $viewable = 'AccountingSystem.purchases.';


    public function index(AccountingPurchasesDataTable $dataTable)
    {
        //  $purchases =AccountingPurchase::all()->reverse();
        // return $this->toIndex(compact('purchases'));
        return $dataTable->render('AccountingSystem.purchases.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->toCreate(compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requests = $request->except('user_id');
        if ($requests['type']=='purchase') {
            $rules = [
                'supplier_id'=>'required|numeric|exists:accounting_suppliers,id',
                'store_id'=>'required|numeric|exists:accounting_stores,id',
             ];
            $this->validate($request, $rules);
            $user=User::find(auth()->user()->id);
            if (getsetting('automatic_purchases')==1) {
                $requests['account_id']=getsetting('accounting_id_purchases');
            }
            $requests['branch_id']=(optional($user->store)->model_type==AccountingBranch::class)?optional($user->store)->model_id:null;
            $requests['company_id']=(optional($user->store)->model_type==AccountingCompany::class)?optional($user->store)->model_id:null;
            $requests['store_id']=$request->store_id;
            $purchase=AccountingPurchase::create($requests);
            if ($requests['total']==null) {
                $requests['total']=$purchase->amount+$requests['totalTaxs'];
            }
            $purchase->update([
                 'bill_num'=>$purchase->bill_num."-".$purchase->created_at->toDateString(),
                 'branch_id'=>$requests['branch_id'],
                 'company_id'=>$requests['company_id'],
                 'user_id'=>auth()->user()->id,
                 'total'=>$requests['total'],
                 'totalTaxs'=>$requests['totalTaxs'],
             ]);

            $products = collect($requests['product_id']);
            $qtys = collect($requests['quantity']);
            $unit_id = collect($requests['unit_id']);
            $prices = collect($requests['prices']);
            $itemTax = collect($request['itemTax']);
            $gifts = collect($requests['gifts']);
            $merges = $products->zip($qtys, $unit_id, $prices, $itemTax, $gifts);
            $i=1;

            foreach ($merges as $merge) {
                $unit=AccountingProductSubUnit::where('product_id', $merge['0'])->where('id', $merge['2'])->first();
                $item= AccountingPurchaseItem::create([
                     'product_id'=>$merge['0'],
                     'quantity'=> $merge['1'],
                     'price'=>$merge['3'],
                     'unit_id'=>$unit?->id,
                     'unit_type'=>$unit?->id!=null?'sub':'main',
                     'tax'=>$merge['4'],
                     'price_after_tax'=>$merge['3']+$merge['4'],
                     'expire_date'=>isset($requests['expire_date'])?$requests['expire_date']:null,
                     'gifts'=>$merge['5'],
                     'purchase_id'=>$purchase->id
                 ]);
                $items=$request->items;
                foreach ($items ??[] as  $key=>$item1) {
                    if ($key==$i) {
                        foreach ($item1 as $ke=>$item2) {
                            if ($ke=='discount_item_percentage') {
                                foreach ($item2 as $k1 => $value) {
                                    if ($item2[$k1]!=0) {
                                        AccountingItemDiscount::create([
                                         'discount'=> $item2[$k1],
                                         'discount_type'=>'percentage',
                                         'item_id'=>$item->id,
                                         'type'=>'purchase',
                                         'affect_tax'=>$item1['discount_item_effectTax'][$k1]??0,
                                     ]);
                                    }
                                }
                            } elseif ($ke=='discount_item_value') {
                                foreach ($item2 as $k1 => $value) {
                                    if ($item2[$k1]!=0) {
                                        AccountingItemDiscount::create([
                                     'discount'=> $item2[$k1],
                                     'discount_type'=>'amount',
                                     'item_id'=>$item->id,
                                     'type'=>'purchase',
                                     'affect_tax'=>$item1['discount_item_effectTax'][$k1]??0,
                                     ]);
                                    }
                                }
                            }
                        }
                    }
                }

                $i++;

                /////////////discount/////////////////
                if ($requests['discount_byPercentage']!=0&&$requests['discount_byAmount']==0) {
                    $purchase->update([
                         'discount_type'=>'percentage',
                         'discount'=>$requests['discount_byPercentage'],
                     ]);
                } elseif ($requests['discount_byAmount']!=0&&$requests['discount_byPercentage']==0) {
                    $purchase->update([
                         'discount_type'=>'amount',
                         'discount'=>$requests['discount_byAmount'],
                     ]);
                }
            }
            if ($purchase->payment=='cash') {
                $store_id=$request['store_id'];
                $store=AccountingStore::find($store_id);
                $safe=AccountingSafe::where('model_type', $store->model_type)->where('model_id', $store->model_id)->first();
                if (isset($safe)) {
                    optional($safe)->update([
                         'amount'=>$safe->amount-$purchase->total
                     ]);
                }
            } elseif ($purchase->payment=='agel') {
                $supplier=AccountingSupplier::find($purchase->supplier_id);
                optional($supplier)->update([
                     'balance'=>$supplier->balance +$purchase->total
                 ]);
            }

            alert()->success('تمت عملية الشراء بنجاح !')->autoclose(5000);

            return back();
        } elseif ($requests['type']=='return') {
            return  $this->returns($request);
        } elseif ($requests['type']=='edit') {
        }

        // alert()->success('تمت عملية الشراء بنجاح !')->autoclose(5000);
        // return back();
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        $purchase =AccountingPurchase::findOrFail($id);
        $product_items=AccountingPurchaseItem::where('purchase_id', $id)->get();
        return view('AccountingSystem.purchases.print', compact(
            'purchase',
            'product_items'
        ));
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase =AccountingPurchase::findOrFail($id);
        $product_items=AccountingPurchaseItem::where('purchase_id', $id)->get();
        return $this->toShow(compact('purchase', 'product_items'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=AccountingProductCategory::pluck('ar_name', 'id')->toArray();

        $suppliers=AccountingSupplier::pluck('name', 'id')->toArray();
        $safes=AccountingSafe::pluck('name', 'id')->toArray();
        $userstores=AccountingUserPermission::where('user_id', auth()->user()->id)->where('model_type', 'App\Models\AccountingSystem\AccountingStore')->pluck('model_id', 'id')->toArray();
        $stores=AccountingStore::whereIn('id', $userstores)->pluck('ar_name', 'id')->toArray();
        if ($userstores) {
            $store_product=AccountingProductStore::whereIn('store_id', $userstores)->pluck('product_id', 'id')->toArray();
            $products=AccountingProduct::whereIn('id', $store_product)->get();
        } else {
            $products=[];
        }

        $purchase =AccountingPurchase::findOrFail($id);
        $product_items=AccountingPurchaseItem::where('purchase_id', $id)->get();
        return view('AccountingSystem.buy_points.buy_point', compact('categories', 'suppliers', 'safes', 'products', 'product_items', 'purchase', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $purchase =AccountingPurchase::findOrFail($id);
        $requests = $request->except('user_id');
        // dd($requests);
        $purchase->update([
            'amount'=>$requests['amount'],
            'totalTaxs'=>$requests['totalTaxs'],
            'total'=>$requests['total'],
            'payment'=>$requests['payment'],
            'supplier_id'=>$requests['supplier_id'],
            'bill_num'=>$requests['bill_num'],
            '__bill_date'=>$requests['__bill_date'],
        ]);
        //create new item and new discount
        $this->createItem($request, $purchase);
        $this->editItem($request, $purchase);


        $purchases =AccountingPurchase::all()->reverse();
        // dd($purchases);
        alert()->success('تمت عمليةتعديل الشراء بنجاح !')->autoclose(5000);

        return $this->toIndex(compact('purchases'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase =AccountingPurchase::findOrFail($id);
        $purchase->delete();
        alert()->success('تم حذف  الفاتوره بنجاح !')->autoclose(5000);
        return back();
    }


    public function purchase_details($id)
    {
        $items=AccountingPurchaseItem::where('purchase_id', $id)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();
        return response()->json([
            'status'=>true,
            'items'=>view('AccountingSystem.purchases.items')->with('items', $items)->render()
        ]);
    }


    public function remove_Purchase($id)
    {
        $item=AccountingPurchaseItem::find($id);

        $item->delete();
    }
}
