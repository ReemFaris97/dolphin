<?php

namespace App\Http\Controllers\Api\Supplier;

use App\Http\Resources\Distributor\StoreResource;
use App\Http\Resources\ProductsResource;
use App\Http\Resources\SingleProduct;
use App\Http\Resources\StoreCategoriesResource;
use App\Http\Resources\Supplier\SupplierProductsResource;
use App\Models\Product;
use App\Models\Store;
use App\Models\StoreCategory;
use App\Models\SupplierPrice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use App\Traits\Supplier\ProductsOperations;
use Illuminate\Http\Response;
use App\Traits\Supplier\SuppliersLogOperations;

class ProductsController extends Controller
{
    use ApiResponses , ProductsOperations, SuppliersLogOperations;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $products = auth()->user()->supplierProductsPaginated();
        return $this->apiResponse(new SupplierProductsResource($products));
    }

    public function productsList(){
        $products =auth()->user()->supplierProducts()->map(function($q){
            return ['id'=>$q->id,'name'=>$q->name,'price'=>$q->authSupplierPrice()];
        });
        return $this->apiResponse($products);
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
        if($request->has('product_id') && $request->product_id != null){
            $rules = [
                'product_id'=>'required|numeric|exists:products,id',
                'price'=>'required|numeric',
            ];
            $validation = $this->apiValidation($request,$rules);

            if ($validation instanceof Response) {
                return $validation;
            }

            $result=  $this->assignProductToUser($request->product_id,$request->price);
            if($result == false) {
                return $this->apiResponse("هذا المنتج تم تعيينه من قبل");
            }
            $this->RegisterLog("إضافة منتج");
            return $this->apiResponse("تم تعيين المنتج بنجاح");
        }else{

            $rules = [
                'name'=>"required|string|max:191",
                'store_id'=>'nullable|numeric|exists:stores,id',
                'quantity_per_unit'=>'required|numeric',
                'min_quantity'=>'required|numeric|lt:max_quantity',
                'max_quantity'=>'required|numeric|gt:min_quantity',
                'price'=>'required|numeric',
                'bar_code'=>'required|string|unique:products,bar_code',
                'expired_at'=>'required|date|after_or_equal:today',
                'image'=>'required|image',
                'images'=>"nullable|array",
                'images.*'=>'image',
            ];

            $validation = $this->apiValidation($request,$rules);

            if ($validation instanceof Response) {
                return $validation;
            }
            $product = $this->RegisterProduct($request);
            $this->assignProductToUser($product->id,$request->price);
            $this->RegisterLog("إضافة منتج");
            return $this->apiResponse(new SingleProduct($product));
        }



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if(!$product) return $this->apiResponse(null,'عفواً هذا المنتج غير متوفر');

        return $this->apiResponse(new SingleProduct($product));

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
            $rules = [
                'price'=>'required|numeric',
            ];

            $validation = $this->apiValidation($request,$rules);
            if ($validation instanceof Response) {
                return $validation;
            }

            $productPrice = SupplierPrice::where('id',$id)->where('user_id',auth()->id())->first();
            if(!$productPrice) return $this->apiResponse(null,'لم يتم تعيين المنتج لديك');
            else{
                $productPrice->update(['price'=>$request->price]);
            }

            $this->RegisterLog("تعديل سعر منتج");
            return $this->apiResponse(null,'تم تعديل المنتج بنجاح');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = SupplierPrice::find($id);
        if($product){
            $product->delete();
            $this->RegisterLog("حذف منتج");
            return $this->apiResponse('تم حذف المنتج بنجاح');
        }
        else{
            return $this->apiResponse(null,"المنتج غير موجود",404);
        }
    }


    public function getAllStores($id){
        $stores = Store::where('store_category_id',$id)->get()->map(function($q){
            return ['id'=>$q->id,'name'=>$q->name];
        });
        return $this->apiResponse($stores);
    }

    public function getStoresCategories(){
        $categories = StoreCategory::all()->map(function($q){
            return ['id'=>$q->id,'name'=>$q->name];
        });
        return $this->apiResponse($categories);
    }


    public function search(Request $request){

        $products = Product::where(function ($q)use ($request) {
            $q->where('name','Like','%'.$request->text.'%')
                ->orWhere('name','Like','%'.$request->text)
                ->orWhere('name','Like',$request->text.'%');
        })->where('type','supplier')->get();

        return $this->apiResponse($products);
    }
}
