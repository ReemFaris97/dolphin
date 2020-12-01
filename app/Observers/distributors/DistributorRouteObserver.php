<?php

namespace App\Observers\distributors;

use App\Events\DistributorRouteAdded;
use App\Models\DistributorRoute;

class DistributorRouteObserver
{
    public function creating(DistributorRoute $distributorRoute)
    {
        event(new DistributorRouteAdded($distributorRoute));
    }
}
