<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingProductTax;
use App\Models\AccountingSystem\AccountingPurchase as Purchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn as PurchaseReturn;
use App\Models\AccountingSystem\AccountingPurchaseItem;
use Carbon\Carbon;

class PurchasesController extends Controller
{
    
    public function index(Request $request)
   	{
   		
   		if ($request->has('company_id')) {
   			$purchases = Purchase::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

            if ($request->has('branch_id') && $request->branch_id != null) {
               $purchases = $purchases->where('branch_id', $request->branch_id);
            }

   			if ($request->has('safe_id') && $request->safe_id != null ) {
   				$purchases = $purchases->where('safe_id', $request->safe_id);
   			}

   			if ($request->has('user_id') && $request->user_id != null ) {
   				$purchases = $purchases->where('user_id', $request->user_id);
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
            // dd($purchases);
   		} else {
   			$purchases = collect();
   		}
   		return view('AccountingSystem.reports.purchases.for-period', compact('purchases'));
   	}

      public function details()
      {
         $purchases = Purchase::whereDate('created_at', request('date'))->get();
         return view('AccountingSystem.reports.purchase-details', compact('purchases'));  
      }

      public function byDay(Request $request)
      {
         if ($request->has('company_id')) {
            $purchases = Purchase::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

            if ($request->has('branch_id') && $request->branch_id != null) {
               $purchases = $purchases->where('branch_id', $request->branch_id);
            }

            if ($request->has('safe_id') && $request->safe_id != null ) {
               $purchases = $purchases->where('safe_id', $request->safe_id);
            }

            if ($request->has('user_id') && $request->user_id != null ) {
               $purchases = $purchases->where('user_id', $request->user_id);
            }

            if ($request->has('product_id') && $request->product_id != null ) {
               $purchases = $purchases->whereHas('items', function ($item) use ($request) {
                  $item->where('product_id', $request->product_id);
               });
            }

            if ($request->has('date') && $request->date != null) {
               $purchases = $purchases->whereDate('created_at', Carbon::parse($request->date));
            }

            $purchases = $purchases->groupBy('date')->get();
            // dd($purchases);
         } else {
            $purchases = collect();
         }
         return view('AccountingSystem.reports.purchases.day', compact('purchases'));
      
      }

      public function returnsPeriod(Request $request)
      {
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

            if ($request->has('product_id') && $request->product_id != null ) {
               $purchases = $purchases->whereHas('items', function ($item) use ($request) {
                  $item->where('product_id', $request->product_id);
               });
            }

            if ($request->has('from') && $request->has('to')) {
               $purchases = $purchases->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
            }

            $purchases = $purchases->groupBy('date')->get();
            // dd($purchases);
         } else {
            $purchases = collect();
         }
         return view('AccountingSystem.reports.purchases.for-period', compact('purchases'));
      }

      public function returnsDay(Request $request)
      {
         if ($request->has('company_id')) {
            $purchases = PurchaseReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

            if ($request->has('branch_id') && $request->branch_id != null) {
               $purchases = $purchases->where('branch_id', $request->branch_id);
            }

            if ($request->has('safe_id') && $request->safe_id != null ) {
               $purchases = $purchases->where('safe_id', $request->safe_id);
            }

            if ($request->has('user_id') && $request->user_id != null ) {
               $purchases = $purchases->where('user_id', $request->user_id);
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
            // dd($purchases);
         } else {
            $purchases = collect();
         }
         return view('AccountingSystem.reports.purchases.returns-period', compact('purchases'));
      }

      public function returnDetails()
      {
         $purchases = PurchaseReturn::whereDate('created_at', request('date'))->get();
         return view('AccountingSystem.reports.purchases.return-details', compact('purchases'));  
      }
}
