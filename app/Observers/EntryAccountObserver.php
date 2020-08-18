<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingAccountLog;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingEntryLog;

class EntryAccountObserver
{



    public  function  created(AccountingEntryAccount $entryAccount){

        AccountingEntryLog::create([
         'entry_id'=>$entryAccount->entry_id,
          'operation'=>'إضافة',
        //   'user_id'=>auth()->user()->id,
          'account_id'=>$entryAccount->from_account_id,
            'debtor'=>$entryAccount->amount
        ]);
        AccountingEntryLog::create([
            'entry_id'=>$entryAccount->entry_id,
            'operation'=>'إضافة',
            // 'user_id'=>auth()->user()->id,
            'account_id'=>$entryAccount->to_account_id,
            'creditor'=>$entryAccount->amount
        ]);

// dd($entryAccount->to_account_id);
////////////////////////الحساب المدين
 $aa=AccountingAccountLog::create([
    'entry_id'=>$entryAccount->entry_id,
    'account_id'=>$entryAccount->from_account_id,
    'account_amount_before'=>optional($entryAccount->form_account)->amount,
    'another_account_id'=>$entryAccount->to_account_id,
    'amount'=>$entryAccount->amount,
    'account_amount_after'=>optional($entryAccount->from_account)->amount+$entryAccount->amount,
    'affect'=>'debtor',
]);
////////////////////////الحساب الدائن
        AccountingAccountLog::create([
            'entry_id'=>$entryAccount->entry_id,
            'account_id'=>$entryAccount->to_account_id,
            'account_amount_before'=>optional($entryAccount->to_account)->amount,
            'another_account_id'=>$entryAccount->from_account_id,
            'amount'=>$entryAccount->amount,
            'account_amount_after'=>optional($entryAccount->to_account)->amount-$entryAccount->amount,
            'affect'=>'creditor',
        ]);


     $debtorAccount=AccountingAccount::find($entryAccount->to_account_id);
     $creditorAccount=AccountingAccount::find($entryAccount->from_account_id);

//     $debtorAccount->update([
//        'amount'=>$debtorAccount->amount-$entryAccount->amount,
//     ]);
//
//     $creditorAccount->update([
//        'amount'=>$creditorAccount->amount+$entryAccount->amount,
//     ]);
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
