<?php

namespace App\Http\Controllers\Api\Suppliers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseCollection;
use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        return \responder::success(new BaseCollection(auth()->user()->notifications()->latest()->paginate(request('perPage',20)),
            NotificationResource::class));
    }
}
