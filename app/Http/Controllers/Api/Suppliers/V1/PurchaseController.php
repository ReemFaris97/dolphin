<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\PurchaseResource;
use App\Models\AccountingSystem\AccountingPurchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return \responder::success(
            new BaseCollection(
                $user->supplier
                    ->purchases()
                    ->latest()
                    ->withCount("items")
                    ->paginate(10),
                PurchaseResource::class
            )
        );
    }

    public function show($id)
    {
        $purchase = AccountingPurchase::findOrFail($id);
        return view("AccountingSystem.purchases.print")->with(
            "purchase",
            $purchase
        );
    }
}
