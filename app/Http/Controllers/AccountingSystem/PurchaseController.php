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
    // dd($requests);

        $rules = [

            // 'supplier_id'=>'required|numeric|exists:accounting_suppliers,id',
                // 'reminder'=>'required|numeric|gt:0',

        ];
        $this->validate($request,$rules);

        $purchase=AccountingPurchase::create($requests);
    //    dd($sale);
        $purchase->update([
            'bill_num'=>$purchase->id."-".$purchase->created_at,

        ]);
        //  dd($sale);

        $products=$requests['product_id'];
        $quantities=$requests['quantity'];
//        $total=0;
//        for ($i=0;$i<count($products);$i++){
//            $product=AccountingProduct::find($products[$i]);
//            $price=$product->selling_price;
//
//            for ($j=0;$j<count($quantities);$j++){
//
//                if ($i==$j){
//
//                    $total+=$price* $quantities[$j];
//                }
//
//            }
//
//        }

        $products = collect($requests['product_id']);
        $qtys = collect($requests['quantity']);

        $merges = $products->zip($qtys);

        foreach ($merges as $merge)
        {
            $product=AccountingProduct::find($merge['0']);

            if($product->quantity>0){

            $item= AccountingSaleItem::create([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'price'=>$product->selling_price,
                'purchase_id'=>$purchase->id
            ]);
            //update_product_quantity
            $product->update([
                'quantity'=>$product->quantity+ $merge['1'],
            ]);
             //update_product_quantity_store
            $productstore=AccountingProductStore::where('store_id',$requests['store_id'])->where('product_id',$merge['0'])->first();
            $productstore->update([
                'quantity'=>$productstore->quantity + $merge['1'],
            ]);

        }
    }




        alert()->success('تمت عملية الشراء بنجاح !')->autoclose(5000);
        return back();
    }







    public function store_returns(Request $request){

       $requests=$request->all();
       $products=$requests['product_id'];
       $quantities=$requests['quantity'];
       $merges = $products->zip($quantities);
       foreach($merges as $merge){
      AccountingReturn::create([
        'product_id'=>$merge[0],
        'quantity'=>$merge[1],
        'user_id'=>'',
      ]);
      }
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


    // public function sale_end(Request $request,$id)
    // {

    //     // dd($request->all());
    //     $session=AccountingSession::findOrFail($id);
    //     $session->update([
    //      'end_session'=>Carbon::now(),
    //      'custody'=>$request['custody'],
    //     ]);


    //     $users=User::where('is_saler',1)->pluck('name','id')->toArray();
    //     alert()->success(' تم اغلاق  الجلسة بنجاح!')->autoclose(5000);

    //     return view('AccountingSystem.sell_points.login',compact('users'));
    // }
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
    public function update(Request $request, $id)
    {
        $shift =AccountingBranchShift::findOrFail($id);

        $rules = [
            'name'=>'required|string|max:191',
            'from'=>'required|string',
            'to'=>'required|string',
            'branch_id'=>'required|numeric|exists:accounting_branches,id',
        ];
        $this->validate($request,$rules);
        $requests = $request->all();
        $shift->update($requests);
        alert()->success('تم تعديل  الوردية بنجاح !')->autoclose(5000);
        return redirect()->route('accounting.shifts.index');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shift =AccountingSale::findOrFail($id);
        $shift->delete();
        alert()->success('تم حذف  الفاتوره بنجاح !')->autoclose(5000);
            return back();



    }

    public  function  sale_order($id)
    {
        $package=AccountingPackage::find($id);
        $product_offers=AccountingOffer::where('package_id',$id)->get();

        $sale=AccountingSale::create([
            'amount'=>$package->total,
            'client_id'=>$package->client_id,
            'total'=>$package->total,
            'payment'=>'agel',
            'debts'=>$package->total,
            'package_id'=>$id
        ]);

        foreach ($product_offers as $offer){

            AccountingSaleItem::create([
                'product_id'=>$offer->product_id,
                'quantity'=>$offer->quantity,
                'price'=>$offer->price,
                'sale_id'=>$sale->id,
            ]);
        }

        alert()->success('تم امر البيع بنجاح !')->autoclose(5000);
        return back();

    }

    public function returns($id){

        $sales=AccountingSale::pluck('id','id')->toArray();
        $session=AccountingSession::findOrFail($id);


    return view('AccountingSystem.sales.returns',compact('sales','session'));
    }
    public function returns_Sale($id){

        $sale=AccountingSale::find($id);
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sales.sale')->with('sale',$sale)->render()
        ]);
    }

    public function sale_details($id){

        $items=AccountingSaleItem::where('sale_id',$id)->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();
        return response()->json([
            'status'=>true,
            'items'=>view('AccountingSystem.sales.items')->with('items',$items)->render()
        ]);
    }


    public function remove_Sale($id){

        $item=AccountingSaleItem::find($id);

        $item->delete();


    }

}
