<?php

namespace App\Http\Resources;

use App\Models\SupplyRequisitionItem;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplyRequisitionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "company" => [
                "id" => $this->accounting_company_id,
                "company" => $this->company->name,
            ],
            "supplier" => [
                "id" => $this->accounting_supplier_id,
                "name" => $this->supplier->name,
            ],
            "branch" => [
                "id" => $this->accounting_branch_id,
                "name" => $this->branch->name,
            ],
            "creator" => [
                "id" => $this->creator_id,
                "name" => $this->creator->name,
            ],
            "approver" => [
                "id" => $this->approver_id,
                "name" => @$this->approver->name,
            ],
            "created_at" => $this->created_at->toDateTimeString(),
            "approved_at" => $this->approved_at,
            "items" => SupplyRequisitionItemResource::collection($this->items),
        ];
    }
}
