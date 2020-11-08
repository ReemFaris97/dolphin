<?php

namespace App\Observers;


use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryLog;
use App\Models\AccountingSystem\AccountingStore;
use App\Models\AccountingSystem\AccountingSupplier;

class StoreObserver
{



    public  function  created(AccountingStore $store){
        AccountingAccount::create([
            'ar_name'=>$store->ar_name,
            'en_name'=>$store->en_name,
            'kind'=>'sub',
            'status'=>'debtor',
            'active'=>'1',
            'account_id'=>getsetting('accounting_id_stores'),
            'store_id'=>$store->id,
        ]);

    }


}
