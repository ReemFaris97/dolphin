<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            "expenditure_clause_id" => $this->expenditure_clause_id,
            "expenditure_clause" => $this->clause->name,
            "expenditure_type_id" => $this->expenditure_type_id,
            "distributor_route_id" => $this->distributor_route_id,
            "expenditure_type" => $this->type->name,
            "date" => date("d-m-y", strtotime($this->date)),
            "time" => $this->time,
            "amount" => floatval($this->amount),
            "notes" => $this->notes ?? "",
            "reader_name" => $this->reader->name,
            "reader_number" => $this->reader_number ?? "",
            "image" => getimg($this->image),
            "reader_image" => getimg($this->reader_image),
        ];
    }
}
