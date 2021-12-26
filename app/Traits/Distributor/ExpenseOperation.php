<?php


namespace App\Traits\Distributor;

use App\Models\Charge;
use App\Models\Clause;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\Expense;
use App\Models\User;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;

trait ExpenseOperation
{
    /**
     * Register New Expense
     *
     * @param $request
     * @return mixed
     */
    public function AddExpense($request)
    {
        //      $inputs = $request->all();
        //      $clause = Expense::create($inputs);

        $inputs = $request->all();

        if ($request->hasFile('image') && $request->image != null) {
            $inputs['image'] = saveImage($request->image, 'photos');
        }
        if ($request->hasFile('reader_image') && $request->reader_image != null) {
            $inputs['reader_image'] = saveImage($request->reader_image, 'photos');
        }

        $inputs['sanad_No'] = mt_rand(1000000, 9999999);
        //        dd(DistributorRoute::where('user_id', auth()->id())->get());
        $active_route = DistributorRoute::where('user_id', auth()->id())->orderBy('round', 'asc')
            ->orderBy('arrange', 'asc')->first();

        $inputs['distributor_route_id'] = optional($active_route)->id;
        $inputs['round'] = optional($active_route)->round;
        $inputs['date'] = date('Y-m-d');
        $inputs['time'] = date('H:i:s');
        //        $inputs['route_trip_id']=
        \DB::beginTransaction();
        $clause = Expense::create($inputs);
        if ($clause->clause->type==0) {
            DistributorTransaction::create([
            'sender_type' => User::class,
            'sender_id' => auth()->id(),
            'receiver_type' => Expense::class,
            'receiver_id' => $clause->id,
            'amount' => $request->amount,
            'received_at' => Carbon::now(),
        ]);
        } else {

            // TODO:: add the expenses as accounting purcheses
        }
        \DB::commit();
        return $clause;
    }
}
