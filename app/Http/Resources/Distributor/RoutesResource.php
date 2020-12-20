<?php

namespace App\Http\Resources\Distributor;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoutesResource extends ResourceCollection
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
            'routes'=>$this->collection->transform(function ($q){
                return [
                    'id' => $q->id,
                    'route_name' => $q->name,
                    'clients' => (int)$q->trips->count()??0,
                    'round'=>$q->round,
                    'trips' =>TripResource::collection($q->trips->Sortby('arrange')),
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
