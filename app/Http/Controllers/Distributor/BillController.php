<?php

namespace App\Http\Controllers\Distributor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RouteReport;
use App\Models\RouteTripReport;
use App\Models\TripInventory;
use App\Traits\Viewable;

class BillController extends Controller
{
    use Viewable;
    private  $viewable = 'distributor.bills.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = RouteTripReport::with([
            'inventory',
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        return $this->toShow(['bill' => RouteTripReport::with([
                'inventory',
                'route_trip' => function ($builder) {
                    $builder->with(['route' => function ($q) {
                        $q->with('user');
                    }, 'client']);
                },
            ])->findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public  function bill_show($id){
     return view("distributor.bills.bill");
    }
}
