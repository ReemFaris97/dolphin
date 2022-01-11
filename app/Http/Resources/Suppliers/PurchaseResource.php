<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
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
            'amount'=>$this->amount,
            'total'=>$this->total,
            'payment'=>$this->payment,
            'tax'=>$this->totalTaxs,
            'bill_num'=>$this->bill_num,
            'created_at'=>$this->created_at,
            'items_count'=>$this->items_count,
            'items'=>PurchaseItemResource::collection($this->items)


        ];
    }
}
