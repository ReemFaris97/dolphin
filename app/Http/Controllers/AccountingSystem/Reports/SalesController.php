<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSale;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingSale as Sale;
use Carbon\Carbon;

class SalesController extends Controller
{
    
    public function index(Request $request)
    {
        $requests=request()->all();
        if ($request->has('company_id')) {
            $sales = Sale::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

         if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
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
        return view('AccountingSystem.reports.sales.for-period', compact('sales','requests'));
    }

   public function details()
   {
      $sales = Sale::whereDate('created_at', request('date'))->get();
      return view('AccountingSystem.reports.sales.sale-details', compact('sales'));
   }

   public function byDay(Request $request)
   {
       $requests=request()->all();
      if ($request->has('company_id')) {
         $sales = Sale::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

         if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
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

      } else {
         $sales = collect();
      }
      return view('AccountingSystem.reports.sales.day', compact('sales','requests'));
   
   }

   public function returnsPeriod(Request $request)
   {
       $requests=request()->all();
//       dd("dsf");

      if ($request->has('company_id')) {
         $sales = AccountingReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');


          if ($request->has('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
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
      return view('AccountingSystem.reports.sales.returns-period', compact('sales','requests'));
   }

   public function returnsDay(Request $request)
   {
       $requests=request()->all();
      if ($request->has('company_id')) {
         $sales = AccountingReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

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
      return view('AccountingSystem.reports.sales.returns-day', compact('sales','requests'));
   }

   public function returnDetails()
   {
      $sales = AccountingReturn::whereDate('created_at', request('date'))->get();
      return view('AccountingSystem.reports.sales.return-details', compact('sales'));  
   }

   public  function daily_earnings(Request $request){
       if ($request->has('company_id')) {
           $sales = AccountingSale::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');
           if ($request->has('branch_id') && $request->branch_id != null) {
               $sales = $sales->where('branch_id', $request->branch_id);
           }
           if ($request->has('session_id') && $request->session_id != null ) {
               $sales = $sales->where('session_id', $request->session_id);
           }
           if ($request->has('user_id') && $request->user_id != null ) {
               $sales = $sales->where('user_id', $request->user_id);
           }
           if ($request->has('product_id') && $request->product_id != null ) {
            ;
               $sales = $sales->whereHas('items', function ($item) use ($request) {
                   $item->where('product_id', $request->product_id);

               });

           }
           if ($request->has('date') && $request->date != null) {

               $sales=$sales->whereDate('created_at',Carbon::parse($request->date));
//               $sales_bills = $sales_bills->whereDate('created_at',Carbon::parse($request->date));
           }
           $sales = $sales->groupBy('date')->get();



           $purchases = AccountingPurchase::join('accounting_purchases_items', 'accounting_purchases.id', '=', 'accounting_purchases_items.purchase_id')
               ->select('accounting_purchases.id',
                   \DB::raw('DATE(accounting_purchases.created_at) as date'),
                   \DB::raw('count(*) as num'),
                   \DB::raw('sum(accounting_purchases.total) as all_total'),
                   \DB::raw('sum(accounting_purchases.amount) as all_amounts'),
                   \DB::raw('sum(accounting_purchases.totalTaxs) as total_tax'),
                   \DB::raw('sum(accounting_purchases.discount) as discounts'),
                   \DB::raw('sum(accounting_purchases_items.price_after_tax) as item_price'),
                   'accounting_purchases.created_at');

           dd($purchases->get());
       } else {
           $sales = collect();

       }
       return view('AccountingSystem.reports.sales.daily-earnings', compact('sales','purchase_cost','sales_bills'));
   }
    public  function period_earnings(Request $request){
        if ($request->has('company_id')) {
            $sales = AccountingSale::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(discount) as discounts'),'created_at');

            $sales_bills=AccountingSale::all();
            if ($request->has('branch_id') && $request->branch_id != null) {
                $sales = $sales->where('branch_id', $request->branch_id);
                $sales_bills = $sales_bills->where('branch_id', $request->branch_id);
            }
            if ($request->has('session_id') && $request->session_id != null ) {
                $sales = $sales->where('session_id', $request->session_id);
                $sales_bills = $sales_bills->where('session_id', $request->session_id);
            }
            if ($request->has('user_id') && $request->user_id != null ) {
                $sales = $sales->where('user_id', $request->user_id);
                $sales_bills = $sales_bills->where('user_id', $request->user_id);
                dd($sales);

            }
            if ($request->has('from') && $request->from != null &&$request->has('user_id') && $request->user_id != null) {
                $sales = $sales->whereDate('created_at', Carbon::parse($request->date));
                $sales_bills=AccountingSale::whereBetween('created_at',[ Carbon::parse($request->from),Carbon::parse($request->to)])->get();
            }
            if ($request->has('product_id') && $request->product_id != null  ) {
                $sales->whereHas('items', function ($item) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
                foreach ($sales_bills as $bill) {
                    $sales_bills=[];
                    $bill->whereHas('items', function ($item) use ($request) {
                        $item->where('product_id', $request->product_id);
                    });
                    array_push($sales_bills ,$bill);
                }
            }

            $sales = $sales->groupBy('date')->get();
//            dd($sales);
            $purchase_cost=0;
            foreach ($sales as  $sale){
                $purchase_cost+=$sale->item_cost;
            }

        } else {
            $sales = collect();
            $sales_bills = [];
        }

        return view('AccountingSystem.reports.sales.period-earnings', compact('sales','sales_bills','purchase_cost'));

    }
}
