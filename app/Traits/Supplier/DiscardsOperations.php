<?php

namespace App\Traits\Supplier;

use App\Models\SupplierDiscard;
use App\Models\SupplierTransaction;
use Carbon\Carbon;
use http\Env\Request;

trait DiscardsOperations
{
    public function RegisterDiscard($request)
    {
        $inputs = $request->only("supplier_id", "reason", "return_type");
        $inputs["date"] = Carbon::parse($request->date);
        $inputs["user_id"] = auth()->id();

        $discard = SupplierDiscard::create($inputs);
        return $discard;
    }

    public function RegisterDiscardProducts($discard, $request, $type)
    {
        if ($type == "discard") {
            $qtys = $request->qtys;
            $prices = $request->prices;
        } else {
            $qtys = $request->qtys;
            $prices = $request->prices;
        }

        foreach ($request->products as $key => $product) {
            $inputs["product_id"] = $product;
            $inputs["quantity"] = $qtys[$key];
            $inputs["price"] = $prices[$key];
            $inputs["type"] = $type;
            $discard->discard_products()->create($inputs);
        }
    }

    public function RegisterTransaction($request)
    {
        SupplierTransaction::create([
            "supplier_id" => $request->supplier_id,
            "amount" => $request->paid_amount,
        ]);
    }
}
