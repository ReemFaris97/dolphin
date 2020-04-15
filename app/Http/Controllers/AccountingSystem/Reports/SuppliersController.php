<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingPurchase as Purchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn as PurchaseReturn;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class SuppliersController extends Controller
{

    public function purchases(Request $request)
    {
        $users=User::where('is_saler',1)->get();
        $requests=request()->all();
        if ($request->has('company_id')) {
            $purchases = Purchase::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

            if ($request->has('branch_id') && $request->branch_id != null) {
                $purchases = $purchases->where('branch_id', $request->branch_id);
            }

//   			if ($request->has('safe_id') && $request->safe_id != null ) {
//   				$purchases = $purchases->where('safe_id', $request->safe_id);
//   			}

            if ($request->has('user_id') && $request->user_id != null ) {
                $purchases = $purchases->where('user_id', $request->user_id);
            }

            if ($request->has('supplier_id') && $request->supplier_id != null ) {
                $purchases = $purchases->where('supplier_id', $request->supplier_id);
            }

            if ($request->has('product_id') && $request->product_id != null ) {
                $purchases = $purchases->whereHas('items', function ($item) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }
            if ($request->has('from') && $request->has('to')) {

                $purchases = $purchases->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
            }
            $purchases = $purchases->groupBy('date')->get();

        } else {
            $purchases = collect();
        }


        return view('AccountingSystem.reports.suppliers.for-period', compact('purchases','users','requests'));
    }


    public function purchasesReturns(Request $request)
    {
        $requests=request()->all();
        if ($request->has('company_id')) {
            $purchases = PurchaseReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),\DB::raw('sum(( total WHEN payment = agel THEN total END )) as return_agel'), \DB::raw('sum(( total WHEN payment = cash THEN total END )) as return_cash'),'created_at');

            if ($request->has('branch_id') && $request->branch_id != null) {
                $purchases = $purchases->where('branch_id', $request->branch_id);
            }

            if ($request->has('safe_id') && $request->safe_id != null ) {
                $purchases = $purchases->where('safe_id', $request->safe_id);
            }

            if ($request->has('user_id') && $request->user_id != null ) {
                $purchases = $purchases->where('user_id', $request->user_id);
            }

            if ($request->has('supplier_id') && $request->supplier_id != null ) {
                $purchases = $purchases->where('supplier_id', $request->supplier_id);
            }

            if ($request->has('product_id') && $request->product_id != null ) {
                $purchases = $purchases->whereHas('items', function ($item) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }

            if ($request->has('from') && $request->has('to')) {
                $purchases = $purchases->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
            }

            $purchases = $purchases->groupBy('date')->get();
//             dd($purchases);
        } else {
            $purchases = collect();
        }
        return view('AccountingSystem.reports.suppliers.returns-period', compact('purchases','requests'));
    }


}
