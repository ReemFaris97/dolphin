<?php

namespace App\Observers;


use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingEntryLog;

class EntryAccountObserver
{



    public  function  created(AccountingEntryAccount $entryAccount){

        AccountingEntryLog::create([
         'entry_id'=>$entryAccount->entry_id,
          'operation'=>'إضافة',
          'user_id'=>auth()->user()->id,
          'account_id'=>$entryAccount->from_account_id,
            'debtor'=>$entryAccount->amount
        ]);
        AccountingEntryLog::create([
            'entry_id'=>$entryAccount->entry_id,
            'operation'=>'إضافة',
            'user_id'=>auth()->user()->id,
            'account_id'=>$entryAccount->to_account_id,
            'creditor'=>$entryAccount->amount
        ]);

    }

    public  function  updated(AccountingEntryAccount $entryAccount){

        AccountingEntryLog::create([
            'entry_id'=>$entryAccount->entry_id,
            'operation'=>'إضافة',
            'user_id'=>auth()->user()->id,
            'account_id'=>$entryAccount->from_account_id,
            'debtor'=>$entryAccount->amount
        ]);
        AccountingEntryLog::create([
            'entry_id'=>$entryAccount->entry_id,
            'operation'=>'إضافة',
            'user_id'=>auth()->user()->id,
            'account_id'=>$entryAccount->to_account_id,
            'creditor'=>$entryAccount->amount
        ]);
    }

}
