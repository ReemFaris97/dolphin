<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingSupplierLog;

class PurchaseObserver
{

    public function creating(AccountingPurchase $purchase)
    {

        $exiss = AccountingPurchase::whereDate('created_at', date('Y-m-d'))->latest()->first();
        if (!is_null($exiss)) {
            $count = $exiss->daily_number ?? 1;
            $purchase->daily_number = $count + 1;

        } else {
            $purchase->daily_number = 1;
        }


    }

    public function created(AccountingPurchase $purchase)
    {

        $supplier = AccountingSupplier::find($purchase->supplier_id);
        if ($supplier) {
            if($purchase->payment=='agel') {
                $balance=$purchase->total;
                $supplier->balance = +$balance;

                $log=new AccountingSupplierLog();

                $log->supplier_id=$supplier->id;
                $log->purchase_id=$purchase->id;
                $log->amount=$purchase->total;
                $log->status='creditor';
                $log->type='مشتريات';
                $log->new_balance=round($supplier->balance,2);
                $log->save();
//                dd($log);
            }
        }
        $entry=AccountingEntry::create([
            'date'=>$purchase->created_at,
            'source'=>'مشتريات',
            'type'=>'automatic',
            'details'=>'فاتوره مشتريات'.$purchase->bill_num,
            'status'=>'new'
        ]);

       if ($purchase->payment=='agel'){
           //حساب  المشتريات و المورد
       $toAccount=AccountingAccount::where('supplier_id',$supplier->id)->first();
    //    dd( $toAccount);
           AccountingEntryAccount::create([
               'entry_id'=>$entry->id,
               'account_id'=>getsetting('accounting_id_purchases'),
               'amount'=>$purchase->total,
               'affect'=>'debtor'
           ]);

           AccountingEntryAccount::create([
            'entry_id'=>$entry->id,
            'account_id'=>$toAccount->id,
            'amount'=>$purchase->total,
            'affect'=>'creditor'
        ]);

           //حساب  المشتريات والمخزون
//           dd($purchase->store_id);
           $storeAccount=AccountingAccount::where('store_id',$purchase->store_id)->first();
           AccountingEntryAccount::create([
               'entry_id'=>$entry->id,
               'account_id'=>$storeAccount->id,
               'amount'=>$purchase->total,
               'affect'=>'debtor'
           ]);

           AccountingEntryAccount::create([
            'entry_id'=>$entry->id,

            'account_id'=>getsetting('accounting_id_purchases'),
            'amount'=>$purchase->total,
            'affect'=>'creditor'
        ]);

       }elseif ($purchase->payment=='cash'){
           //حساب  المشتريات والنقدية
           AccountingEntryAccount::create([
               'entry_id'=>$entry->id,
               'account_id'=>getsetting('accounting_id_purchases'),
            //    'to_account_id'=>getsetting('accounting_id_cash'),
               'amount'=>$purchase->total,
           'affect'=>'debtor'
           ]);

        //    AccountingEntryAccount::create([
        //     'entry_id'=>$entry->id,
        //   'account_id'=>getsetting('accounting_id_cash'),
        //     'amount'=>$purchase->total,
        // 'affect'=>'creditor'
        // ]);
           //حساب  المشتريات والمخزون

           $storeAccount=AccountingAccount::where('store_id',$purchase->store_id)->first();
           AccountingEntryAccount::create([
               'entry_id'=>$entry->id,
            //    'from_account_id'=>$storeAccount->id,
               'account_id'=>getsetting('accounting_id_purchases'),
               'amount'=>$purchase->total,
               'affect'=>'creditor',
           ]);

           AccountingEntryAccount::create([
            'entry_id'=>$entry->id,
           'account_id'=>$storeAccount->id,
            // 'account_id'=>getsetting('accounting_id_purchases'),
            'amount'=>$purchase->total,
            'affect'=>'debtor',
        ]);
       }


    }
}
