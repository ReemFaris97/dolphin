<?php

namespace App\Http\Controllers\Distributor\Reports;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductQuantity;
use App\User;

class StoreMovementController extends Controller
{
    public function __construct()
    {
        view()->share('stores', Store::query()->pluck('name', 'id'));
        view()->share('products', Product::query()->pluck('name', 'id'));
    }
    public function index(Request $request)
    {
        return view('distributor.reports.store_movment_report.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request)
    {
        ProductQuantity::with('product', 'distributor', 'store', 'store_transfer_request');
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
            'data' => view(
                'distributor.storeTransferRequest.getAjaxProducts',
                [
                    'products' => $stores
                ]
            )->render()
        ]);
    }
    /**
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
