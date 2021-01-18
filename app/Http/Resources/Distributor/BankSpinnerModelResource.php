<?php

namespace App\Http\Resources\Distributor;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class BankSpinnerModelResource extends JsonResource
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
            'name'=>$this->name,
            'bank_account_number'=>$this->bank_account_number,

        ];
    }
}
