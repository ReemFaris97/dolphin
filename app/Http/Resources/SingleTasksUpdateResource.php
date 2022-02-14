<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleTasksUpdateResource extends JsonResource
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
            "name" => $this->name,
            "date" => is_null($this->date) ? "" : $this->date->format("Y-m-d"),
            "time_from" => $this->time_from ?? "",
            "type" => Task::$types[$this->type],
            "description" => $this->description,
            "clause_id" => (int) $this->clause_id ?? 0,
            "after_task_id" => (int) $this->after_task_id ?? 0,
            "after_task_name" => optional($this->afterTask)->name ?? "",
            "period" => (int) $this->period ?? 0,
            "equation_mark" => (string) $this->equation_mark ?? "",
            "clause_name" => optional($this->clause)->name ?? "",
            "clause_amount" => (int) $this->clause_amount ?? 0,
            "workers" => WorkersResource::collection($this->task_users),
        ];
    }
}
