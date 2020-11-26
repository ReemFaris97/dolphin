<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Models\AccountingSystem\AccountingProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingItemDiscount;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingPurchaseReturnItem;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Traits\Viewable;
use App\Models\User;
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

        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();
        $suppliers=AccountingSupplier::pluck('name','id')->toArray();
        $safes=AccountingSafe::pluck('name','id')->toArray();
        // $products=AccountingProduct::all();
        $userstores=AccountingUserPermission::where('user_id',auth()->user()->id)->where('model_type','App\Models\AccountingSystem\AccountingStore')->pluck('model_id','id')->toArray();
        $stores=AccountingStore::whereIn('id',$userstores)->pluck('ar_name','id')->toArray();
        if($userstores){
        $store_product=AccountingProductStore::whereIn('store_id',$userstores)->pluck('product_id','id')->toArray();
            $products=AccountingProduct::whereIn('id',$store_product)->get();


             }else{
        $products=[];
      }

       return  view('AccountingSystem.buy_points.buy_point',compact('categories','suppliers','safes','products','stores'));
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
