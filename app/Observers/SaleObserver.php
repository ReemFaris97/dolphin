<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingSale;

class SaleObserver
{

    public function creating(AccountingSale $sale)
    {

        $exiss = AccountingSale::whereDate('created_at', date('Y-m-d'))->latest()->first();
        if (!is_null($exiss) ){
            $count=$exiss->daily_number ?? 1;
            $sale->daily_number=$count+1;

        }else{
            $sale->daily_number=1;
        }
    }
}
