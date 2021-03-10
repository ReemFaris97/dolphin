<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
             'id' => $this->id,
             'client_id'=>$this->client_id??0,
             'route_id'=>$this->route_id,
             'client'=>optional($this->client)->name??"",
             'client_payment'=>optional($this->client)->payment_type??"",
             'blocked'=>optional($this->client)->is_blocked,
             'lat'=>$this->lat,
             'lng'=>$this->lng,
             'is_active'=>optional($this->client)->is_active??0,
             'steps'=>$this->steps(),
             'address'=>$this->address,
             'status'=>$this->status,
            'round' => $this->round,
            ];
    }
}
