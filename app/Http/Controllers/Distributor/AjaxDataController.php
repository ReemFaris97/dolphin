<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductQuantity;
use App\User;

class AjaxDataController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAllStoresById(Request $request)
    {
        $stores = Store::where('store_category_id', $request->id)->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.products.getAjaxStoreByCategoryId')->with('stores', $stores)->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAllProducts(Request $request)
    {
        $products = Product::whereStoreId($request->id)->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.storeTransferRequest.getAjaxProducts')->with('products', $products)->render()
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getsender(Request $request)
    {
        //dd($request->all());
        $users = User::where('id', '!=', $request->id)->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.transactions.getAjaxSenders')->with('users', $users)->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getDistributorStores(Request $request)
    {
        //dd($request->all());
        $stores = Store::where('distributor_id', '!=', $request->user_id)->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.storeTransferRequest.getAjaxProducts',
                [
                    'products' => $stores
                ]
            )->render()
        ]);
    } /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getStoreProducts(Request $request)
    {

        return response()->json([
            'status' => true,
            'data' => view(
                'distributor.stores.getAjaxStoreProducts',
                [
                    'quantities' => ProductQuantity::with('product')->where('store_id', $request->store_id)->TotalQuantity()->get()
                ]
            )->render()
        ]);
    }
}
