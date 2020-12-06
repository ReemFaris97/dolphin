<?php

namespace App\Observers\distributors;

use App\Events\ClientActivationChanged;
use App\Models\Client;

class ClientObserver
{

    /**
     * Handle the User "updating" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function updating(Client $client)
    {

        if ($client->isDirty('is_active')) {

            event(new ClientActivationChanged($client));
        };
    }
}
