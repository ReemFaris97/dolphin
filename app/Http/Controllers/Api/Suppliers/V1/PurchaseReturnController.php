<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\PurchaseResource;

class PurchaseReturnController extends Controller
{
    public function __invoke()
    {
        $user=auth()->user();
        return \responder::success(new BaseCollection($user->supplier->purchaseReturns()->latest()->withCount('items')->paginate(10),PurchaseResource::class));

    }
}
