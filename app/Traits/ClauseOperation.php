<?php


namespace App\Traits;



use App\Models\Charge;
use App\Models\Clause;
use Illuminate\Support\Arr;

trait ClauseOperation
{
    /**
     * Register New Clause
     *
     * @param $request
     * @return mixed
     */
    public function RegisterClause($request)
  {
      $inputs = $request->all();
     $clause = Clause::create($inputs);
       return $clause;
  }


    /**
     * Update Clause
     *
     * @param $clause
     * @param $request
     * @return mixed
     */
    public function UpdateClause($clause,$request)
    {
        $inputs = $request->all();
        return $clause->update($inputs);
    }

    /**
     * Register New Charge Log
     *
     * @param $request
     * @return mixed
     */
    public function AddClauseLog($request)
    {
        foreach ($request->clauses as $key=>$c)
        {
            $clause = Clause::find($key);
           if ($clause)
           {
               $clause->logs()->create(['amount'=>$c, 'user_id'=>auth()->user()->id,]);
                Clause::find($key)->update([
                   'amount'=>$c
               ]);
           }
        }
        return true;
    }

   public function AddClauseLogWithJson($clauses)
    {
//dd($clauses);
        foreach ($clauses as $key=>$c)
        {
            $clause = Clause::find($key);
           if ($clause)
           {
               $clause->logs()->create(['amount'=>$c, 'user_id'=>auth()->user()->id]);
               $clause->update(['amount'=>$c]);
           }
        }
        return true;
    }
}
