<?php

namespace App\Http\Resources\Suppliers;

use App\Models\Supplier\Invoice;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * @mixin Invoice
 */
class InvoiceItemResource extends JsonResource
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
            'product'=>new ProductResource($this->accountingProduct),
            'price'=>$this->price,
            'unit'=>$this->unit,
            'quantity'=>$this->quantity,
            'total'=>$this->total
        ];
    }
}
