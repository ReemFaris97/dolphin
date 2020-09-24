<?php

namespace App\Http\Controllers\AccountingSystem;


use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingUserPermission;
use App\Models\UserPermission;
use App\Traits\Viewable;
use App\User;
use Illuminate\Validation\Rules\Exists;
use Request as GlobalRequest;

class BuyPointController extends Controller
{
    // use Viewable;
//    private $viewable = 'AccountingSystem.sells_points.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buy_point()
    {
        $categories=AccountingProductCategory::pluck('ar_name','id')->toArray();

        $suppliers=AccountingSupplier::pluck('name','id')->toArray();
        $safes=AccountingSafe::pluck('name','id')->toArray();


        // $products=AccountingProduct::all();
        $userstores=AccountingUserPermission::where('user_id',auth()->user()->id)->where('model_type','App\Models\AccountingSystem\AccountingStore')->pluck('model_id','id')->toArray();
        $stores=AccountingStore::whereIn('id',$userstores)->pluck('ar_name','id')->toArray();

        if(count($userstores) > 1){
        $store_product=AccountingProductStore::whereIn('store_id',$userstores)->pluck('product_id','id')->toArray();
        $products=[];

    }elseif(count($userstores)==1){
        $store_product=AccountingProductStore::whereIn('store_id',$userstores)->toArray();
        $products=AccountingProduct::whereIn('id',$store_product)->get();
      }else{
        $products=[];
      }

       return  view('AccountingSystem.buy_points.buy_point',compact('categories','suppliers','safes','products','stores'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function getProductAjex(Request $request){
        $store_product=AccountingProductStore::where('store_id',auth()->user()->accounting_store_id)->pluck('product_id','id')->toArray();
        $products=AccountingProduct::where('category_id',$request['id'])->whereIn('id',$store_product)->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.buy_points.products')->with('products',$products)->render()
        ]);
    }

    public  function pro_search($q){

        $products=AccountingProduct::where('name','LIKE','%'.$q.'%')->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.buy_points.sell')->with('products',$products)->render()
        ]);

    }

    public  function barcode_search($q){


        $products=AccountingProduct::where('bar_code',$q)->get();

		if(!$products->isEmpty())
		{
			$selectd_unit_id = 'main-'.$products[0]->id;
		}
        else
        {
            $product_unit=AccountingProductSubUnit::where('bar_code',$q)->pluck('product_id');
            $products=AccountingProduct::whereIn('id',$product_unit)->get();
            $unit=	AccountingProductSubUnit::where('bar_code',$q)->first();
			if($unit)
			$selectd_unit_id = $unit->id;
			else
				$select_unit_id = 0;
        }

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.buy_points.barcodeProducts',compact('products','selectd_unit_id'))->render()
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {



    }
}
