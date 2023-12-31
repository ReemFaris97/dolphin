<?php


namespace App\Traits\Distributor;


use App\Events\TaskCreated;
use App\Events\TaskFinished;
use App\Events\TaskRated;
use App\Events\WorkerTaskFinished;
use App\Models\Charge;
use App\Models\DailyReport;
use App\Models\DistributorRoute;
use App\Models\Image;
use App\Models\Note;
use App\Models\Product;
use App\Models\RouteReport;
use App\Models\RouteTrips;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\TripInventory;
use App\User;
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
            if ($request->status == "refused")
            {
                $route_trip->update(['status'=>$request->status]);
            }
            $trip = TripInventory::create($inputs);
            foreach ($request->products as $item)
            {
                $product = Product::find($item['product_id']);
                $trip->products()->create(['quantity'=> $item['quantity'],'price'=>$product->price]);
            }

            foreach ($request->images as $image)
            {
                $trip->images()->create(['image'=>saveImage($image,'users')]);
            }

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }


    public function RegisterBill($request,$trip)
    {
        DB::beginTransaction();
        try {
            foreach ($request->products as $item)
            {
                $product = Product::find($item['product_id']);
                $trip->products()->create(['quantity'=> $item['quantity'],'price'=>$product->price]);
                $trip->update(['cash'=>$request->cash]);
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
            if ($request->image != null)
            {
                if ($request->hasFile('image')) {
                    $inputs['image'] = saveImage($request->image,'users');
                }
            }

            DistributorRoute::find($request->route_id)->update(['is_finished'=>1]);

            $report = RouteReport::create($inputs);
            foreach ($request->products as $item)
            {
                $product = Product::find($item['product_id']);
                $report->products()->create(['quantity'=> $item['quantity'],'price'=>$product->price]);
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

}
