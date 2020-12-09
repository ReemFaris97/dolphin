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
use App\Models\RouteTrips;
use App\Traits\ApiResponses;
use App\Traits\Distributor\ExpenseOperation;
use App\Traits\Distributor\RouteOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;
use Log;

class RouteController extends Controller
{
    use ApiResponses,RouteOperation;


    public function index(){

       $routes = DistributorRoute::where('user_id',auth()->user()->id)->paginate($this->paginateNumber);
        return $this->apiResponse(new RoutesResource($routes));
    }

    public function currentTrips()
    {
        $routes = DistributorRoute::where('user_id',auth()->user()->id)->where(['is_active'=>1,'is_finished'=>0])->get();
        return $this->apiResponse(MapRoutesResource::collection($routes));
    }

    public function show($id)
    {
        $trips =  RouteTrips::where('route_id',$id)->orderby('arrange','asc')->get();

        $trips = TripResource::collection($trips);

        return $this->apiResponse($trips);
    }


    public function makeInventory(Request $request,$type)
    {
        // info($request->all());
        $request['type'] = $type;
        $request['products'] = json_decode($request->products,TRUE);
        $rules = [
            "trip_id" => "required|required|integer|exists:route_trips,id",
            "type" => "required|in:refuse,accept",
            "notes" => "sometimes|string|min:1|max:255",
            "refuse_reason" => "sometimes|string|min:1|max:255",
            'products'=>'required|array',
            'images'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
        ];

        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        if ($request->type =="refuse") $request['status']= "refused";
        else $request['status']="accepted";
        $this->RegisterInventory($request);
        return $this->apiResponse('تم عمل الجرد بنجاح');
    }

    public function attachProducts(Request $request)
    {

        $request['products'] = json_decode($request->products,TRUE);

        $rules = [
            "trip_id" => "required|required|integer|exists:route_trips,id",
            'products'=>'required|array',
            'cash'=>'required|numeric',
            'store_id' => 'required|integer',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
        ];

        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        $route_trip = RouteTrips::find($request->trip_id);
        $this->RegisterBill($request,$route_trip);

        return $this->apiResponse('تم تسجيل الفاتورة بنجاح');

    }

    public function attachImages(Request $request)
    {
        $rules = [
            "trip_id" => "required|required|integer|exists:route_trips,id",
            'images'=>'required|array',
        ];

        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        /**  @var \App\Models\RouteTrips $route_trip */
        $route_trip = RouteTrips::find($request->trip_id);
        $route_trip_report = $route_trip->getCurrentReport;
        if ($route_trip_report == null) {
            return $this->apiResponse(null, 'لا يوجد فاتوره لهذه الزياره ');
        }
        foreach ($request->images as $image)
        {
            $route_trip_report->images()->create(['image' => saveImage($image, 'users')]);
        }
        $route_trip->update(['status'=>'accepted']);

        return $this->apiResponse('تم تسجيل الصور بنجاح');

    }
    public function AddClientToRoute(Request $request,$route_id)
    {
        $request['route']= $route_id;
             $rules = [
                 "name" => "required|string|min:1|max:255",
                "email" => "nullable|email|min:1|max:255|unique:users,email",
                 'phone'      =>'required|string|unique:users,phone',
                 "image"=>"required",
                 "store_name" => "required|string|min:1|max:255",
                 "address" => "required|string|min:1|max:255",
                 "lat" => "required|string|min:1|max:255",
                 "lng" => "required|string|min:1|max:255",
             ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        if ($request->image != null)
        {
            if ($request->hasFile('image')) {
                $inputs['image'] = saveImage($request->image,'users');
            }
        }
        $request['is_active']=0;
        $client = Client::create($request->all());

        $max_trips = RouteTrips::where('route_id',$route_id)->max('arrange');
        $request['route_id'] = $route_id;
        $request['client_id'] = $client->id;
        $request['status']='pending';
        $request['arrange']=$max_trips + 1;
        $trip = RouteTrips::create($request->all());

        return $this->apiResponse(['msg'=>'تم اضافه العميل الى المسار بنجاح','trip'=>new TripResource($trip)]);
    }


    public function store(Request $request){


        $request['products'] = json_decode($request->products,TRUE);
        $rules = [
            'route_id' =>'required|integer|exists:distributor_routes,id',
            'cash'=>'required|numeric',
            'expenses'=>'required|numeric',
            'image'=>'required|mimes:jpg,jpeg,gif,png',
            'products'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
        ];
        $validation = $this->apiValidation($request,$rules);

        if ($validation instanceof Response) {
            return $validation;
        }
        $this->RegisterRouteReport($request);

        return $this->apiResponse('تم ملأ التقرير بنجاح');
    }

}
