<?php

namespace App\Observers\distributors;

use App\Events\StoreTransferRequestAdded;
use App\Events\StoreTransferRequestReceiver;
use App\Models\StoreTransferRequest;

class StoreTransferRequestObserver
{
    public function creating(StoreTransferRequest $storeTransferRequest)
    {
        event(new StoreTransferRequestAdded($storeTransferRequest));
    }
    public function updating(StoreTransferRequest $storeTransferRequest)
    {

        if ($storeTransferRequest->isDirty('is_confirmed') && $storeTransferRequest->is_confirmed == 1) {

            event(new StoreTransferRequestReceiver($storeTransferRequest));
        };
    }
}
