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
             'client'=>optional($this->client)->name??"",
             'lat'=>$this->lat,
             'lng'=>$this->lng,
             'steps'=>$this->steps(),
             'address'=>$this->address,
             'status'=>$this->status,
            ];
    }
}
