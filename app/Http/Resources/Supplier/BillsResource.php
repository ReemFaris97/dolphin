<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BillsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'bills'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'user_name'=>$q->user->name,
                    'bill_number'=>$q->name == null ? 0: $q->name,
                    'date'=>$q->date,
                    'supplier_id'=>$q->supplier_id,
                    'payment_method'=>$q->payment_method,
                    'vat'=>(float)$q->vat,
                    'amount_paid'=>(float)$q->amount_paid,
                    'amount_rest'=>(float)$q->amount_rest,

                    'transfer_date'=>$q->transfer_date != null ?$q->transfer_date:"",
                    'transfer_number'=>$q->transfer_number != null ?$q->transfer_number:"",
                    'bank_name'=>$q->bank_name != null ?$q->bank_name:"",
                    'check_number'=>$q->check_number != null ?$q->check_number:"",
                    'check_date'=>$q->check_date != null ?$q->check_date:"",
                    'products'=>$q->products->transform(function ($qu){
                            return [
                                'product_id'=>optional($qu->product)->id != null?$qu->product->id:0,
                                'product_name'=>optional($qu->product)->name != null?$qu->product->name:"",
                                'quantity'=>optional($qu->quantity) != null? $qu->quantity:0,
                                'price'=>optional($qu->price) != null?(float)$qu->price:0,
                            ];
                        }),

                ];
            }),
            'paginate'=>[
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url'=>$this->nextPageUrl(),
                'prev_page_url'=>$this->previousPageUrl(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]

        ];
    }
}
