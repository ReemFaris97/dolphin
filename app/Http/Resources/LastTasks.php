<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LastTasks extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "task_name" => $this->task->name,
            "finished_at" => date("H:i:s", strtotime($this->finished_at)),
        ];
    }
}
