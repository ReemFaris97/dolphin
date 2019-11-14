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
            'date'=>$this->date,
            'supplier_id'=>$this->supplier_id,
            'payment_method'=>$this->payment_method,
            'vat'=>(float)$this->vat,
            'amount_paid'=>(float)$this->amount_paid,
            'amount_rest'=>(float)$this->amount_rest,
            'products'=>$this->products->transform(function ($qu){
                    return [
                        'product_id'=>optional($qu->product)->id != null?$qu->product->id:0,
                        'product_name'=>optional($qu->product)->name != null?$qu->product->name:"",
                        'quantity'=>optional($qu->quantity) != null? $qu->quantity:0,
                        'price'=>optional($qu->price) != null?(float)$qu->price:0,
                    ];
                }),
        ];
    }
}
