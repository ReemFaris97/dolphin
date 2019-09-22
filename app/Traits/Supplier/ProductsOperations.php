<?php


namespace App\Traits\Supplier;


use App\Models\Product;
use App\Models\ProductImage;
use App\Models\SupplierPrice;
use Carbon\Carbon;


trait ProductsOperations
{

    public function RegisterProduct($request){
        $inputs = $request->all();
        $inputs['expired_at'] = Carbon::parse($request->expired_at);
        $inputs['image'] =  saveImage($request->image, 'products');
        $inputs['type'] = "supplier";

        $product= Product::create($inputs);
        if($request->has('images') && $request->images != null){
            foreach ($request->images as $image)
            {
                $product->images()->create(['image'=>saveImage($image,'users')]);
            }
        }

        return $product;
    }

    public function UpdateSingleProduct($request,$product){
        $inputs = $request->all();
        $inputs['expired_at'] = Carbon::parse($request->expired_at);
        if($request->has('image') && $request->image !=null){
            $inputs['image'] =  saveImage($request->image, 'products');
        }
        $product->update($inputs);


        if($request->has('images') && $request->images !=null) {

            $product->images()->delete();
            foreach ($request->images as $image) {
                $product->images()->create(['image' => saveImage($image, 'users')]);
            }
        }
        return $product;

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

   public function assignProductToUser($product_id,$price,$expired_at){
        $inputs['user_id'] = auth()->id();
        $inputs['product_id'] = $product_id;
        $inputs['expired_at'] = Carbon::parse($expired_at);
        $inputs['price'] = $price;
        if(!auth()->user()->checkIfProductAddedBefore($product_id)){
            $product = SupplierPrice::create($inputs);
            return $product;

        }else {
            return false;
        }
   }
}
