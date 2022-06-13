<?php

namespace App\Http\Controllers\Distributor\Reports;

use App\DataTables\BillsReportDataTable;
use App\Models\Product;
use App\Models\RouteTripReport;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillReportController extends Controller
{

    public function index(BillsReportDataTable $dataTable)
    {
        $bills = RouteTripReport::query()->with(['inventory', 'products', 'route_trip' => function ($builder) {
            $builder->with(['route' => function ($q) {
                $q->with('user');
            }, 'client']);
        },
        ]);
        $bills->when(\request('client_id'), function ($q) {
            $q->whereHas('route_trip', function ($query) {
                $query->whereRelation('client', 'client_id', \request('client_id'));
            });
        });

        $bills->when(\request('user_id'), function ($q) {
            $q->whereHas('route_trip', function ($query) {
                $query->whereRelation('route', 'user_id', \request('user_id'));
            });
        });

        $bills->when(\request('from') and \request('to'), function ($q) {
            $q->whereBetween('created_at', [\request('from'), \request('to')]);
        });

        $total = 0;
        if(!empty(array_filter(request()->all()))){
        foreach ($bills->get(['id']) as $bill) {
            foreach ($bill->products()->get(['id','price','quantity']) as $product) {
                $total += $product->price * $product->quantity;
            }
        }
            
        }
        return $dataTable->render('distributor.reports.bills-report.index', ['total' => $total]);
    }

}
