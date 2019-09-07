<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleLogResource extends JsonResource
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
            'id'=>$this->id,
            'updated_by'=>$this->charge->supervisor->name,
            'date'=>$this->created_at->format('Y-m-d'),
            'previous_worker'=>$this->previousWorker->name??"احمد",
            'new_worker'=>$this->worker->name,
            'image'=>ImageResource::collection($this->images),
        ];
    }
}
