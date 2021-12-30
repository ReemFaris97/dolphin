<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'items_sum_total'=>$this->items_sum_total,
            'created_at'=>$this->created_at->toDateTimeString(),
            'items'=>InvoiceItemResource::collection($this->items)
        ];
    }
}