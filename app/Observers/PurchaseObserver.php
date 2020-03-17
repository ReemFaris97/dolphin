<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingPurchase;

class PurchaseObserver
{

    public function creating(AccountingPurchase $purchase)
    {

        $exiss = AccountingPurchase::whereDate('created_at', date('Y-m-d'))->latest()->first();
        if (!is_null($exiss) ){
            $count=$exiss->daily_number ?? 1;
            $purchase->daily_number=$count+1;

        }else{
            $purchase->daily_number=1;
        }
    }
}
