<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class ProductsResource
 * @package App\Http\Resources\Distributor
 * @mixin  \App\Models\Product
 */
class ProductsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'products' => $this->collection->transform(function ($q) {
                // if($q->id!=null){
                //     dd($q);
                // }
                return [
                    'id' => $q->id,
                    'name' => $q->name,
                    'min_quantity' => $q->min_quantity??0,
                    'max_quantity' => $q->max_quantity??0,
                    'quantity' => $q->quantity ?? 0,
                    'quantity_per_package' =>(string) ( $q->quantity/($q->quantity_per_unit??1) ??0),
                ];
            }),
            'paginate' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url' => $this->nextPageUrl(),
                'prev_page_url' => $this->previousPageUrl(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]

        ];
    }

    public function withResponse($request, $response)
    {
        $originalContent = $response->getOriginalContent();
        unset($originalContent['links'], $originalContent['meta']);
        $response->setData($originalContent);
    }
}
