<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierLogsResource extends ResourceCollection
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
            "logs" => $this->collection->transform(function ($q){
                return [
                    'id' => $q->id,
                    'log' => $q->log,
                    'created_at' =>optional($q->created_at)->toDateString(),
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
