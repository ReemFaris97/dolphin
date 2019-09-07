<?php

namespace App\Http\Resources;

use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class SingleTaskResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $time = isset($this->currentTask()->rest_time) ? (int)$this->currentTask()->rest_time:0;
         return [
             'id' => $this->id,
             'name' => $this->name,
             'user_name'=>isset($this->currentTask()->user->name)?$this->currentTask()->user->name:"",
             'actual_type'=>$this->type,
             'alternative_name'=>isset($this->currentTask()->user->name)?$this->currentTask()->alternative_user():"",
             'type' => Task::$types[$this->type],
             'date'=>is_null($this->date)?"":$this->date->format('Y-m-d'),
             'description' => $this->description,
             'time'=>(is_null($this->currentTask()->worker_finished_at))?$time:0,
             'attachments' => ImageResource::collection($this->images->sortbyDesc('id')),
             'notes' => TaskNotesResource::collection($this->notes->sortbyDesc('id')),
             'can_rate'=>($this->currentTask()->rater_id===auth()->user()->id)?true:false,
             'rate'=>(int)$this->currentTask()->rate??0,
             'comment'=>$this->currentTask()->comment??"",
             'is_finished'=>(is_null($this->currentTask()->worker_finished_at))?false:true,

            ];
    }
}
