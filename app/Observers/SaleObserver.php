<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingSale;

class SaleObserver
{

    public function creating(AccountingSale $sale)
    {
            if (getsetting('counter_type')=='daily') {
                $exiss = AccountingSale::whereDate('created_at', date('Y-m-d'))->latest()->first();
                if (!is_null($exiss)) {

                    $count = $exiss->daily_number ?? 1;
                    $sale->daily_number = $count + 1;

                } else {
                    $sale->daily_number = 1;
                }
            }
        elseif(getsetting('counter_type')=='daily_branch')
        {

            $exiss = AccountingSale::whereDate('created_at', date('Y-m-d'))->latest()->first();

            if (!is_null($exiss)) {

                $count1 = $exiss->daily_number ?? 1;

                $sale->daily_number = $count1 + 1;
                $sale->counter_sale = $sale->daily_number . "-" . $sale->branch->code;
            } else {
                $sale->daily_number =1;
                $sale->counter_sale = $sale->daily_number . "-" . $sale->branch->code;

            }
        }
       elseif(getsetting('counter_type')=='branch_device')
        {


           $exiss = AccountingSale::whereDate('created_at', date('Y-m-d'))->latest()->first();

           if (!is_null($exiss)) {

               $count1 = $exiss->daily_number ?? 1;

               $sale->daily_number = $count1 + 1;
               $sale->counter_sale = $sale->daily_number . "-" . $sale->branch->code??'' . "-" . $sale->session->device->code;
           } else {
               $sale->daily_number =1;
               $sale->counter_sale = $sale->daily_number . "-" . $sale->branch->code??'' . "-" . $sale->session->device->code;

           }
        }


    }
}
