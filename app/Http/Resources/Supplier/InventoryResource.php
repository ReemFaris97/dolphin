<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InventoryResource extends ResourceCollection
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
            'products'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'name'=>$q->name,
                    'quantity_per_unit'=>(int)$q->quantity_per_unit,
                    'min_quantity'=>(int)$q->min_quantity,
                    'max_quantity'=>(int)$q->max_quantity,

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
