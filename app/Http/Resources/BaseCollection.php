<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    private $extra;
    public function __construct($resource, string $collects, $extra=null)
    {
        $this->extra = $extra;
        $this->collects = $collects;
        parent::__construct($resource);
    }

    public function toArray($request): array
    {
        return [
            'items' => $this->collection,
            'paginate' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url' => $this->nextPageUrl() ?? '',
                'prev_page_url' => $this->previousPageUrl() ?? '',
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
            ],
            'extra'=>$this->extra
        ];
    }
}
