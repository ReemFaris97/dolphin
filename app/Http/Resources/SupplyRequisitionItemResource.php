<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplyRequisitionItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "product" => [
                "id" => $this->product->id,
                "name" => $this->product->name,
            ],
            "unit" => $this->unit,
            "quantity" => $this->quantity,
        ];
    }
}
