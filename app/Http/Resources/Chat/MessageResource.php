<?php

namespace App\Http\Resources\Chat;

use App\Http\Resources\Suppliers\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'chat_id'=>$this->chat_id,
            'text'=>$this->message,
            'type'=>$this->type,
            'attachment'=>$this->attachment,
            'created_at'=>$this->created_at->toDateTimeString(),
            'user'=>new UserResource($this->user),
            'is_sender'=>auth()->user()->is($this->user)

        ];
    }
}
