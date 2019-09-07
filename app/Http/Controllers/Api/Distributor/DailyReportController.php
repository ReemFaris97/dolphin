<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\CarsResource;
use App\Http\Resources\Distributor\ProductsResource;
use App\Http\Resources\Distributor\ReportsResource;
use App\Models\DistributorRoute;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DailyReportOperation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;


class DailyReportController extends Controller
{
    use ApiResponses,DailyReportOperation;


    public function reports()
    {


        if (request('from') != null && \request('to')) {

            $from = Carbon::parse(\request('from'));
            $to = Carbon::parse(\request('to'));

            $routes = DistributorRoute::where('user_id',auth()->user()->id)->whereBetween('created_at',[$from,$to])
                ->paginate($this->paginateNumber);
        }
        else
        {

            $routes = DistributorRoute::where('user_id',auth()->user()->id)->paginate($this->paginateNumber);
        }

        return $this->apiResponse(new ReportsResource($routes));
    }
    
    public function store(Request $request){

        $request['products'] = json_decode($request->products,TRUE);
        $rules = [
            'cash'=>'required|numeric',
            'expenses'=>'required|numeric',
            'image'=>'required|image',
            'products'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
        ];
        $validation = $this->apiValidation($request,$rules);

        if ($validation instanceof Response) {
            return $validation;
        }
        $request['user_id'] = auth()->user()->id;
       $this->RegisterDailyReport($request);
        return $this->apiResponse('تم ملأ التقرير بنجاح');
    }

}
