<?php

namespace App\Http\Resources\Suppliers;

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
        //`chat_id`, `user_type`, `user_id`, `message`, `type`, `attachment`
        return [
            "id" => $this->id,
            "chat_id" => $this->chat_id,
            "user" => new UserResource($this->user),
            "message" => $this->message,
            "type" => $this->type,
            "attachment" => $this->attachment,
            "thumbnail" => $this->thumbnail,
            "is_sender" => auth()
                ->user()
                ->is($this->user),
        ];
    }
}
