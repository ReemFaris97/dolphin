<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\JsonResource;

class TripReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "invoice_number" => $this->invoice_number,
            "round" => $this->round,
            "cash" => $this->cash,
            "notes" => $this->notes,
            "expenses" => $this->expenses,
            "total" => $this->cash - $this->expenses,
            //            'products'=>ProductsResource::collection($this->products->)
        ];
    }
}
