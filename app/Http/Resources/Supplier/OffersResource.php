<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OffersResource extends ResourceCollection
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
            'offers'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'user_name'=>$q->user->name,
                    'created_at'=>$q->created_at->toDateString(),
                    'offer_value'=>$q->totalOffer(),
                    'products'=>$q->offer_products->transform(function ($qu){
                        return [
                            'supplier_offer_id'=>$qu->supplier_offer_id,
                            'product'=>[
                                'product_name'=>optional($qu->product)->name?$qu->product->name:"",
                                'price'=>$qu->price,
                                'quantity'=>$qu->quantity,
                            ],
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
