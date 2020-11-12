<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AjaxDataController extends Controller
{
    public function getAllStoresById(Request $request){
        $stores = Store::where('store_category_id',$request->id)->get();
        return response()->json([
            'status' => true,
            'data'   => view('distributor.products.getAjaxStoreByCategoryId')->with('stores',$stores)->render()
        ]);
    }

    public function getAllProducts(Request $request){
        $products = Product::whereStoreId($request->id)->get();
        return response()->json([
            'status'=>true,
            'data'=>view('distributor.storeTransferRequest.getAjaxProducts')->with('products',$products)->render()
        ]);
    }


    public function getsender(Request $request){
        //dd($request->all());
        $users =User::where('id','!=',$request->id)->get();
        return response()->json([
            'status'=>true,
            'data'=>view('distributor.transactions.getAjaxSenders')->with('users',$users)->render()
        ]);
    }
}
