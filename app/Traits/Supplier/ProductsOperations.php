<?php


namespace App\Traits\Supplier;


use App\Models\Product;
use Carbon\Carbon;

trait ProductsOperations
{

    public function RegisterProduct($request){
        $inputs = $request->all();
        $inputs['expired_at'] = Carbon::parse($request->expired_at);
        $inputs['image'] =  saveImage($request->image, 'products');
        $product= Product::create($inputs);
        return $product;
    }

    public function UpdateSingleProduct($request,$product){
        $inputs = $request->all();
        $inputs['expired_at'] = Carbon::parse($request->expired_at);
        if($request->has('image') && $request->image !=null){
            $inputs['image'] =  saveImage($request->image, 'products');
        }
        return $product->update($inputs);

    }
}
