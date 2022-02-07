<?php

namespace App\Listeners\Accounting;

use App\Events\Accounting\SaleAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AddSaleTotalToFund
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\Accounting\SaleAdded  $event
     * @return void
     */
    public function handle(SaleAdded $event)
    {
        $event->sale->addCashToFund();
        $event->sale->addNetworkToFund();
    }
}
