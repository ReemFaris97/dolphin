<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\ResourceCollection;

class StoreResource extends ResourceCollection
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
            'stores'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'name'=>$q->name,
                    'category_name'=>$q->category->name,
                    'products_count' => $q->totalQuantities->count() ?? 0,
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

    public function withResponse($request, $response)
    {
        $originalContent = $response->getOriginalContent();
        unset($originalContent['links'],$originalContent['meta']);
        $response->setData($originalContent);
    }
}
