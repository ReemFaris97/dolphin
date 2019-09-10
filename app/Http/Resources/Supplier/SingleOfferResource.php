<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' =>(int)$this->user_id,
            'user_name' =>$this->user->name,
            'created_at'=>$this->created_at->toDateString(),
            'products'=>$this->offer_products->transform(function ($q){
                return [
                    'supplier_offer_id'=>$q->supplier_offer_id,
                    'product'=>[
                        'product_name'=>$q->product->name,
                        'price'=>$q->price,
                        'quantity'=>$q->quantity,
                    ],
                ];
            }),
            'total_offer'=>$this->totalOffer(),

        ];
    }
}
