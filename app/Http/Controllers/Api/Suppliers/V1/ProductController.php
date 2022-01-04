<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\AccountingProductResource;
use App\Http\Resources\Suppliers\ProductResource;
use App\Models\AccountingSystem\AccountingProduct;
use App\Models\Supplier\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \responder::success(new BaseCollection(auth()->user()->products()->whereIsActive(0)->latest()->paginate(20), ProductResource::class));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'name' => 'required|string',
            'unit' => 'required|string',
            'barcode' => 'required|string',
            'price' => 'required|numeric',
            'notes' => 'nullable|string',
            'image' => 'required|image'
        ]);
        $user = auth()->user();
        $product = AccountingProduct::ofBarcode($request['barcode'])->first();;
        if ($product) {
            $product->suppliers()->attach($user->supplier_id);
        } else {
            $product = $user->products()->create($inputs);
        }


        return \responder::success(new ProductResource($product));
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $inputs = $request->validate([
            'name' => 'sometimes|string',
            'unit' => 'sometimes|string',
            'barcode' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'notes' => 'nullable|string',
            'image' => 'sometimes|image'
        ]);
        $user = auth()->user();
        $product->update($inputs);
        return  \responder::success(new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return  \responder::success('تم الحذف بنجاح !');
    }

    public function list(Request $request)
    {
        $products = AccountingProduct::query();
        $products->when(\request('q'), function ($q) {
            $q->where(function ($q) {
                $query = \request('q');
                $q->where('name', 'like', '%' . $query . '%')->orWhere('bar_code', 'like', "%$query%");
            });
        });

        return \responder::success(new BaseCollection($products->paginate(20),AccountingProductResource::class));
    }

    public function myProducts()
    {
//        dd(auth()->user()->supplier);
        return \responder::success(new BaseCollection(auth()->user()->supplier->products()->when(\request('q'), function ($q) {
            $q->where(function ($q) {
                $query = \request('q');
                $q->where('name', 'like', '%' . $query . '%')->orWhere('bar_code', 'like', "%$query%");
            });
        })->paginate(20),AccountingProductResource::class));
    }
}
