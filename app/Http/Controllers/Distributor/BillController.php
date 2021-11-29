<?php

namespace App\Http\Controllers\Distributor;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RouteReport;
use App\Models\RouteTripReport;
use App\Models\TripInventory;
use App\Traits\Viewable;

class BillController extends Controller
{
    use Viewable;

    private $viewable = 'distributor.bills.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = RouteTripReport::with([
            'inventory',
            'products',
            'route_trip' => function ($builder) {
                $builder->with(['route' => function ($q) {
                    $q->with('user');
                }, 'client']);
            },
        ])->get()->reverse();
        return $this->toIndex(compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function show($id)
    {
        return $this->toShow([
            'bill' => RouteTripReport::with([
                'inventory',
                'route_trip' => function ($builder) {
                    $builder->with(['route' => function ($q) {
                        $q->with('user');
                    }, 'client']);
                },
            ])->findOrFail($id)
        ]);
    }

    public function details($id)
    {
        return view('distributor.bills.bill', [
            'bill' => RouteTripReport::with([
                'inventory' => function ($q) {
                    $q->with('images');
                },
                'images',
            ])->findOrFail($id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RouteTripReport::findOrFail($id)->delete();
        toast('تم الحذف بنجاح', 'success', 'top-right');
        return back();
    }

    public function bill_show($id)
    {
        return view("distributor.bills.bill");
    }
    public function pay(Request $request, $id)
    {
        $total = $request->cash + $request->visa;

        $item = RouteTripReport::find($id);
        if ($item->product_total() != $total) {
            toast('المبلغ يجب ان يكون مساويا لقيمه الفاتوره', 'success', 'top-right');
            return back();
        }
        $item->update(
            [
                'paid_at' => Carbon::now(),
                'cash' => $request->cash,
                'visa' => $request->visa
            ]
        );
        toast('تم الدفع بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.bills.index');
    }
}
