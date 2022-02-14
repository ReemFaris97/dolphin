<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\PurchaseResource;
use App\Models\AccountingSystem\AccountingPurchaseReturn;

class PurchaseReturnController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return \responder::success(
            new BaseCollection(
                $user->supplier
                    ->purchaseReturns()
                    ->latest()
                    ->withCount("items")
                    ->paginate(10),
                PurchaseResource::class
            )
        );
    }

    public function show($id)
    {
        $purchase = AccountingPurchaseReturn::findOrFail($id);
        return view("AccountingSystem.purchases.print")->with(
            "purchase",
            $purchase
        );
    }
}
