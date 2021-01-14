<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\ExpenseResource;
use App\Http\Resources\Distributor\ExpensesResource;
use App\Http\Resources\Distributor\TransactionResource;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\Expense;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DistributorOperation;
use App\Traits\Distributor\ExpenseOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;


class ExpenseController extends Controller
{
    use ApiResponses, ExpenseOperation;


    public function index()
    {


        if (request('from') != null && \request('to')) {

            $from = Carbon::parse(\request('from'));
            $to = Carbon::parse(\request('to'));

            $expenses = Expense::Where('user_id', auth()->user()->id)->whereBetween('date', [$from, $to])->orderBy('date', 'DESC')
                ->paginate($this->paginateNumber);
        } else {
            $expenses = Expense::Where('user_id', auth()->user()->id)->orderBy('date', 'DESC')
                ->paginate($this->paginateNumber);
        }

        return $this->apiResponse(new ExpensesResource($expenses));
    }

    public function store(Request $request)
    {
        $rules = [

//            'distributor_route_id'=> 'required|integer|exists:distributor_routes,id',
            'expenditure_clause_id' => 'required|integer|exists:expenditure_clauses,id',
            'expenditure_type_id' => 'required|integer|exists:expenditure_types,id',
            'date' => 'nullable|date',
            'time' => 'nullable|string',
            'image' => 'nullable|mimes:jpg,jpeg,gif,png',
            'amount' => 'required|numeric',
            'notes' => 'required|string',
            'reader_name' => 'nullable|string',
            'reader_number' => 'nullable|string',
            'reader_image' => 'nullable|mimes:jpg,jpeg,gif,png',
        ];
        $validation = $this->apiValidation($request, $rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $request['user_id'] = auth()->user()->id;

        if (DistributorRoute::where('user_id', auth()->id())->where('is_active', 1)->count() == 0) {
            return $this->apiResponse(null, ['date' => __("no active route")], 422);

        }
        $expense = $this->AddExpense($request);
        return $this->apiResponse(['msg' => 'العملية تمت بنجاح', 'data' => new ExpenseResource($expense)]);
    }

}
