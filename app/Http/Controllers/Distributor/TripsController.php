<?php

namespace App\Http\Controllers\Distributor;

use App\Models\Client;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\RouteTrips;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Viewable;

class TripsController extends Controller
{
    use Viewable;

    private $viewable = 'distributor.trips.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trips = RouteTrips::all()->reverse();
        return $this->toIndex(compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'id');
        $routes = DistributorRoute::pluck('name', 'id');
        return $this->toCreate(compact('clients', 'routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'client_id' => 'required|exists:clients,id',

        ];


        $this->validate($request, $rules);
        RouteTrips::create($request->all());
        toast('تم التحويل بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.trips.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $trip = RouteTrips::findOrFail($id);
        $users = User::whereIsDistributor(1)->get();
        $clients = Client::pluck('name', 'id');
        $routes = DistributorRoute::pluck('name', 'id');
        return $this->toEdit(compact('trip', 'users', 'routes', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $trip = RouteTrips::findOrFail($id);

        $rules = [
            'route_id' => 'required|exists:distributor_routes,id',
            'client_id' => 'required|exists:clients,id',
            'address' => 'required|string',
            'lat' => 'required|string',
            'lng' => 'required|string',

        ];

        $this->validate($request, $rules);
        $ee = $trip->update($request->all());

        toast('تم تعديل الرحلة بنجاح', 'success', 'top-right');

        return redirect()->route('distributor.trips.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $trip = RouteTrips::findOrFail($id);
        $trip->delete();
        toast('تم حذف الرحلة بنجاح', 'success', 'top-right');
        return redirect()->route('distributor.trips.index');
    }


    public function trips()
    {

//        $listPos=[

//            ['arriveeLat'=>30.0596185,'arriveeLng'=>31.1884235,'centerLat'=>30.4698986,'centerLng'=>31.2216999,'departLat'=>30.9646566,'departLng'=>31.2362337],
//
//            ['arriveeLat'=>31.2591234,'arriveeLng'=>32.3016405,'centerLat'=>30.848808,'centerLng'=>32.291314,'departLat'=>30.2650247,'departLng'=>31.7537283],
//
//        ];
        $routes = DistributorRoute::whereIsFinished(1)->get();
        $trips = DistributorRoute::with('points')->get();

//        $Positions=[];
        $listPos = [];
        $routes = [];


        foreach ($trips as $key => $trip) {

            foreach ($trip->trips as $_key => $point) {
                $all = $trip->trips;
                $count = $all->count();
                // dd($count);

                if ($point->arrange == 1) {
                    $text = "arrivee";
                } elseif ($point->arrange == $count) {
                    $text = "depart";
                } else {

                    $text = "center" . $point->arrange;
                }
                $listPos [$key][$_key] = [$text . 'Lat' => $point->lat, $text . 'Lng' => $point->lng];

//                    $routes[] = $listPos;
            }
//                $listPos=[];

        }
        $newRoutes = collect($listPos);
        $routes = [];
        foreach ($newRoutes as $r) {
            $routes[] = collect($r)->collapse();
        }

//        return $routes ;


        return view('distributor.trips.map', compact('routes'));
    }


    public function updateArrange(Request $request)
    {
        $request->validate([
            'trips.*.id' => 'required|integer|exists:route_trips,id',
            'route_id' => 'required|integer|exists:distributor_routes,id'
        ]);
        \DB::beginTransaction();
        foreach ($request->trips as $index => $trip) {
            RouteTrips::find($trip['id'])->update(['arrange' => $index]);
        }
        \DB::commit();

        return response()->noContent();
    }
}
