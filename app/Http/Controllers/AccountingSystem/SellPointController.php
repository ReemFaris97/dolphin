<?php

namespace App\Http\Controllers\AccountingSystem;

use App\Models\AccountingSystem\AccountingClient;

use App\Models\AccountingSystem\AccountingProduct;
use App\Models\AccountingSystem\AccountingProductCategory;
use App\Models\AccountingSystem\AccountingProductSubUnit;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingUserPermission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingDevice;
use App\Models\AccountingSystem\AccountingProductStore;
use App\Models\AccountingSystem\AccountingSession;
use App\Traits\Viewable;
use App\Models\User;
use Cookie;
use Request as GlobalRequest;
use Session;

class SellPointController extends Controller
{
    use Viewable;
//    private $viewable = 'AccountingSystem.sells_points.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sell_point(Request $request,$id)
    {
        $categories=AccountingProductCategory::all();
//        dd(Cookie::get('session'));
        $session=AccountingSession::find(Cookie::get('session'))??AccountingSession::latest()->first();
        $clients=AccountingClient::pluck('name','id')->toArray();
        $userstores = AccountingUserPermission::where('user_id',auth()->user()->id)
            ->where('model_type','App\Models\AccountingSystem\AccountingStore')->pluck('model_id','id')->toArray();
        $stores=AccountingStore::whereIn('id',$userstores)->pluck('ar_name','id')->toArray();
        if($userstores){
            $store_product=AccountingProductStore::whereIn('store_id',$userstores)->pluck('product_id','id')->toArray();
            $products=AccountingProduct::whereIn('id',$store_product)->get();
        }else{
            $products=[];
        }

        return  view('AccountingSystem.sell_points.sell_point',compact('categories','clients','session','products','stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public  function getProductAjex(Request $request,$id){
        $store_product=AccountingProductStore::where('store_id',$request['id'])->pluck('product_id','id')->toArray();
        $products=AccountingProduct::whereIn('id',$store_product)->get();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sell_points.products')->with('products',$products)->render()
        ]);
    }

    public  function pro_search($q){

        $products=AccountingProduct::where('name','LIKE','%'.$q.'%')->get();
        // $products_a=AccountingProduct::where('category_id',$id)->pluck('id','id')->toArray();

        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sell_points.sell')->with('products',$products)->render()
        ]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sell_login()
    {

        $users=User::where('is_saler',1)->pluck('name','id')->toArray();
        $devices=AccountingDevice::where('available',1)->pluck('name','id')->toArray();
        return view('AccountingSystem.sell_points.login',compact('users','devices'));
    }

    /**
     *
     * Display the specified resource.
     *
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


    public  function barcode_search(Request $request,$q){

        $store_product=AccountingProductStore::where('store_id',$request['store_id'])->pluck('product_id','id')->toArray();
        $products=AccountingProduct::whereIn('id',$store_product)->where('bar_code',$q)->get();
        if(!$products->isEmpty())
        {
            $selectd_unit_id = 'main-'.$products[0]->id;
        }
        else
        {
            $product_unit=AccountingProductSubUnit::where('bar_code',$q)->pluck('product_id');
            $products=AccountingProduct::whereIn('id',$product_unit)->whereIn('id',$store_product)->get();
            $unit=	AccountingProductSubUnit::where('bar_code',$q)->first();
            if($unit)
                $selectd_unit_id = $unit->id;
            else
                $selectd_unit_id = 0;
        }


        return response()->json([
            'status'=>true,
            'data'=>view('AccountingSystem.sell_points.barcodeProducts',compact('products','selectd_unit_id'))->render()
        ]);


    }
}
