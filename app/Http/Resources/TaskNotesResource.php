<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskNotesResource extends JsonResource
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
            "description" => $this->description,
            "user_name" => $this->user->name ?? "",
            "user_id" => $this->user_id ?? "",
            "can_delete" =>
                $this->user_id === auth()->user()->id ? true : false,
        ];
    }
}
