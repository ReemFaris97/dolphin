<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkersResource extends JsonResource
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
            'name'=>$this->user->name,
            'rater'=>isset($this->rater->name)?$this->rater->name:"",
            'finisher'=>isset($this->finisher->name)?$this->finisher->name:"",
            'days'=>$this->days,
            'minutes'=>$this->minutes,
            'hours'=>$this->hours,
        ];
    }
}
