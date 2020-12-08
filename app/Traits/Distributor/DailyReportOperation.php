<?php


namespace App\Traits\Distributor;


use App\Events\TaskCreated;
use App\Events\TaskFinished;
use App\Events\TaskRated;
use App\Events\WorkerTaskFinished;
use App\Models\Charge;
use App\Models\DailyReport;
use App\Models\Image;
use App\Models\Note;
use App\Models\Product;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


trait DailyReportOperation
{

    public function RegisterDailyReport($request)
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

            $report = DailyReport::create($inputs);
            foreach ($request->products as $item)
            {
                $product = Product::find($item['product_id']);
                $report->products()->create(['quantity'=> $item['quantity'],
                'price'=>$product->price]);
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
