<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Distributor\StoreResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\SingleProduct;
use App\Http\Resources\StoreCategoriesResource;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use App\Traits\Supplier\ProductsOperations;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    use ApiResponses , ProductsOperations;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate($this->paginateNumber);
        return $this->apiResponse(new ProductsResource($products));
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
        $rules = [
            'name'=>"required|string|max:191",
            'store_id'=>'required|numeric|exists:stores,id',
            'quantity_per_unit'=>'required|numeric',
            'min_quantity'=>'required|numeric|lt:max_quantity',
            'max_quantity'=>'required|numeric|gt:min_quantity',
            'price'=>'required|numeric',
            'bar_code'=>'required|string|unique:products,bar_code',
            'expired_at'=>'required|date|after_or_equal:today',
            'image'=>'required|image',
        ];
        $validation = $this->apiValidation($request,$rules);

        if ($validation instanceof Response) {
            return $validation;
        }
            $product = $this->RegisterProduct($request);
            return $this->apiResponse(new SingleProduct($product));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $product = Product::find($id);
        if(!$product) return $this->apiResponse(null,"المنتج غير موجود يبشه");
        else {
            $rules = [
                'name'=>"required|string|max:191",
                'store_id'=>'required|numeric|exists:stores,id',
                'quantity_per_unit'=>'required|numeric',
                'min_quantity'=>'required|numeric|lt:max_quantity',
                'max_quantity'=>'required|numeric|gt:min_quantity',
                'price'=>'required|numeric',
                'bar_code'=>'required|string|unique:products,bar_code,'.$product->id,
                'expired_at'=>'required|date|after_or_equal:today',
                'image'=>'nullable|image',
            ];
            $validation = $this->apiValidation($request,$rules);
            if ($validation instanceof Response) {
                return $validation;
            }
            $inputs['expired_at'] = Carbon::parse($request->expired_at);
            if($request->has('image') && $request->image !=null){
                $inputs['image'] =  saveImage($request->image, 'products');
            }

            $product->update($inputs);
            return $this->apiResponse(new SingleProduct($product));

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return $this->apiResponse('تم حذف المنتج بنجاح');
        }
        else{
            return $this->apiResponse(null,"المنتج غير موجود",404);
        }
    }


    public function getAllStores($id){
        $stores = Store::where('store_category_id',$id)->paginate($this->paginateNumber);
        return $this->apiResponse(new StoreResource($stores));
    }

    public function getStoresCategories(){
        $categories = StoreCategory::paginate($this->paginateNumber);
        return $this->apiResponse(new StoreCategoriesResource($categories));
    }
}
