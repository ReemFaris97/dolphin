<?php


namespace App\Traits\Supplier;


use App\Models\DailyReport;
use App\Models\Product;
use App\Models\SupplierOffer;
use DB;
trait OffersOperations
{
    public function RegisterOffer($request){


        DB::beginTransaction();
        try {
            $offer = SupplierOffer::create(['user_id'=>auth()->id()]);
            foreach ($request->products as $item)
            {
                $product = Product::find($item['product_id']);
                $offer->offer_products()->create(['product_id'=>$item['product_id'],'quantity'=> $item['quantity'],'price'=>$item['price']]);
            }

            DB::commit();

            return $offer;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }

    }

    public function UpdateOffer($request,$offer){
        $offer->offer_products()->delete();

        foreach ($request->products as $item)
        {
            $product = Product::find($item['product_id']);
            $offer->offer_products()->create(['product_id'=>$item['product_id'],'quantity'=> $item['quantity'],'price'=>$item['price']]);
        }

        return $offer;

    }
}
