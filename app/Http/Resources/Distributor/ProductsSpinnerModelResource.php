<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsSpinnerModelResource extends JsonResource
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
            'name'=>$this->name,
            'price'=>$this->price,
            'quantity_per_unit'=>(int)$this->quantity_per_unit,
            'quantity' => (int)($this->store_quantity) ?? $this->quantity()
        ];
    }
}
