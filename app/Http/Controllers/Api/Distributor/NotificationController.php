<?php

namespace App\Http\Controllers\Api\Distributor;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use App\Traits\Distributor\RouteOperation;
use App\Http\Resources\NotificationsResource;


class NotificationController extends Controller
{
    use ApiResponses, RouteOperation;


    public function index()
    {

        $notifications = auth()->user()->notifications()->latest()->paginate();
        return $this->apiResponse(new NotificationsResource($notifications));
    }
}
