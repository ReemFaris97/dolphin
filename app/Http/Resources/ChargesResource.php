<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChargesResource extends ResourceCollection
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
            'charges'=>$this->collection->transform(function ($q){
                return [
                    'id'=>$q->id,
                    'name'=>$q->name,
                    'worker_name'=>(auth()->user()->id == $q->worker_id)?$q->supervisor->name:$q->worker->name,
                    'worker_id'=>$q->worker_id,
                    'worker_image'=>(auth()->user()->id == $q->worker_id)?getimg($q->supervisor->image):getimg($q->worker->image),
                    'image'=>isset($q->images[0]->image)?getimg($q->images[0]->image):"",
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
