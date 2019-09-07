<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\ProductsSpinnerModelResource;
use App\Http\Resources\GeneralModelResource;
use App\Models\ExpenditureClause;
use App\Models\ExpenditureType;
use App\Models\Product;
use App\Models\Store;
use App\Traits\ApiResponses;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SpinnerController extends Controller
{
    use ApiResponses;


    /**
     * Return List of Distributors
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllDistributors(){
        $distributors = User::where('is_distributor',1)->get();
        return $this->apiResponse(GeneralModelResource::collection($distributors));
    }


    /**
     * Return List of Stores
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllStores(){
        $stores = Store::all();
        return $this->apiResponse(GeneralModelResource::collection($stores));
    }

    /**
     * Return List of Products By Store Id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getProductsByStore($store_id){
        $distributors = Product::whereStoreId($store_id)->get();
        return $this->apiResponse(ProductsSpinnerModelResource::collection($distributors));
    }

    /**
     * Return List of Expenditure Clauses
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getExpenditureClauses(){
        $expenditure_clause = ExpenditureClause::all();
        return $this->apiResponse(GeneralModelResource::collection($expenditure_clause));
    }

    /**
     * Return List of Expenditure Clauses
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getExpenditureTypes(){
        $expenditure_types = ExpenditureType::all();
        return $this->apiResponse(GeneralModelResource::collection($expenditure_types));
    }


    public function getProductByBarCode(Request $request)
    {
        $rules = [
            'bar_code'=>'required|string',
        ];

        $validation=$this->apiValidation($request,$rules);
        if($validation instanceof Response){return $validation;}

        $product = Product::whereBarCode($request->bar_code)->first();
        if (!$product) return $this->notFoundResponse();
        return $this->apiResponse(new ProductsSpinnerModelResource($product));
    }

}
