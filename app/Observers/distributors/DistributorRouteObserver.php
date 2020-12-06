<?php

namespace App\Observers\distributors;

use App\Events\DistributorRouteAdded;
use App\Models\DistributorRoute;

class DistributorRouteObserver
{
    public function created(DistributorRoute $distributorRoute)
    {
        event(new DistributorRouteAdded($distributorRoute));
    }
}
