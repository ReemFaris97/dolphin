<?php

namespace App\Observers\distributors;

use App\Events\NewStoreAdded;
use App\Models\Store;

class StoreObserver
{

    /**
     * Handle the Store "creating" event.
     *
     * @param  \App\Models\Store  $store
     * @return void
     */
    public function created(Store $store)
    {


        event(new NewStoreAdded($store));
    }
}
