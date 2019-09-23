<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleBillResource extends JsonResource
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
            'id'=>$this->id,
            'user_name'=>$this->user->name,
            'bill_number'=>$this->name,
            'date'=>$this->price,
            'supplier_id'=>$this->supplier_id,
            'payment_method'=>$this->payment_method,
            'vat'=>$this->vat,
            'amount_paid'=>$this->amount_paid,
            'amount_rest'=>$this->amount_rest,
            'offer'=>[
                'id'=>$this->offer->id,
                'products'=>$this->offer->offer_products->transform(function ($qu){
                    return [
                        'product_id'=>optional($qu->product)->id,
                        'product_name'=>optional($qu->product)->name,
                        'quantity'=>$qu->quantity,
                        'price'=>$qu->price,
                    ];
                }),
            ],

        ];
    }
}
