<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\Suppliers\PurchaseResource;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __invoke(Request $request)
    {
        $user=auth()->user();
        return \responder::success(new BaseCollection($user->supplier->purchases()->latest()->withCount('items')->paginate(10),PurchaseResource::class));
    }
}
