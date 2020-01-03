<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DiscardsResources extends ResourceCollection
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
            'discards'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'user_name'=>$q->user->name,
                    'supplier_id'=>$q->supplier_id,
                    'reason'=>$q->reason,
                    'return_type'=>$q->return_type,
                    'date'=>$q->date,
                    'total'=>$q->total(),
                    'products'=>$q->discard_products->transform(function($pro){
                        return [
                            'discard_id'=>$pro->discard_id,
                            'product_name'=>$pro->product->name,
                            'quantity'=>$pro->quantity,
                            'price'=>(float)$pro->price,
                            'type'=>$pro->type,
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
