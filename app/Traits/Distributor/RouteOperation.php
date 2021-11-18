<?php


namespace App\Traits\Distributor;

use App\Models\Client;
use App\Models\ClientClassProduct;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\RouteReport;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\Store;
use App\Models\TripInventory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


trait RouteOperation
{

    public function RegisterInventory($request)
    {
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $route_trip = RouteTrips::find($request->trip_id);
            $inputs['round'] = $route_trip->route->round;
            $route_trip->update([
                'status' => $request->status,
                'round' => $route_trip->route->round + ($request->status == 'refuse' ? 1 : 0)
            ]);
            $trip = TripInventory::create($inputs);
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $trip->products()->create([
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'product_id' => $product->id
                ]);
            }

            foreach ($request->images as $image) {
                $trip->images()->create(['image' => saveImage($image, 'users')]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            // dd($e);
            return false;
        }
    }


    public function RegisterBill($request, RouteTrips $trip)
    {
        DB::beginTransaction();
        try {
            $transaction = DistributorTransaction::create([
                'sender_type' => Client::class,
                'sender_id' => $trip->client_id,
                'receiver_type' => User::class,
                'receiver_id' => auth()->id(),
                'amount' => $request->cash + $request->visa,
                'received_at' => Carbon::now()
            ]);

            $trip_report = RouteTripReport::create([
                'route_trip_id' => $trip->id,
                'round' => $trip->round,
                'cash' => $request->cash,
                'visa' => $request->visa,
                'notes' => $request->notes,
                'store_id' => $request->store_id,
                'distributor_transaction_id' => $transaction->id,
            ]);
            $class_id = $trip->client->client_class_id;
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $trip_report->products()->create([
                    'quantity' => $item['quantity'],
                    'price' =>  optional(ClientClassProduct::query()
                                ->where('product_id', $item['product_id'])
                                ->where('client_class_id', $class_id)->first())
                                ->price ?? $product->price,
                    'product_id' => $product->id,
                    'transaction_id' => $transaction->id,

                ]);

                ProductQuantity::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->id(),
                    'quantity' => $item['quantity'],
                    'type' => 'out',
                    'is_confirmed' => 1,
                    'store_id' => $request->store_id,
                    'trip_report_id' => $trip_report->id
                ]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function RegisterRouteReport($request)
    {

        $inputs = $request->all();
        if ($request->image != null) {
            if ($request->hasFile('image')) {
                $inputs['image'] = saveImage($request->image, 'users');
            }
        }
        /** @var \App\Models\DistributorRoute $current_route */
        $current_route = DistributorRoute::find($request->route_id);
        $inputs['round'] = $current_route->round;
        $user_routes = DistributorRoute::where('user_id', $current_route->user_id)
            ->orderBy('round', 'desc')
            ->orderBy('arrange', 'desc')
            ->first();
        DB::beginTransaction();
        try {
            $current_route->fill(
                [
                    'is_finished' => 0,
                    'arrange' => $user_routes->arrange + 1,
                    'is_active' => 0,
                    'round' => $inputs['round'] + 1,
                    'received_code' => mt_rand(1000000, 9999999)
                ]
            )->save();
            $report = RouteReport::query()->create($inputs);
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);

                $report->products()->create([
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);
            }
            $current_route->trips()->update([
                'round' => $inputs['round'] + 1,
                'status' => 'pending',
            ]);
            DB::commit();

            return $report;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
        }
    }

    public function damageProduct(Request $request)
    {

        $damage_store = Store::ofDistributor(auth()->id())->where('for_damaged', 1)->first() ?? User::find(auth()->id())->createDamageStore();
        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'users');
        }
        \DB::beginTransaction();
        $arr = [];
        foreach ($request->products ?? [] as $product) {

            $arr[] = ProductQuantity::create([
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'image' => $request->hasFile('image') ? saveImage($request->image, 'users') : null,
                'store_id' => $damage_store->id,
                'user_id' => auth()->id(),
                'type' => 'in',
                'round' => $request->round,
                'route_trip_id' => $request->route_trip_id,

            ]);
        }
        \DB::commit();

        return $arr;
    }
}
