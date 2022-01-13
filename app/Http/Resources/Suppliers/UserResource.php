<?php

namespace App\Http\Resources\Suppliers;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'=>$this->id,
            'name'=>$this->name,
            'company_name'=>$this->company_name,
            'commercial_number'=>$this->commercial_number,
            'phone'=>$this->phone,
            'email'=>$this->email,
            'commercial_image'=>$this->commercial_image,
            'licence_image'=>$this->licence_image,
            'image'=>$this->image,
            'address'=>$this->address,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'landline'=>$this->landline,
            'companies'=>CompanyResource::collection(optional($this->companies)),
            'token'=>$this->token,
            'permissions'=>is_array($this->permissions)?$this->permissions:[]
        ];
    }
}
