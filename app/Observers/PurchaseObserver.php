<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingPurchase;

class PurchaseObserver
{

    public function creating(AccountingPurchase $purchase)
    {
        if (getsetting('counter_type') == 'daily') {
            $exiss = AccountingPurchase::whereDate('created_at', date('Y-m-d'))->latest()->first();
            if (!is_null($exiss)) {
                $count = $exiss->daily_number ?? 1;
                $purchase->daily_number = $count + 1;

            } else {
                $purchase->daily_number = 1;
            }
        }elseif(getsetting('counter_type')=='daily_branch')
        {

            $exiss = AccountingPurchase::whereDate('created_at', date('Y-m-d'))->latest()->first();

            if (!is_null($exiss)) {

                $count1 = $exiss->daily_number ?? 1;

                $purchase->daily_number = $count1 + 1;
                $purchase->counter_purchase = $purchase->daily_number . "-" . $purchase->branch->code;
            } else {
                $purchase->daily_number =1;
                $purchase->counter_purchase = $purchase->daily_number . "-" . $purchase->branch->code;

            }
        }
        elseif(getsetting('counter_type')=='branch_device')
        {


            $exiss = AccountingPurchase::whereDate('created_at', date('Y-m-d'))->latest()->first();

            if (!is_null($exiss)) {

                $count1 = $exiss->daily_number ?? 1;

                $purchase->daily_number = $count1 + 1;
                $purchase->counter_purchase = $purchase->daily_number . "-" . $purchase->branch->code . "-" . $purchase->session->device->code;
            } else {
                $purchase->daily_number =1;
                $purchase->counter_purchase = $purchase->daily_number . "-" . $purchase->branch->code . "-" . $purchase->session->device->code;

            }
        }



    }
}
