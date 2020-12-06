<?php

namespace App\Http\Controllers\Distributor\Reports;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductQuantity;
use App\Models\User;

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
        /* FilterWithDates
FilterWithProduct
FilterWithStore */


        return view('distributor.reports.store_movment_report.show', [
            'products' => ProductQuantity::filterWithDates($request->from_date, $request->to_date)
                ->FilterWithProduct($request->product_id)
                ->FilterWithStore($request->store_id)
                ->with(
                    'product',
                    'distributor',
                    'store',
                    'store_transfer_request'
                )->get()
        ]);
    }

}
