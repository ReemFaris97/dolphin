<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\User;
class UsersResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "employees" => $this->collection->transform(function ($q){
                return [
                'id' => $q->id,
                'name' => $q->name,
                'phone' => $q->phone,
                'email' => $q->email,
                'image' => getimg($q->image),
                $this->mergeWhen(($q->IsSupplier()),[
                    'supplier_type'=>$q->supplier_type,
                    'tax_number'=>$q->tax_number,
                    'lat'=>$q->lat?$q->lat:"",
                    'lng'=>$q->lng?$q->lng:"",
                    'bank_id'=>optional($q->bank)->id?optional($q->bank)->id:"",
                    'bank_account_number'=>$q->bank_account_number?$q->bank_account_number:"",
                    'bank_name'=>optional($q->bank)->name?optional($q->bank)->name:"",
                    'permissions' =>GeneralModelResource::collection($q->permissions),
                ]),
            ];
        }),
            'paginate'=>[
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'next_page_url'=>$this->nextPageUrl(),
                'prev_page_url'=>$this->previousPageUrl(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage()
            ]


        ];
    }
}
