<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionsSpinnerModelResource extends JsonResource
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
            'id'=>$this->id,
            'sender_id'=>$this->sender_id,
            'sender'=>optional($this->sender)->name??"",
            'amount'=>$this->amount,
            'signature'=>$this->signature??"",
        ];
    }
}
