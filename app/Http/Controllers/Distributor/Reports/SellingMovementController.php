<?php

namespace App\Http\Controllers\Distributor\Reports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttachedProducts;
use App\Models\Client;
use App\Models\DistributorTransaction;
use App\Models\RouteTrips;
use App\Models\TripInventory;
use App\Models\User;
use DB;

class SellingMovementController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor', '1')->pluck('name', 'id'));
    }
    public function index(Request $request)
    {
        return view('distributor.reports.selling_movement_report.index');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request)
    {

        $this->validate($request, ['trip_id' => 'required|integer|exists:trip_inventories,id']);
        /* 53 */
        $trips = TripInventory::select('*')
            ->withReportProducts()
            ->WithPreviousTripInventory()
            ->WithPreviousTripReport()
            ->withTripClientAndRoute()
            ->with([
                'products',
                'previous_trip_report',
                'previous_trip_inventory',

            ])
            ->FilterRoute($request->route_id)
            ->filterDistributor($request->distributor_id)
            ->filterWithDates($request->date_from, $request->date_to)
            ->find($request->trip_id);
        $products = collect([]);

        $product_stub = [
            'product_name' => null,
            'product_id' => null,
            'exists' => 0,
            'sells' => 0,
            'selling' => 0,
        ];

        // dd($trips->previous_trip_report);
        //inventory products
        foreach ($trips->products ?? [] as $product) {
            $product_item = $product_stub;
            $product_item['product_name'] = $product->product->name;
            $product_item['product_id'] = $product->product_id;

            if ($products->has($product->product_id)) {
                $product_item = $products->get($product->product_id);
            }
            $product_item['exists'] = $product->quantity;
            $pervious_sells = 0;
            $pervious_exists = 0;
            if ($trips->previous_trip_report != null) {
            $pervious_sells = $trips->previous_trip_report->products->where('product_id', $product->product_id)->sum('quantity');
            $pervious_exists = $trips->previous_trip_inventory->products->where('product_id', $product->product_id)->sum('quantity');
            }
            $selling = ($pervious_sells + $pervious_exists) - $product->quantity;
            $product_item['selling'] = $selling;
            $products[$product->product_id] = $product_item;
        }


        foreach ($trips->trip_report->products ?? [] as $product) {
            $product_item = $product_stub;
            $product_item['product_id'] = $product->product_id;

            if ($products->has($product->product_id)) {
                $product_item = $products->get($product->product_id);
            }
            $product_item['sells'] = $product->quantity;
            $products[$product->product_id] = $product_item;
        }

        return view('distributor.reports.selling_movement_report.show', compact('trips', 'products'));
    }
}
