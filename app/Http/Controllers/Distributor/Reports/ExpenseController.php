<?php

namespace App\Http\Controllers\Distributor\Reports;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ExpenditureClause;
use App\Models\ExpenditureType;
use App\Models\Expense;
use App\Models\User;
use Route;

class ExpenseController extends Controller
{
    public function __construct()
    {
        view()->share('distributors', User::query()->where('is_distributor','1')->pluck('name', 'id'));
        view()->share('clients', Client::query()->pluck('name', 'id'));
        view()->share('types', ExpenditureType::query()->pluck('name', 'id'));
        view()->share('clauses', ExpenditureClause::query()->pluck('name', 'id'));


    }
    public function index(Request $request)
    {

        $query = Expense::query();

        if($request->has('user_id') && $request->user_id != null){
             $query = $query->where('user_id',$request->user_id);

        }
        if($request->has('expenditure_type_id') && $request->expenditure_type_id != null){
            $query = $query->where('expenditure_type_id',$request->expenditure_type_id);
        }

        if($request->has('expenditure_clause_id') && $request->expenditure_clause_id != null){
            $query = $query->where('expenditure_clause_id',$request->expenditure_clause_id);
        }
        if($request->has('sanad_No') && $request->sanad_No != null){
            $query = $query->where('sanad_No',$request->sanad_No);
        }
        if($request->has('from') && $request->has('to')){
            $query = $query->whereBetween('date',[$request->from,$request->to]);
        }
        $expenses=$query->orderBy('date')->get();
        return view('distributor.reports.expense_report.index',compact('expenses'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function show(Request $request,$id)
    {
        $expense=Expense::find($id);

        return view('distributor.reports.expense_report.show',compact('expense'));


    }


}
