<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ReportResource extends ResourceCollection
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
            'tasks'=>$this->collection->transform(function ($q){
                return [
                    'task_id'=>$q->id,
                    'task_name'=>$q->task->name,
                    'finished_at'=>$q->finished_at->format('Y-m-d'),
                    'rate'=>$q->rate,
                    'rate_by'=>$q->rater->name,
                ];
            }),
            'paginate'=>[
//                'total' => $this->total(),
                'count' => $this->count(),
//                'per_page' => $this->perPage(),
//                'next_page_url'=>$this->nextPageUrl(),
//                'prev_page_url'=>$this->previousPageUrl(),
//                'current_page' => $this->currentPage(),
//                'total_pages' => $this->lastPage()
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
