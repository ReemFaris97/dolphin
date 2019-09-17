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
//      $inputs = $request->all();
//      $clause = Expense::create($inputs);

      $inputs=$request->all();

      if ($request->hasFile('image')&& $request->image !=null) {

          $inputs['image'] =  saveImage($request->image, 'photos');
      }
      if ($request->hasFile('reader_image')&& $request->reader_image !=null) {
          $inputs['reader_image'] = saveImage($request->reader_image, 'photos');
      }

      $clause=  Expense::create($inputs);
       return $clause;
  }


}
