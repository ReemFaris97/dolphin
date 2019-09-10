<?php


namespace App\Traits\Supplier;


use App\Models\Product;
use App\Models\ProductImage;
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



   public function multipleUploader($request,$product)
   {
       $inputs = $request->all();
       $image[]=$inputs['images'];
       if ($request->hasFile('image')) {
           foreach ($request['image'] as $key => $item) {
               $imageName = \Storage::disk('public')->putFile('photos', $item);
               $product_image = new ProductImage();
               $product_image->product_id = $product->id;
               $product_image->image = $imageName;
               $product_image->save();
           }

       }
   }
}
