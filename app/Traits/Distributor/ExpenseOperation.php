<?php


namespace App\Traits\Distributor;



use App\Models\Charge;
use App\Models\Clause;
use App\Models\DistributorTransaction;
use App\Models\Expense;
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
      $inputs = $request->all();
     $clause = Expense::create($inputs);
       return $clause;
  }


}
