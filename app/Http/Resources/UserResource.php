<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
             'phone' => $this->phone,
             'email' => $this->email,
             'image' => getimg($this->image),
             'is_blocked' => $this->isBlocked(),
             $this->mergeWhen((!$this->IsDistributor()),[
                 'job' => $this->job??"",
                 'nationality' => $this->nationality??"",
                 'company_name' => $this->company_name??"",
                 'current_rate' => $this->rate(),
                 'idol_user_name' => optional(idol_user())->name??"",
                 'idol_user_image' => getimg(optional(idol_user())->image),
                 'permissions' => GeneralModelResource::collection($this->permissions),
             ]),
             $this->mergeWhen(($this->IsSupplier()),[
                 'supplier_type'=>$this->supplier_type,
                 'tax_number'=>$this->tax_number??"",
                 'lat'=>$this->lat?$this->lat:"",
                 'lng'=>$this->lng?$this->lng:"",
                 'bank_id'=>optional($this->bank)->id?optional($this->bank)->id:"",
                 'bank_account_number'=>$this->bank_account_number?$this->bank_account_number:"",
                 'bank_name'=>optional($this->bank)->name?optional($this->bank)->name:"",
             ]),
             'is_verified'=>$this->is_verified,
             'token' =>$this->token??"",
             'permissions' => GeneralModelResource::collection($this->permissions),

            ];
    }
}
