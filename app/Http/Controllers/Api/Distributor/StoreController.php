<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\CarsResource;
use App\Http\Resources\Distributor\ProductsResource;
use App\Http\Resources\Distributor\StoreResource;
use App\Http\Resources\Distributor\TransactionResource;
use App\Http\Resources\Distributor\TransferRequestsResource;
use App\Models\DistributorCar;
use App\Models\DistributorTransaction;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreTransferRequest;
use App\Traits\ApiResponses;
use App\Traits\Distributor\DistributorOperation;
use App\Traits\Distributor\StoreTransferRequestOperation;
use Illuminate\Http\Request;
use JWTFactory;
use JWTAuth;
use Illuminate\Http\Response;


class StoreController extends Controller
{
    use ApiResponses,StoreTransferRequestOperation;


    public function index(){

        $stores = Store::where('distributor_id',auth()->user()->id)->paginate($this->paginateNumber);
        return $this->apiResponse(new StoreResource($stores));
    }

    public function pendingTransferRequests(){
        $stores = StoreTransferRequest::where(['distributor_id'=>auth()->user()->id,'is_confirmed'=>0])->paginate($this->paginateNumber);
        return $this->apiResponse(new TransferRequestsResource($stores));
    }

    public function AcceptTransferRequest($id){
        $store = StoreTransferRequest::find($id);
        if (!$store) return $this->notFoundResponse();
        $store->confirmRequest();
        return $this->apiResponse('تم تأكيد الطلب بنجاح');
    }


    public function cars()
    {
        $cars = DistributorCar::whereUserId(auth()->user()->id)->paginate($this->paginateNumber);
        return $this->apiResponse(new CarsResource($cars));
    }

    public function show($id)
    {
        $products = Product::whereStoreId($id)->paginate($this->paginateNumber);
        return $this->apiResponse(new ProductsResource($products));

    }

    public function store(Request $request)
    {
        $request['products'] = json_decode($request->products,TRUE);

        $rules = [
            'distributor_id' => 'required|integer|exists:users,id',
            'products'=>'required|array',
            'products.*.product_id' =>'required|integer|exists:products,id',
            "products.*.quantity" => "required|integer",
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response){return $validation;}
        $distributor_store_exist = Store::Where('distributor_id',$request->distributor_id)->first();
        if (!$distributor_store_exist) return $this->apiResponse(null, 'المندوب المحدد ليس لديه مستودع', 400);
        if ($request->distributor_id == auth()->user()->id) return $this->apiResponse(null, 'لا يمكنك ارسال واستقبال الاصناف الى و من نفسك', 400);
            $request['sender_id'] = auth()->user()->id;
            $request['is_confirmed']=0;
        $this->AddStoreTransferRequest($request);
        return $this->apiResponse('العملية تمت بنجاح');
    }


}
