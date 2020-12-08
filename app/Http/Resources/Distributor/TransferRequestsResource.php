<?php

namespace App\Http\Resources\Distributor;

use App\Http\Resources\Distributor\ProductQuantityResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TransferRequestsResource extends ResourceCollection
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
            'transfer_requests'=>$this->collection->transform(function ($q){
                return [
                     'id'=>$q->id,
                    'name'=>$q->sender->name,
                    'sender_store'=>$q->sender_store->name,
                    'products'=>   $q->productQuantities->transform(function ($qu){
                        return [
                            'id'=>$qu->id,
                            'name'=>$qu->product->name,
                            'quantity'=>$qu->quantity,                        ];
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

    public function withResponse($request, $response)
    {
        $originalContent = $response->getOriginalContent();
        unset($originalContent['links'],$originalContent['meta']);
        $response->setData($originalContent);
    }
}
