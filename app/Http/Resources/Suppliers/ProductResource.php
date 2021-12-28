<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'barcode'=>$this->barcode,
            'unit'=>$this->unit,
            'price'=>$this->price,
            'image'=>$this->image,
            'notes'=>$this->notes,
            'is_active'=>$this->is_active,
        ];
    }
}
