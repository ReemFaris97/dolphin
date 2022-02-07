<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingPurchase as Purchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn as PurchaseReturn;
use Carbon\Carbon;

class PurchasesController extends Controller
{
    public function index(Request $request)
    {
        $requests = request()->all();
        $users = User::where('is_saler', 1)->get();
        if ($request->has('company_id')) {
            $purchases = Purchase::select(
                'id',
                \DB::raw('DATE(created_at) as date'),
                \DB::raw('count(*) as num'),
                \DB::raw('sum(total) as all_total'),
                \DB::raw('sum(amount) as all_amounts'),
                \DB::raw('sum(totalTaxs) as total_tax'),
                \DB::raw('sum(discount) as discounts'),
                'created_at'
            );
            if ($request->has('branch_id') && $request->branch_id != null) {
                $purchases = $purchases->where(
                    'branch_id',
                    $request->branch_id
                );
            }
            //            dd($purchases);
            //   			if ($request->has('safe_id') && $request->safe_id != null ) {
            //   				$purchases = $purchases->where('safe_id', $request->safe_id);
            //   			}

            if ($request->has('user_id') && $request->user_id != null) {
                $purchases = $purchases->where('user_id', $request->user_id);
            }

            if ($request->has('product_id') && $request->product_id != null) {
                $purchases = $purchases->whereHas('items', function (
                    $item
                ) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }
            if ($request->has('from') && $request->has('to')) {
                $purchases = $purchases->whereBetween('created_at', [
                    Carbon::parse($request->from),
                    Carbon::parse($request->to),
                ]);
            }
            $purchases = $purchases->groupBy('date')->get();
        } else {
            $purchases = collect();
        }

        return view(
            'AccountingSystem.reports.purchases.for-period',
            compact('purchases', 'users', 'requests')
        );
    }

    public function details()
    {
        $purchases = Purchase::whereDate('created_at', request('date'))->get();
        return view(
            'AccountingSystem.reports.purchases.purchase-details',
            compact('purchases')
        );
    }

    public function byDay(Request $request)
    {
        $requests = request()->all();
        if ($request->has('company_id')) {
            $purchases = Purchase::select(
                'id',
                \DB::raw('DATE(created_at) as date'),
                \DB::raw('count(*) as num'),
                \DB::raw('sum(total) as all_total'),
                \DB::raw('sum(amount) as all_amounts'),
                \DB::raw('sum(totalTaxs) as total_tax'),
                \DB::raw('sum(discount) as discounts'),
                'created_at'
            );

            if ($request->has('branch_id') && $request->branch_id != null) {
                $purchases = $purchases->where(
                    'branch_id',
                    $request->branch_id
                );
            }

            //            if ($request->has('safe_id') && $request->safe_id != null ) {
            //               $purchases = $purchases->where('safe_id', $request->safe_id);
            //            }

            if ($request->has('user_id') && $request->user_id != null) {
                $purchases = $purchases->where('user_id', $request->user_id);
            }

            if ($request->has('product_id') && $request->product_id != null) {
                $purchases = $purchases->whereHas('items', function (
                    $item
                ) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }
            if ($request->has('date') && $request->date != null) {
                $purchases = $purchases->whereDate(
                    'created_at',
                    Carbon::parse($request->date)
                );
            }

            $purchases = $purchases->groupBy('date')->get();
            // dd($purchases);
        } else {
            $purchases = collect();
        }
        //         dd($requests);
        return view(
            'AccountingSystem.reports.purchases.day',
            compact('purchases', 'requests')
        );
    }

    public function returnsPeriod(Request $request)
    {
        $requests = request()->all();

        if ($request->has('company_id')) {
            $purchases = PurchaseReturn::select(
                'id',
                \DB::raw('DATE(created_at) as date'),
                \DB::raw('count(*) as num'),
                \DB::raw('sum(total) as all_total'),
                \DB::raw('sum(amount) as all_amounts'),
                \DB::raw('sum(totalTaxs) as total_tax'),
                \DB::raw('sum(discount) as discounts'),
                'created_at'
            );

            if ($request->has('branch_id') && $request->branch_id != null) {
                $purchases = $purchases->where(
                    'branch_id',
                    $request->branch_id
                );
            }

            if ($request->has('safe_id') && $request->safe_id != null) {
                $purchases = $purchases->where('safe_id', $request->safe_id);
            }

            //            if ($request->has('user_id') && $request->user_id != null ) {
            //               $purchases = $purchases->where('user_id', $request->user_id);
            //            }

            if ($request->has('product_id') && $request->product_id != null) {
                $purchases = $purchases->whereHas('items', function (
                    $item
                ) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }

            if ($request->has('from') && $request->has('to')) {
                $purchases = $purchases->whereBetween('created_at', [
                    Carbon::parse($request->from),
                    Carbon::parse($request->to),
                ]);
            }
            $purchases = $purchases->groupBy('date')->get();
        } else {
            $purchases = collect();
        }
        return view(
            'AccountingSystem.reports.purchases.returns-period',
            compact('purchases', 'requests')
        );
    }

    public function returnsDay(Request $request)
    {
        $requests = request()->all();
        if ($request->has('company_id')) {
            $purchases = PurchaseReturn::select(
                'id',
                \DB::raw('DATE(created_at) as date'),
                \DB::raw('count(*) as counter'),
                \DB::raw('sum(amount) as num'),
                \DB::raw('sum(total) as all_total'),
                \DB::raw('sum(amount) as all_amounts'),
                \DB::raw('sum(totalTaxs) as total_tax'),
                \DB::raw('sum(discount) as discounts'),
                'created_at'
            );

            if ($request->has('branch_id') && $request->branch_id != null) {
                $purchases = $purchases->where(
                    'branch_id',
                    $request->branch_id
                );
            }

            if ($request->has('safe_id') && $request->safe_id != null) {
                $purchases = $purchases->where('safe_id', $request->safe_id);
            }

            if ($request->has('user_id') && $request->user_id != null) {
                $purchases = $purchases->where('user_id', $request->user_id);
            }

            if ($request->has('product_id') && $request->product_id != null) {
                //                dd($purchases);
                $purchases = $purchases->whereHas('items', function (
                    $item
                ) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }

            if ($request->has('date') && $request->date != null) {
                $purchases = $purchases->whereDate('created_at', [
                    Carbon::parse($request->date),
                ]);
            }

            $purchases = $purchases->groupBy('date')->get();
        } else {
            $purchases = collect();
        }
        return view(
            'AccountingSystem.reports.purchases.returns-day',
            compact('purchases', 'requests')
        );
    }

    public function returnDetails()
    {
        $purchases = PurchaseReturn::whereDate(
            'created_at',
            request('date')
        )->get();
        return view(
            'AccountingSystem.reports.purchases.return-details',
            compact('purchases')
        );
    }
}
