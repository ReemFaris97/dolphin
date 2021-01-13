<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportsResource extends ResourceCollection
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
            'reports'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'created_at' => isset($q->created_at) ? $q->created_at->format('Y-m-d') : "",
                    'total_cash' => $q->total_cash,
                    'total_expenses'=>$q->total_expenses,
                    'profit'=>$q->total_cash-$q->total_expenses,
                    'total' => $q->total_products_price
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
