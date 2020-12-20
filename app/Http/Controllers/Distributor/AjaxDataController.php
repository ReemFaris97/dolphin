<?php

namespace App\Http\Controllers\Distributor;

use App\Models\ExpenditureClause;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DistributorCar;
use App\Models\DistributorRoute;
use App\Models\ProductQuantity;
use App\Models\TripInventory;
use App\Models\User;
use DB;

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

    public function getAllStores($id)
    {
        $stores = Store::where('distributor_id',$id)->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.dailyReports.getAjaxStores')->with('stores', $stores)->render()
        ]);
    }
    public function getAjaxClauses($id)
    {
        $clauses = ExpenditureClause::where('expenditure_type_id',$id)->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.expenses.getAjaxClauses')->with('clauses', $clauses)->render()
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
    public function getcars(Request $request)
    {
        //dd($request->all());
        $cars = DistributorCar::where('user_id', $request->id)->select(['id', 'car_name as name'])->get();
        return response()->json([
            'status' => true,
            'data' => view('distributor.stores.getAjaxProducts')->with('cars', $cars)->render()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getDistributorStores(Request $request)
    {

        if ($request->user_id == null) {

            $stores = Store::where('for_distributor', 0)->get();
        } else {
            $stores = Store::where('distributor_id', $request->user_id)->get();
        }
        return response()->json([
            'status' => true,
            'data' => view(
                'distributor.products.getAjaxStoreByCategoryId',
                [
                    'stores' => $stores
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getDistributorRoutes(Request $request)
    {

        return response()->json([
            'status' => true,
            'data' => view(
                'distributor.stores.getAjaxProducts',
                [
                    'cars' => DistributorRoute::where('user_id', $request->distributor_id)->get()
                ]
            )->render()
        ]);
    }
    public function getDistributorTripsOnRoute(Request $request)
    {

        return response()->json([
            'status' => true,
            'data' => view(
                'distributor.stores.getAjaxProducts',
                [
                    'cars' => TripInventory
                        ::FilterRoute($request->route_id)
                        ->filterDistributor($request->distributor_id)
                        ->select(DB::raw('created_at as name ,id'))
                        ->get()
                ]
            )->render()
        ]);
    }
}
