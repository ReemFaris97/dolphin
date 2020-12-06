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

        $notifications = auth()->user()
            ->notifications()
            ->whereIn('type', [
                'new_transaction_added', 'client_activation', 'new_distributor_route', 'new_store', 'new_store_transaction_received', 'new_store_transaction_added',
                'new_transaction_added',
                'new_transaction_received'
            ])
            ->latest()->paginate();
        return $this->apiResponse(new NotificationsResource($notifications));
    }
}
