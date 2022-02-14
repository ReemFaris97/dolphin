<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NotesResource extends ResourceCollection
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
            "notes" => $this->collection->transform(function ($q) {
                return [
                    "id" => $q->id,
                    "description" => $q->description,
                    "user_name" => $q->user->name,
                    "date" => $q->created_at->format("Y-m-d"),
                    "image" => ImageResource::collection($q->images),
                ];
            }),
            "paginate" => [
                "total" => $this->total(),
                "count" => $this->count(),
                "per_page" => $this->perPage(),
                "next_page_url" => $this->nextPageUrl(),
                "prev_page_url" => $this->previousPageUrl(),
                "current_page" => $this->currentPage(),
                "total_pages" => $this->lastPage(),
            ],
        ];
    }

    public function withResponse($request, $response)
    {
        $originalContent = $response->getOriginalContent();
        unset($originalContent["links"], $originalContent["meta"]);
        $response->setData($originalContent);
    }
}
