<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InboxResource extends ResourceCollection
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
            'inbox'=>$this->collection->transform(function ($q){
                $users=[intval($q->id),auth()->user()->id];
                sort($users);
                $channel=$users[0]."_".$users[1];
                return [
                    'id'=>$q->id,
                    'user_name'=>$q->name,
                    'user_image'=>getimg($q->image),
                    'last_message'=>lastMessage($q->id)??"",
                    'total_message_pages'=>$q->total_message_pages($q->id),
                    'channel'=>'privatechat.'.$channel,
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
