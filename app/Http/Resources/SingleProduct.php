<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SingleProduct extends JsonResource
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
            'name' => $this->name,
            'store' => $this->store->name,
            'quantity_per_unit' =>(int) $this->quantity_per_unit,
            'min_quantity'=>(int)$this->min_quantity,
            'max_quantity'=>(int)$this->max_quantity,
            'price'=>$this->price,
            'bar_code'=>$this->bar_code,
            'image'=>$this->image==null?"":getimg($this->image),
            'images' => $this->images->transform(function ($qu){
                return [
                    'id'=>$qu->id,
                    'image'=>getimg($qu->image)
                ];
            }),
            'expired_at'=>$this->expired_at,
        ];
    }
}
