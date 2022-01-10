<?php

namespace App\Http\Controllers\AccountingSystem\Reports;

use App\Http\Controllers\Controller;
use App\Models\AccountingSystem\AccountingBranch;
use App\Models\AccountingSystem\AccountingReturn;
use App\Models\AccountingSystem\AccountingSale;
use App\Models\AccountingSystem\AccountingSale as Sale;
use App\Models\AccountingSystem\AccountingSaleItem;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $requests = request()->all();
        if ($request->input('company_id')) {
            $stores_company = AccountingStore::where('model_id', \request('company_id'))->where('model_type', 'App\Models\AccountingSystem\AccountingCompany')->pluck('id');
            $branches = AccountingBranch::where('company_id', \request('company_id'))->pluck('id');
            $stores_branch = AccountingStore::whereIn('model_id', $branches)->where('model_type', 'App\Models\AccountingSystem\AccountingBranch')->pluck('id');
            $stores = array_merge(json_decode($stores_branch), json_decode($stores_company));

            $sales = Sale::query();

//            11/23/2021, 12:13:16 AM
            $sales->selectRaw("DATE(STR_TO_DATE(date,'%m/%d/%Y, %h:%i:%s %p')) as date_formatted , SUM(total) as total_amount , SUM(totalTaxs) as total_tax, Sum(total - totalTaxs) as total_without_taxes,count(id) sales_count");
//            dd($sales->get());
            /*     $sales->whereIn('store_id',$stores)->select('id',\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'),'created_at');*/

            /*   if ($request->input('branch_id') && $request->branch_id != null) {
                  $sales = $sales->where('branch_id', $request->branch_id);
               }*/

            if ($request->input('user_id') && $request->user_id != null) {
                $sales = $sales->where('user_id', $request->user_id);
            }

            if ($request->input('product_id') && $request->product_id != null) {
                $sales = $sales->whereHas('items', function ($item) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }

            if ($request->input('from') && $request->input('to')) {
                $sales = $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
            }

            $sales = $sales->groupBy('date_formatted')->get();
        } else {
            $sales = collect();
        }
        return view('AccountingSystem.reports.sales.for-period', compact('sales', 'requests'));
    }

    public function details()
    {
        $sales = Sale::whereRaw("DATE(STR_TO_DATE(`date`,'%m/%d/%Y, %h:%i:%s %p')) = '" . request('date') . "'")->get();
//      dd($sales);
        return view('AccountingSystem.reports.sales.sale-details', compact('sales'));
    }

    public function byDay(Request $request)
    {
        $requests = request()->all();
        $sales = Sale::query();
        $sales->select('id', \DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'), 'created_at');

        /*    if ($request->input('branch_id') && $request->branch_id != null) {
                $sales = $sales->where('branch_id', $request->branch_id);
            }*/


        if ($request->input('user_id') && $request->user_id != null) {
            $sales = $sales->where('user_id', $request->user_id);
        }

        if ($request->input('product_id') && $request->product_id != null) {
            $sales = $sales->whereHas('items', function ($item) use ($request) {
                $item->where('product_id', $request->product_id);
            });
        }

        if ($request->input('date') && $request->date != null) {
            $sales = $sales->whereDate('created_at', Carbon::parse($request->date));
        }
//          dd($sales);
        $sales = $sales->groupBy('date')->get();


        return view('AccountingSystem.reports.sales.day', compact('sales', 'requests'));
    }

    public function returnsPeriod(Request $request)
    {
        //  dd($request->all());

        $sales = AccountingReturn::query();
        $sales->select('id', \DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as num'), \DB::raw('sum(total) as all_total'), \DB::raw('sum(amount) as all_amounts'), \DB::raw('sum(totalTaxs) as total_tax'), \DB::raw('sum(discount) as discounts'), 'created_at');
//            if ($request->input('branch_id') && $request->branch_id != null) {
//                $sales = $sales->where('branch_id', $request->branch_id);
//            }
//         if ($request->input('user_id') && $request->user_id != null ) {
//            $sales = $sales->where('user_id', $request->user_id);
//         }
//            $sales = AccountingReturn::query();
        if ($request->input('product_id') && $request->product_id != null) {
            $sales->whereHas('items', function ($item) use ($request) {
                $item->where('product_id', $request->product_id);
            });
        }
        if ($request->input('user_id') && $request->user_id != null) {
            $sales->where('user_id', $request->user_id);
        }
        if ($request->input('from') && $request->input('to')) {
            $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        }
        $sales = $sales->groupBy('created_at')->get();


        return view('AccountingSystem.reports.sales.returns-period', ['sales' => $sales, 'requests' => $request->all()]);
    }

    public function returnsDay(Request $request)
    {
        $requests = request()->all();
        $sales = AccountingReturn::query();;
        /*
                    if ($request->input('branch_id') && $request->branch_id != null) {
                       $sales->where('branch_id', $request->branch_id);
                    }*/

        /*        if ($request->input('safe_id') && $request->safe_id != null) {
                   $sales->where('safe_id', $request->safe_id);
                }*/

        if ($request->input('user_id') && $request->user_id != null) {
            $sales->where('user_id', $request->user_id);
        }
        /*
                    if ($request->input('product_id') && $request->product_id != null) {
                        $sales->whereHas('items', function ($item) use ($request) {
                            $item->where('product_id', $request->product_id);
                        });
                    }*/

        if ($request->input('from') && $request->input('to')) {
            $sales->whereBetween('created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        }

        $sales = $sales->get();

        return view('AccountingSystem.reports.sales.returns-day', compact('sales', 'requests'));
    }

    public function returnDetails()
    {
        $sales = AccountingReturn::whereDate('created_at', request('date'))->get();
        return view('AccountingSystem.reports.sales.return-details', compact('sales'));
    }

    public function daily_earnings(Request $request)
    {
        $requests = request()->all();
        if ($request->input('company_id')) {
            $sales = AccountingSale::join('accounting_sales_items', 'accounting_sales.id', 'accounting_sales_items.sale_id')
                ->select(
                    'accounting_sales.id',
                    \DB::raw('DATE(accounting_sales.created_at) as date'),
                    \DB::raw('count(*) as num'),
                    \DB::raw('sum(accounting_sales.total) as all_total'),
                    \DB::raw('sum(accounting_sales.amount) as all_amounts'),
                    \DB::raw('sum(accounting_sales.totalTaxs) as total_tax'),
                    \DB::raw('sum(accounting_sales.discount) as discounts'),
                    \DB::raw('sum(accounting_sales_items.price) as productPrice'),
                    'accounting_sales.created_at'
                );
            if ($request->input('branch_id') && $request->branch_id != null) {
                $sales = $sales->where('branch_id', $request->branch_id);
            }

            if ($request->input('session_id') && $request->session_id != null) {
                $sales = $sales->where('session_id', $request->session_id);
            }

            if ($request->input('user_id') && $request->user_id != null) {
                $sales = $sales->where('user_id', $request->user_id);
            }

            if ($request->input('product_id') && $request->product_id != null) {
                $sales = $sales->whereHas('items', function ($item) use ($request) {
                    $item->where('product_id', $request->product_id);
                });
            }

            if ($request->input('date') && $request->date != null) {
                $sales = $sales->whereDate('accounting_sales.created_at', Carbon::parse($request->date));
            }
//           dd($sales->get());
            $sales = $sales->groupBy('date')->get();
        } else {
            $sales = collect();
        }
        return view('AccountingSystem.reports.sales.daily-earnings', compact('sales', 'requests'));
    }

    public function period_earnings(Request $request)
    {
        $requests = request()->all();
        $sales = AccountingSale::query()
            ->join('accounting_sales_items', 'accounting_sales.id', 'accounting_sales_items.sale_id')
            ->leftJoin('accounting_products', 'accounting_sales_items.product_id', 'accounting_products.id')
            ->select(
                'accounting_sales.id',
                DB::raw('DATE(accounting_sales.created_at) as date'),
                DB::raw('count(*) as num'),
                DB::raw('sum(accounting_sales.total) as all_total'),
                DB::raw('sum(accounting_sales_items.price *accounting_sales_items.quantity) as all_amounts'),
                DB::raw('sum(accounting_sales_items.price_after_tax *accounting_sales_items.quantity) as all_amounts_after_tax'),
                DB::raw('sum(accounting_sales.totalTaxs) as total_tax'),
                DB::raw('sum(accounting_sales.discount) as discounts'),
                DB::raw('sum(accounting_products.purchasing_price * accounting_sales_items.quantity ) as productPrice'),
                'accounting_sales.created_at'
            );
        if ($request->input('branch_id') && $request->branch_id != null) {
            $sales = $sales->where('branch_id', $request->branch_id);
        }
        if ($request->input('user_id') && $request->user_id != null) {
            $sales = $sales->where('user_id', $request->user_id);
        }
        if ($request->input('product_id') && $request->product_id != null) {
            ;
            $sales = $sales->whereHas('items', function ($item) use ($request) {
                $item->where('product_id', $request->product_id);
            });
        }
        if ($request->input('from') && $request->input('to')) {
            $sales = $sales->whereBetween('accounting_sales.created_at', [Carbon::parse($request->from), Carbon::parse($request->to)]);
        }

        $sales = $sales->groupBy('date')->get();

        return view('AccountingSystem.reports.sales.period-earnings', compact('sales', 'requests'));
    }

    public function sessionDetails(Request $request)
    {
        $sellers = User::where('is_saler', 1)->pluck('name', 'id');
        $sales = AccountingSale::query()
            ->withCount('items')
            ->with('user')
            ->when($request->user_id, fn($q) => $q->ofUser($request->user_id))
            ->when(
                ($request->from_date != null && $request->to_date != null),
                fn($q) => $q->InPeriod($request->from_date, $request->to_date)
            )
            ->get();
        $returns = AccountingReturn::query()
            ->withCOunt('items')
            ->with('user')
            ->when($request->user_id, fn($q) => $q->ofUser($request->user_id))
            ->when(
                ($request->from_date != null && $request->to_date != null),
                fn($q) => $q->InPeriod($request->from_date, $request->to_date)
            )
            ->withCount(['items'])
            ->get();
        return view('AccountingSystem.reports.sales.session-details', compact('sellers', 'sales', 'returns'));
    }

    public function improvedSales(Request $request)
  //  public function improvedSales(ImprovedSalesReportDataTable $dataTable)
    {
        //        SELECT product_id,sum(quantity),price,(price * sum(quantity)) as total,unit_id FROM `accounting_sales_items` group by product_id ,unit_id, price

        $sales = AccountingSaleItem::query()->with('product', 'unit');
        $sales->when($request->product_id, function ($q) use ($request) {
            $q->where('product_id', $request->product_id);
        });

        $sales->when($request->from and $request->to, function ($q) use ($request) {
            $q->whereBetween('created_at', [$request->from, $request->to]);
        });

        $sales->when($request->category_id, function ($q) use ($request) {
            $q->whereHas('product', function ($q) {
                $q->where('category_id', \request('category_id'));
            });
        });

        $sales = $sales->groupBy('product_id', 'unit_id', 'price')
            ->selectRaw("product_id,sum(quantity) as quantity,price,(price * sum(quantity)) as total,unit_id")
            ->get();

        return view('AccountingSystem.reports.sales.sales-improved', compact('sales'));
        //  return $dataTable->render('AccountingSystem.reports.sales.sales-improved');
    }
}
