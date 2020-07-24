<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
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
               $sale->counter_sale = $sale->daily_number . "-" . optional($sale->branch)->code??'' . "-" . $sale->session->device->code;

           }
        }


    }

    public  function  created(AccountingSale $sale){

        $entry=AccountingEntry::create([
            'date'=>$sale->created_at,
            'source'=>'مبيعات',
            'type'=>'automatic',
            'details'=>'فاتوره مبيعات'.$sale->bill_num,
            'status'=>'new'
        ]);

        if ($sale->payment=='cash'){
            $saleAccount=AccountingAccount::find(getsetting('accounting_id_sales'));

            if (isset($saleAccount)) {
                dd($saleAccount);
                //حساب  المبيعات والنقدية
                AccountingEntryAccount::create([
                    'entry_id' => $entry->id,
                    'from_account_id' => getsetting('accounting_id_cash'),
                    'to_account_id' => getsetting('accounting_id_sales'),
                    'amount' => $sale->total,
                ]);
                //حساب  المبيعات والمخزون
                $storeAccount = AccountingAccount::where('store_id', $sale->store_id)->first();
                AccountingEntryAccount::create([
                    'entry_id' => $entry->id,
                    'from_account_id' => getsetting('accounting_id_sales'),
                    'to_account_id' => $storeAccount->id,
                    'amount' => $sale->total,
                ]);
            }
        }


    }


}
