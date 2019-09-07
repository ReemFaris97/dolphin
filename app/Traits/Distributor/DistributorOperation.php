<?php


namespace App\Traits\Distributor;



use App\Models\Charge;
use App\Models\Clause;
use App\Models\DistributorTransaction;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Arr;

trait DistributorOperation
{
    /**
     * Register New Clause
     *
     * @param $request
     * @return mixed
     */
    public function AddTransaction($request)
  {
      $inputs = $request->all();
     $clause = DistributorTransaction::create($inputs);
       return $clause;
  }


}
