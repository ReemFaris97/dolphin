<?php

namespace App\Http\Controllers\Distributor\Reports;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\ExpenseResource;
use App\Http\Resources\Distributor\ExpensesResource;
use App\Http\Resources\Distributor\TransactionResource;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\Expense;
use App\Models\ProductQuantity;
use App\Models\Store;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DistributorOperation;
use App\Traits\Distributor\ExpenseOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;


class DamageController extends Controller
{

    public function __construct()
    {
        view()->share('stores', Store::query()->pluck('name', 'id'));
    }

    public function index()
    {
        $from = Carbon::parse(\request('from'));
        $to = Carbon::parse(\request('to'));


        if (request('from') != null && \request('to') != null  && \request('store_id') != null ) {


            $damages = ProductQuantity::Where('type','damaged')->where('store_id',\request('store_id'))->whereBetween('created_at', [$from, $to])->orderBy('date', 'DESC')
                ->get();
        } elseif (request('from') != null && \request('to') != null  && \request('store_id') == null ) {
            $damages = ProductQuantity::whereBetween('created_at', [$from, $to])->orderBy('date', 'DESC')
                ->get();
        }else{
            $damages = ProductQuantity::orderBy('date', 'DESC')
                ->get();
        }

        return view('distributor.reports.damages.index',compact('damages'));
    }



    public function show(Request $request,$id)
    {
        $damage=ProductQuantity::find($id);
        return view('distributor.reports.damages.show',compact('damage'));
    }


}