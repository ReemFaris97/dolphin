<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingStore;
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
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));

            $sales = Sale::whereIn('store_id',$stores)->select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

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
//          dd($sales);
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

//         if ($request->has('user_id') && $request->user_id != null ) {
//            $sales = $sales->where('user_id', $request->user_id);
//         }

         if ($request->has('product_id') && $request->product_id != null ) {
            $sales = $sales->whereHas('items', function ($item) use ($request) {
               $item->where('product_id', $request->product_id);
            });
         }

         if ($request->has('from') && $request->has('to')) {
            $sales = $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
         }

         $sales = $sales->groupBy('date')->get();

      } else {
         $sales = collect();
      }
//      dd($sales);
      return view('AccountingSystem.reports.sales.returns-period', compact('sales','requests'));
   }

   public function returnsDay(Request $request)
   {
       $requests=request()->all();
      if ($request->has('company_id')) {
         $sales = AccountingReturn::select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('sum(amount) as num'),  \DB::raw('count(*) as counter'),\DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');

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

   public  function daily_earnings(Request $request)
   {
       $requests=request()->all();
       if ($request->has('company_id')) {
           $sales = AccountingSale::join('accounting_sales_items', 'accounting_sales.id','accounting_sales_items.sale_id')
               ->select('accounting_sales.id',\DB::raw('DATE(accounting_sales.created_at) as date'),
                   \DB::raw('count(*) as num'),
                   \DB::raw('sum(accounting_sales.total) as all_total'),
                   \DB::raw('sum(accounting_sales.amount) as all_amounts'),
                   \DB::raw('sum(accounting_sales.totalTaxs) as total_tax'),
                   \DB::raw('sum(accounting_sales.discount) as discounts'),
                   \DB::raw('sum(accounting_sales_items.price) as productPrice'),'accounting_sales.created_at');
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

               $sales = $sales->whereHas('items', function ($item) use ($request) {
                   $item->where('product_id', $request->product_id);

               });

           }

           if ($request->has('date') && $request->date != null) {

               $sales=$sales->whereDate('accounting_sales.created_at',Carbon::parse($request->date));
           }
//           dd($sales->get());
           $sales = $sales->groupBy('date')->get();

       } else {
           $sales = collect();

       }
       return view('AccountingSystem.reports.sales.daily-earnings', compact('sales','requests'));
   }
    public  function period_earnings(Request $request)
    {
        $requests=request()->all();
        if ($request->has('company_id')) {
            $sales = AccountingSale::join('accounting_sales_items', 'accounting_sales.id','accounting_sales_items.sale_id')
                ->select('accounting_sales.id',\DB::raw('DATE(accounting_sales.created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(accounting_sales.total) as all_total'), \DB::raw('sum(accounting_sales.amount) as all_amounts'), \DB::raw('sum(accounting_sales.totalTaxs) as total_tax'), \DB::raw('sum(accounting_sales.discount) as discounts'),\DB::raw('sum(accounting_sales_items.price) as productPrice'),'accounting_sales.created_at');
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
            if ($request->has('from') && $request->has('to')) {
                $sales = $sales->whereBetween('accounting_sales.created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
            }

            $sales = $sales->groupBy('date')->get();

        } else {
            $sales = collect();

        }

        return view('AccountingSystem.reports.sales.period-earnings', compact('sales','requests'));

    }
}
