<?php


namespace App\Traits\Supplier;


use App\Models\SupplierBill;
use Carbon\Carbon;

trait BillsOperations
{
    public function CreateSupplierBill($request){
        $inputs = $request->except('date');
        $inputs['user_id'] = auth()->id();
        $inputs['date'] = Carbon::parse($request->date);
        SupplierBill::create($inputs);
    }

    public function UpdateSupplierBill($request,$bill){
        $inputs = $request->except('date');
        $inputs['user_id'] = auth()->id();
        $inputs['date'] = Carbon::parse($request->date);
        $bill->update($inputs);
    }
}
