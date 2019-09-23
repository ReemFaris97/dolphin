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
                    'bill_number'=>$q->name,
                    'date'=>$q->price,
                    'supplier_id'=>$q->supplier_id,
                    'payment_method'=>$q->payment_method,
                    'vat'=>$q->vat,
                    'amount_paid'=>$q->amount_paid,
                    'amount_rest'=>$q->amount_rest,
                    'offer'=>[
                        'id'=>$q->offer->id,
                        'products'=>$q->offer->offer_products->transform(function ($qu){
                            return [
                                'product_id'=>optional($qu->product)->id,
                                'product_name'=>optional($qu->product)->name,
                                'quantity'=>$qu->quantity,
                                'price'=>$qu->price,
                            ];
                        }),
                        ],

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
