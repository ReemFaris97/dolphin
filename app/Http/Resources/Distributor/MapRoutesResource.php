<?php

namespace App\Http\Resources\Distributor;

use Illuminate\Http\Resources\Json\JsonResource;


class MapRoutesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $trips = $this->trips->where('round', $this->round)->Sortby('arrange');

        return [
            'id' => $this->id,
            'route_name' => $this->name,
            'current_trip' => new TripResource($trips->where('status', 'accepted')->last()),
            'round' => $this->round,
            'trips' => TripResource::collection($trips),
        ];
    }
}
