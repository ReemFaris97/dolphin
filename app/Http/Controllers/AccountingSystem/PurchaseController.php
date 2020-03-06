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
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingProductTax;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
use App\Traits\Viewable;
use App\User;
use Auth;
use Carbon\Carbon;
use Request as GlobalRequest;

class PurchaseController extends Controller
{
    use Viewable;
    private $viewable = 'AccountingSystem.purchases.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases =AccountingPurchase::all()->reverse();

        return $this->toIndex(compact('purchases'));
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
        $requests = $request->all();
//   dd($requests);

        $rules = [

            // 'supplier_id'=>'required|numeric|exists:accounting_suppliers,id',
                // 'reminder'=>'required|numeric|gt:0',

        ];
        $this->validate($request,$rules);

        $purchase=AccountingPurchase::create($requests);

        $purchase->update([
            'bill_num'=>$purchase->id."-".$purchase->created_at,

        ]);

        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);
        $unit_id = collect($requests['unit_id']);
        $prices = collect($requests['prices']);
        $itemTax = collect($requests['itemTax']);

        $merges = $products->zip($qtys,$unit_id,$prices,$itemTax);

        foreach ($merges as $merge)
        {
            $product=AccountingProduct::find($merge['0']);
            if($merge['2']!='mainUnit'){

                $unit=AccountingProductSubUnit::where('product_id',$merge['0'])->where('id',$merge['2'])->first();

            }
            if($product->quantity>0){

            $item= AccountingPurchaseItem::create([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'price'=>$merge['3'],
                'unit_id'=>($merge['2']!='mainUnit')?$unit->id:null,
                'unit_type'=>($merge['2']!='mainUnit')?'sub':'main',
                'tax'=>$merge['4'],
                'price_after_tax'=>$merge['3']+$merge['4'],
                'purchase_id'=>$purchase->id
            ]);
            //update_product_quantity
            $product->update([
                'quantity'=>$product->quantity+ $merge['1'],
            ]);
            $productstore=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->where('product_id',$merge['0'])->first();
            $productstore->update([
                'quantity'=>$productstore->quantity + $merge['1'],
            ]);
/////////////////////////discount/////////////////
            if($requests['discount_byPercentage']!=0&&$requests['discount_byAmount']==0){
                $purchase->update([
                    'discount_type'=>'percentage',
                    'discount'=>$requests['discount_byPercentage'],

                ]);

            }elseif($requests['discount_byAmount']!=0&&$requests['discount_byPercentage']==0){

                $purchase->update([
                    'discount_type'=>'amount',
                    'discount'=>$requests['discount_byAmount'],
                ]);
            }

        }
    }
        alert()->success('تمت عملية الشراء بنجاح !')->autoclose(5000);
        return back();
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
        $product_items=AccountingPurchaseItem::where('purchase_id',$id)->get();

        return $this->toShow(compact('purchase','product_items'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shift =AccountingBranchShift::findOrFail($id);
        $branches=AccountingBranch::pluck('name','id')->toArray();

        return $this->toEdit(compact('shift','branches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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


    public function purchase_details($id){

        $items=AccountingPurchaseItem::where('purchase_id',$id)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();
        return response()->json([
            'status'=>true,
            'items'=>view('AccountingSystem.purchases.items')->with('items',$items)->render()
        ]);
    }


    public function remove_Purchase($id){

        $item=AccountingPurchaseItem::find($id);

        $item->delete();


    }

}
