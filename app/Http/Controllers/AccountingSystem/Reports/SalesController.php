<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingSale as Sale;
use Carbon\Carbon;

class SalesController extends Controller
{
    
    public function index(Request $request)
    {
   		
        if ($request->has('company_id')) {
            $sales = Sale::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

         if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
         }

            if ($request->has('safe_id') && $request->safe_id != null ) {
                $sales = $sales->where('safe_id', $request->safe_id);
            }

            if ($request->has('user_id') && $request->user_id != null ) {
                $sales = $sales->where('user_id', $request->user_id);
            }

         if ($request->has('product_id') && $request->product_id != null ) {
            $sales = $sales->whereHas('items', function ($item) use ($request) {
               $item->where('product_id', $request->product_id);
            });
         }

            if ($request->has('from') && $request->has('to')) {
                $sales = $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
            }

            $sales = $sales->groupBy('date')->get();
         // dd($sales);
        } else {
            $sales = collect();
        }
        return view('AccountingSystem.reports.sales.for-period', compact('sales'));
    }

   public function details()
   {
      $sales = Purchase::whereDate('created_at', request('date'))->get();
      return view('AccountingSystem.reports.purchase-details', compact('sales'));  
   }

   public function byDay(Request $request)
   {
      if ($request->has('company_id')) {
         $sales = Purchase::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

         if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
         }

         if ($request->has('safe_id') && $request->safe_id != null ) {
            $sales = $sales->where('safe_id', $request->safe_id);
         }

         if ($request->has('user_id') && $request->user_id != null ) {
            $sales = $sales->where('user_id', $request->user_id);
         }

         if ($request->has('product_id') && $request->product_id != null ) {
            $sales = $sales->whereHas('items', function ($item) use ($request) {
               $item->where('product_id', $request->product_id);
            });
         }

         if ($request->has('date') && $request->date != null) {
            $sales = $sales->whereDate('created_at', Carbon::parse($request->date));
         }

         $sales = $sales->groupBy('date')->get();
         // dd($sales);
      } else {
         $sales = collect();
      }
      return view('AccountingSystem.reports.sales.day', compact('sales'));
   
   }

   public function returnsPeriod(Request $request)
   {
      if ($request->has('company_id')) {
         $sales = PurchaseReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),\DB::raw('sum(( total WHEN payment = agel THEN total END )) as return_agel'), \DB::raw('sum(( total WHEN payment = cash THEN total END )) as return_cash'),'created_at');

         if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
         }

         if ($request->has('safe_id') && $request->safe_id != null ) {
            $sales = $sales->where('safe_id', $request->safe_id);
         }

         if ($request->has('user_id') && $request->user_id != null ) {
            $sales = $sales->where('user_id', $request->user_id);
         }

         if ($request->has('product_id') && $request->product_id != null ) {
            $sales = $sales->whereHas('items', function ($item) use ($request) {
               $item->where('product_id', $request->product_id);
            });
         }

         if ($request->has('from') && $request->has('to')) {
            $sales = $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
         }

         $sales = $sales->groupBy('date')->get();
         // dd($sales);
      } else {
         $sales = collect();
      }
      return view('AccountingSystem.reports.sales.for-period', compact('sales'));
   }

   public function returnsDay(Request $request)
   {
      if ($request->has('company_id')) {
         $sales = PurchaseReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

         if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
         }

         if ($request->has('safe_id') && $request->safe_id != null ) {
            $sales = $sales->where('safe_id', $request->safe_id);
         }

         if ($request->has('user_id') && $request->user_id != null ) {
            $sales = $sales->where('user_id', $request->user_id);
         }

         if ($request->has('product_id') && $request->product_id != null ) {
            $sales = $sales->whereHas('items', function ($item) use ($request) {
               $item->where('product_id', $request->product_id);
            });
         }

         if ($request->has('from') && $request->has('to')) {
            $sales = $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
         }

         $sales = $sales->groupBy('date')->get();
         // dd($sales);
      } else {
         $sales = collect();
      }
      return view('AccountingSystem.reports.sales.returns-period', compact('sales'));
   }

   public function returnDetails()
   {
      $sales = PurchaseReturn::whereDate('created_at', request('date'))->get();
      return view('AccountingSystem.reports.sales.return-details', compact('sales'));  
   }
}
