<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TasksResource extends ResourceCollection
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
                $is_worker_completed = isset($q->currentTask()->worker_finished_at)?$q->currentTask()->worker_finished_at:null;
                return [
                    'id'=>$q->id,
                    'name'=>$q->name,
                    'description'=>$q->description,
                    'date'=>$q->date_with_time->format('Y-m-d'),
                    'type'=>Task::$types[$q->type],
                    'is_worker_completed'=>is_null($is_worker_completed)?0:1,
                    'actual_type'=>$q->type,
                    'edit_task'=>auth()->user()->hasPermissionTo('edit_tasks')?1:0,
                    'status'=>$q->taskStatus($q->id),
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
