<?php

namespace App\Http\Resources\Distributor;

use App\Models\Store;
use Illuminate\Http\Resources\Json\JsonResource;

class DistributorSpinnerModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $has_store = Store::where('distributor_id',$this->id)->first();
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'has_store'=>$has_store?true:false,
        ];
    }
}
