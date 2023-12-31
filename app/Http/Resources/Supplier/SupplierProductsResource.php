<?php

namespace App\Http\Resources\Supplier;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SupplierProductsResource extends ResourceCollection
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
            'products'=>$this->collection->transform(function ($q){
                return [

                    'id'=>$q->id,
                    'price_id'=>$q->authSupplierPriceId(),
                    'name'=>$q->name,
                    'price'=>$q->authSupplierPrice(),
                    'bar_code'=>$q->bar_code,
                    'image'=>$q->image?getimg($q->image):"",
                    'expired_at'=>$q->authSupplierProductExpireDate(),
                    'images' => $q->images->transform(function ($qu){
                        return [
                            'id'=>$qu->id,
                            'image'=>getimg($qu->image)
                        ];
                    }),
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
