<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountingProductResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'barcode'=>$this->bar_code,
            'bar_codes'=>$this->bar_code,
            'unit'=>$this->main_unit,
            'price'=>$this->price,
            'image'=>$this->image,
            'notes'=>$this->notes,
            'is_active'=>$this->is_active,
            'min_quantity'=>$this->min_quantity,
            'max_quantity'=>$this->max_quantity,
            'quantity'=>$this->quantity()
        ];
    }
}
