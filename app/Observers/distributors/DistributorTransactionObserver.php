<?php

namespace App\Observers\distributors;

use App\Events\DistributorTransactionAdded;
use App\Events\DistributorTransactionReceived;
use App\Models\DistributorTransaction;

class DistributorTransactionObserver
{
    public function created(DistributorTransaction $distributorTransaction)
    {
        event(new DistributorTransactionAdded($distributorTransaction));
    }
    public function updating(DistributorTransaction $distributorTransaction)
    {
        if (
            $distributorTransaction->isDirty("received_at") &&
            $distributorTransaction->received_at != null
        ) {
            event(new DistributorTransactionReceived($distributorTransaction));
        }
    }
}
