<?php


namespace App\Traits\Distributor;

use App\Models\Client;
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
use Illuminate\Support\Facades\DB;


trait RouteOperation
{

    public function RegisterInventory($request)
    {
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            $route_trip = RouteTrips::find($request->trip_id);
            $inputs['round'] = $route_trip->round;
            if ($request->status == "refused") {
                $route_trip->update([
                    'status' => $request->status
                ]);
            }
            $trip = TripInventory::create($inputs);
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $trip->products()->create([
                    'quantity' => $item['quantity'],
                    'price' => $product->price

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
            $transaction= DistributorTransaction::create([
                'sender_type' => Client::class,
                'sender_id' => $trip->client_id,
                'receiver_type' => User::class,
                'receiver_id' => auth()->id(),
                'amount' => $request->cash,
                'received_at' => Carbon::now()
            ]);

            $trip_report = RouteTripReport::create([
                'route_trip_id' => $trip->id,
                'round' => $trip->round,
                'cash' => $request->cash,
                'notes' => $request->notes,
                'store_id' => $request->store_id,
                'distributor_transaction_id' => $transaction->id,
            ]);
            foreach ($request->products as $item) {
                $product = Product::find($item['product_id']);
                $trip_report->products()->create([
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
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
                    'trip_report_id'=>$trip_report->id
                ]);



            //    $trip->update(['cash' => $request->cash]);

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
        DB::beginTransaction();
        try {
            $inputs = $request->all();
            if ($request->image != null) {
                if ($request->hasFile('image')) {
                    $inputs['image'] = saveImage($request->image, 'users');
                }
            }
            /** @var \App\Models\DistributorRoute  $current_route*/
            $current_route = DistributorRoute::find($request->route_id);
            $inputs['round'] = $current_route->round + 1;
            $user_routes = DistributorRoute::where('user_id', $current_route->user_id)
            ->orderBy('round', 'desc')
            ->orderBy('arrange', 'desc')
            ->first('arrange');
            $current_route->fill(
                [
                    'is_finished' => 1,
                    'arrange' => $user_routes->arrange + 1,
                    'is_active' => 0,
                    'round' => $inputs['round']
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
                'round' => $inputs['round'],
                'status' => 'pending',
            ]);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

}
