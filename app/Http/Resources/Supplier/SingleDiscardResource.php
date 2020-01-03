<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleDiscardResource extends JsonResource
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
            'supplier_id'=>$this->supplier_id,
            'reason'=>$this->reason,
            'return_type'=>$this->return_type,
            'date'=>$this->date,
            'total'=>$this->total(),
            'products'=>$this->discard_products->transform(function($pro){
                return [
                    'discard_id'=>$pro->discard_id,
                    'product_name'=>$pro->product->name,
                    'quantity'=>$pro->quanitity,
                    'price'=>(float)$pro->price,
                    'type'=>$pro->type,
                ];
            }),
        ];
    }
}
