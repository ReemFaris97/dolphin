<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product" => new ProductResource($this->product),
            "quantity" => $this->quantity,
            "price" => $this->price,
            "unit_type" => $this->unit_type,
            "expired_at" => $this->expired_at,
            "tax" => $this->tax,
            "price_after_tax" => $this->price_after_tax,
        ];
    }
}
