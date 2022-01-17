<?php

namespace App\Listeners\Accounting;

use App\Events\Accounting\FundSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateFundAccount
{
   
    public function handle(FundSaved $event)
    {
        //
    }
}
