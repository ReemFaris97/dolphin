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
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingPurchaseReturnItem;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSession;
use App\Models\AccountingSystem\AccountingStore;
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

$puchaseReturns =AccountingPurchaseReturn::all();
        return $this->toIndex(compact('puchaseReturns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchases=AccountingPurchase::pluck('id','id')->toArray();

        return $this->toCreate(compact('purchases'));
    }


    public function show($id){
        $purchaseReturn=AccountingPurchaseReturn::find($id);

        $product_items=AccountingPurchaseReturnItem::where('purchase_return_id',$id)->get();

        return $this->toShow(compact('purchaseReturn','product_items'));
    }

    public function getproducts($id)
    {


        return products_purchase($id);
    }



    public function productpurchase(Request $request)
    {

        $ids=$request['ids'];
        $purchase=$request['purchase'];

        $products=AccountingPurchaseItem::whereIN('product_id',$ids)->where('purchase_id',$purchase)->get();


        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.purchaseReturns.product',compact('products'))->render()
        ]);

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
        $products = collect($requests['product_id']);
        $qtys =collect($requests['quantity']);
        $merges = $products->zip($qtys);
      //insert_in_table
       $purchasereturn= AccountingPurchaseReturn::create([
            'purchase_id'=>$requests['purchase_id'],
            'total'=>$requests['total'],
        ]);
        foreach ($merges as $merge)
        {
            $item=AccountingPurchaseReturnItem::create([
                'product_id'=>$merge['0'],
                'quantity'=> $merge['1'],
                'purchase_return_id'=>$purchasereturn->id,
            ]);
        }
  //update_purchases
    $purchase=AccountingPurchase::find($requests['purchase_id']);
    $purchase->update([
        'total'=>$requests['total']
    ]);
     //update_quantities
    $purchases=AccountingPurchaseItem::where('purchase_id',$requests['purchase_id'])->get();
    // dd($purchases);
        foreach($purchases as $purchase)
        {

            foreach($merges as $merge){
                if( $purchase->product_id==$merge['0']){
                    $purchase->update([
                        'quantity'=> $merge['1'],
                    ]);
                }

            }
        }
        alert()->success('تمت عملية  الاسترجاع بنجاح !')->autoclose(5000);
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





}
