<?php

namespace App\Http\Resources\Distributor;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BankDepositsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "BankDeposits" => $this->collection->transform(function ($q) {
                return [
                    "id" => $q->id,
                    "type" =>
                        $q->type == "bank_transaction"
                            ? "تحويل بنكى"
                            : "مبلغ مباشر",
                    "deposit_date" =>
                        Carbon::parse($q->deposit_date)->toDateString() .
                        " " .
                        $q->created_at->toTimeString(),
                    "deposit_number" => $q->deposit_number ?? "",
                    "bank" => $q->bank->name ?? "",
                    "amount" => (string) ((float) $q->amount ?? 0),
                    "image" => getimg($q->image),
                    "confirmed_at" => $q->confirmed_at,
                ];
            }),
            "paginate" => [
                "total" => $this->total(),
                "count" => $this->count(),
                "per_page" => $this->perPage(),
                "next_page_url" => $this->nextPageUrl(),
                "prev_page_url" => $this->previousPageUrl(),
                "current_page" => $this->currentPage(),
                "total_pages" => $this->lastPage(),
            ],
        ];
    }

    public function withResponse($request, $response)
    {
        $originalContent = $response->getOriginalContent();
        unset($originalContent["links"], $originalContent["meta"]);
        $response->setData($originalContent);
    }
}
