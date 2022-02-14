<?php

namespace App\Http\Resources\Distributor;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ExpensesResource extends ResourceCollection
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
            "expenses" => $this->collection->transform(function ($q) {
                return [
                    "id" => $q->id,
                    "expenditure_clause_id" => $q->expenditure_clause_id,
                    "expenditure_clause" => $q->clause->name,
                    "expenditure_type_id" => $q->expenditure_type_id,
                    "expenditure_type" => $q->type->name,
                    "date" => date("d-m-y", strtotime($q->date)),
                    "time" => $q->time,
                    "amount" => floatval($q->amount),
                    "notes" => $q->notes ?? "",
                    "reader_name" => $q->reader->name,
                    "reader_number" => $q->reader_number ?? "",
                    "image" => getimg($q->image),
                    "reader_image" => getimg($q->reader_image),
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
