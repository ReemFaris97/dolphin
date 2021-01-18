<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Distributor\DistributorSpinnerModelResource;
use App\Http\Resources\Distributor\ProductsSpinnerModelResource;
use App\Http\Resources\Distributor\TransactionsSpinnerModelResource;
use App\Http\Resources\GeneralModelResource;
use App\Models\Client;
use App\Models\ClientClass;
use App\Models\DistributorRoute;
use App\Models\DistributorTransaction;
use App\Models\ExpenditureClause;
use App\Models\ExpenditureType;
use App\Models\Product;
use App\Models\Reader;
use App\Models\ReasonRefuseDistributor;
use App\Models\Store;
use App\Traits\ApiResponses;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
    public function getAllDistributors()
    {
        $distributors = User::available()->where('is_distributor', 1)->get();
        return $this->apiResponse(DistributorSpinnerModelResource::collection($distributors));
    }

    /**
     * Return List of Distributors
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getReceivedMoneyTransactions()
    {

        $distributors = DistributorTransaction::receiverUser(auth()->user()->id)->where('received_at', null)->get();

        return $this->apiResponse(TransactionsSpinnerModelResource::collection($distributors));
    }

    /**
     * Return List of Distributors
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getStoresByDistributorId($id)
    {

        $stores = Store::where('distributor_id', $id)->get();

        return $this->apiResponse(GeneralModelResource::collection($stores));
    }


    /**
     * Return List of Stores
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllStores()
    {
        $stores = Store::active()->ofDistributor(auth()->id())->get();
        return $this->apiResponse(GeneralModelResource::collection($stores));
    }

    /**
     * Return List of Stores
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllReaders()
    {
        $readers = Reader::where('is_active', 1)->get();
        return $this->apiResponse(GeneralModelResource::collection($readers));
    }

    /**
     *
     * Return List of Reasons
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getAllDistributorsRefuseReason()
    {
        $readers = ReasonRefuseDistributor::get();
        return $this->apiResponse(GeneralModelResource::collection($readers));
    }

    /**
     * Return List of Products By Store Id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getProductsByStore($store_id = null)
    {

        if (is_null($store_id)) {
            $distributors = Product::withClientPrice(request()->client_id)->get();
        } else {
            $distributors = Product::whereHas('stores', function (Builder $builder) use ($store_id) {
                $builder->where('store_id', $store_id);
            })->withClientPrice(request()->client_id)->get();

            $distributors = Product::with(
                [
                    'quantities' => function ($q) use ($store_id) {
                        $q->where('store_id', $store_id);
                        $q->totalQuantity();
                    }
                ]
            )
                ->whereHas('stores', function (Builder $builder) use ($store_id) {
                    $builder->where('store_id', $store_id);
                })
                ->withClientPrice(request()->client_id)->get()->map(function ($product) {

                    $product->store_quantity = $product->quantities->where('product_id', $product->id)->sum('total_quantity');
                    return $product;
                });


        }
        return $this->apiResponse(ProductsSpinnerModelResource::collection($distributors));
    }

    /**
     * Return List of Expenditure Clauses
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getExpenditureClauses($id)
    {
        $expenditure_clause = ExpenditureClause::where('is_active', 1)->where('expenditure_type_id', $id)->get();
        return $this->apiResponse(GeneralModelResource::collection($expenditure_clause));
    }

    /**
     * Return List of Expenditure Clauses
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function getExpenditureTypes()
    {
        $expenditure_types = ExpenditureType::where('is_active', 1)->get();
        return $this->apiResponse(GeneralModelResource::collection($expenditure_types));
    }


    public function getProductByBarCode(Request $request)
    {
        $rules = [
            'bar_code' => 'required|string',
            'client_id' => 'required|integer|exists:clients,id',
            //  'store_id' => 'required|integer|exists:stores,id',
        ];

        $validation = $this->apiValidation($request, $rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        $client = Client::where('is_active', 1)->find($request->client_id);
        $product = Product::with(['quantities' => function ($q) use ($request) {
            $q->where('store_id', auth()->user()->car_store->id);
            $q->totalQuantity();
        }])
            ->whereBarCode($request->bar_code)
            ->withClassPrice($client->client_class_id)
            ->first();

        $product->store_quantity = $product->quantities->where('product_id', $product->id)->sum('total_quantity');

        if (!$product || $product->store_quantity == 0) return $this->notFoundResponse();
        return $this->apiResponse(new ProductsSpinnerModelResource($product));
    }

    public function getR()
    {
        $expenditure_types = ExpenditureType::all();
        return $this->apiResponse(GeneralModelResource::collection($expenditure_types));
    }

    public function getDistributorRoutes()
    {
        return $this->apiResponse(
            GeneralModelResource::collection(
                DistributorRoute::where('user_id', auth()->id())->get()
            )
        );
    }

    public function getClientClasses()
    {
        return $this->apiResponse(
            GeneralModelResource::collection(
                ClientClass::Active()->get()
            )
        );
    }

}
