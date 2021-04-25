<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\ExpenseResource;
use App\Http\Resources\Distributor\ExpensesResource;
use App\Http\Resources\Distributor\MapRoutesResource;
use App\Http\Resources\Distributor\RoutesResource;
use App\Http\Resources\Distributor\TripResource;
use App\Models\Client;
use App\Models\DistributorRoute;
use App\Models\Product;
use App\Models\ProductQuantity;
use App\Models\RouteTripReport;
use App\Models\RouteTrips;
use App\Models\Store;
use App\Models\User;
use App\Traits\ApiResponses;
use App\Traits\Distributor\ExpenseOperation;
use App\Traits\Distributor\RouteOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RouteController extends Controller
{
    use ApiResponses, RouteOperation;

    public function index()
    {
        $routes = DistributorRoute::where('user_id', auth()->user()->id)->paginate($this->paginateNumber);
        return $this->apiResponse(new RoutesResource($routes));
    }

    public function currentTrips()
    {
        $routes = DistributorRoute::with('trips')->where('user_id', auth()->id())->where(['is_available' => 1])->get();

        $active_route = DistributorRoute::with('trips')->where('user_id', auth()->id())->where(['is_available' => 1])->whereHas('trips', function ($q) {
            $q->whereIn('status', ['accepted', 'refused']);
        })->first();

        return $this->apiResponse([
            'active_route' => ($active_route != null) ? new MapRoutesResource($active_route) : null,
            'routes' => MapRoutesResource::collection($routes)]);
    }

    public function show(Request $request, $id)
    {
        $trips = RouteTrips::query()->where('route_id', $id)
            ->when(($request->lat != null && $request->lng != null), function ($q) use ($request) {
                $q->OrderByDistance($request->lat, $request->lng);
            })/*->orderby('arrange', 'asc')*/ ->get();

        $trips = TripResource::collection($trips);
        return $this->apiResponse($trips);
    }

    public function TripCashes(Request $request, $id)
    {
        $route = DistributorRoute::with(['round_expenses', 'trips'])->find($id);
        $cash = $route->trips->load(['reports' => function ($q) use ($route) {
             $q->where('round', $route->round);
        }])->pluck('reports')->flatten()->sum('cash');
        $total_expenses = $route->round_expenses->sum('amount');

        return[
            'cash' => (string) round($cash, 2),
            'expenses' => (string) round($total_expenses, 2),
            'total' => (string) round(($cash - $total_expenses), 2)
        ];
    }

    public function makeInventory(Request $request, $type)
    {
        // info($request->all());
        $request['type'] = $type;
        $request['products'] = json_decode($request->products, true);
        $rules = [
            'trip_id' => 'required|required|integer|exists:route_trips,id',
            'type' => 'required|in:refuse,accept',
            'notes' => 'sometimes|string|min:1|max:255',
            'refuse_reason' => 'sometimes|string|min:1|max:255',
            'products' => 'required|array',
            'images' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer',
        ];

        $validation = $this->apiValidation($request, $rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        if ($request->type == 'refuse') {
            $request['status'] = 'refused';
        } else {
            $request['status'] = 'accepted';

//             DistributorRoute::whereHas('trips',function($q)use($request){
// $q->where();
//             });
        }
        $this->RegisterInventory($request);
        return $this->apiResponse('تم عمل الجرد بنجاح');
    }

    public function attachProducts(Request $request)
    {
        $request['store_id'] = optional(optional(auth()->user())->car_store)->id;
        $request['products'] = json_decode($request->products, true);

        $rules = [
            'trip_id' => 'required|required|integer|exists:route_trips,id',
            'products' => 'required|array',
            'cash' => 'required|numeric',
            'store_id' => 'required|integer',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer',
        ];
        $validation = $this->apiValidation($request, $rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        $route_trip = RouteTrips::find($request->trip_id);
        $this->RegisterBill($request, $route_trip);
        $trip_report = RouteTripReport::latest()->first();
        return $this->apiResponse(
            ['msg' => 'تم تسجيل الفاتورة بنجاح', 'bill' => 'http://panorama-t.com/api/distributor/bills/print_bill/' . $trip_report->id]
        );
    }

    public function print_bill($id)
    {
        $bill = RouteTripReport::find($id);
        return view('distributor.bills.api', compact('bill'));
    }

    public function attachImages(Request $request)
    {
        $rules = [
            'trip_id' => 'required|required|integer|exists:route_trips,id',
            'images' => 'required|array',
        ];

        $validation = $this->apiValidation($request, $rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        /**  @var \App\Models\RouteTrips $route_trip */
        $route_trip = RouteTrips::find($request->trip_id);
        $route_trip_report = $route_trip->getCurrentReport;
        if ($route_trip_report == null) {
            return $this->apiResponse(null, 'لا يوجد فاتوره لهذه الزياره ',400);
        }
        foreach ($request->images as $image) {
            $route_trip_report->images()->create(['image' => saveImage($image, 'users')]);
        }
        $route_trip->update(['status' => 'accepted']);

        return $this->apiResponse('تم تسجيل الصور بنجاح');
    }

    public function AddClientToRoute(Request $request, $route_id)
    {
        $request['route_id'] = $route_id;
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'email' => 'nullable|email|min:1|max:255|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'image' => 'required',
            //                 "store_name" => "required|string|min:1|max:255",
            'address' => 'required|string|min:1|max:255',
            'lat' => 'required|string|min:1|max:255',
            'lng' => 'required|string|min:1|max:255',
            'notes' => 'nullable|string',
            //            'code' => 'nullable|string',
            'client_class_id' => 'required|integer',
            'tax_number' => 'required|string|min:15',
        ];
        /*  'notes','code', 'route_id', 'client_class_id', 'tax_number' */

        $validation = $this->apiValidation($request, $rules);
        $requests = $request->all();
        if ($validation instanceof Response) {
            return $validation;
        }
        if ($request->image != null) {
            if ($request->hasFile('image')) {
                $requests['image'] = saveImage($request->image, 'users');
            }
        }
        $requests['is_active'] = 1;
        $requests['code'] = mt_rand(10000, 100000);
        $requests['user_id'] = auth()->id();
        $client = Client::create($requests);

        $max_trips = RouteTrips::where('route_id', $route_id)->max('arrange');
        $request['route_id'] = $route_id;
        $request['round'] = optional(DistributorRoute::find($route_id))->round ?? 0;
        $request['client_id'] = $client->id;
        $request['status'] = 'pending';
        $request['arrange'] = $max_trips + 1;
        $trip = RouteTrips::create($request->all());

        return $this->apiResponse(['msg' => 'تم اضافه العميل الى المسار بنجاح', 'trip' => new TripResource($trip)]);
    }

    public function store(Request $request)
    {
        $request['products'] = json_decode($request->products, true);
        $rules = [
            'route_id' => 'required|integer|exists:distributor_routes,id',
            'cash' => 'required|numeric',
            'expenses' => 'required|numeric',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer',
        ];
        $validation = $this->apiValidation($request, $rules);

        if ($validation instanceof Response) {
            return $validation;
        }
        $report = $this->RegisterRouteReport($request);

        return $this->apiResponse([
            'message' => 'تم ملأ التقرير بنجاح',
            'code' => $report->Invoice_number]);
    }

    public function AddDamage(Request $request)
    {
        $request['products'] = json_decode($request->products, true);
        $rules = [
            'route_trip_id' => 'required|integer|exists:route_trips,id',
            'image' => 'required|mimes:jpg,jpeg,gif,png',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.quantity' => 'required|integer',
        ];
        $validation = $this->apiValidation($request, $rules);

        if ($validation instanceof Response) {
            return $validation;
        }
        $report = $this->damageProduct($request);

        return $this->apiResponse([
            'message' => 'تم تسجيل التوالف بنجاح']);
    }
}
