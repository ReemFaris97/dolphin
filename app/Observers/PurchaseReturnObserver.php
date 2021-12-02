<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryAccount;
use App\Models\AccountingSystem\AccountingPurchase;
use App\Models\AccountingSystem\AccountingPurchaseReturn;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingSupplierLog;

class PurchaseReturnObserver
{
    public function creating(AccountingPurchaseReturn $purchase)
    {
    }

    public function created(AccountingPurchaseReturn $purchase)
    {
        $supplier = AccountingSupplier::find($purchase->supplier_id);
        if ($supplier) {
            if ($purchase->payment=='agel') {
                $log=new AccountingSupplierLog();

                $log->supplier_id=$supplier->id;
                $log->return_id=$purchase->id;
                $log->amount=$purchase->total;
                $log->status='debit';
                $log->type='مرتجعات';
                $log->new_balance=round($supplier->balance, 2);
                $log->save();
//                dd($log);
            }
        }


        $entry=AccountingEntry::create([
            'date'=>$purchase->created_at,
            'source'=>' مرتجع مشتريات',
            'type'=>'automatic',
            'details'=>'فاتوره مرتجع مشتريات'.$purchase->bill_num,
            'status'=>'new'
        ]);

        if ($purchase->payment=='agel') {
            //حساب  المشتريات و المورد
            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>$supplier->account_id,
                'to_account_id'=>getsetting('accounting_id_purchases_returns'),
                'amount'=>$purchase->total,
            ]);

            //حساب  المشتريات والمخزون
            $storeAccount=AccountingAccount::where('store_id', $purchase->store_id)->first();
            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>getsetting('accounting_id_purchases_returns'),
                'to_account_id'=>$storeAccount->id,
                'amount'=>$purchase->total,
            ]);
        } elseif ($purchase->payment=='cash') {
            //حساب  المرتجعات والنقدية
            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>getsetting('accounting_id_cash'),
                'to_account_id'=>getsetting('accounting_id_purchases_returns'),
                'amount'=>$purchase->total,
            ]);
            //حساب  المرتجعات والمخزون
            $storeAccount=AccountingAccount::where('store_id', $purchase->store_id)->first();
            AccountingEntryAccount::create([
                'entry_id'=>$entry->id,
                'from_account_id'=>getsetting('accounting_id_purchases_returns'),
                'to_account_id'=>$storeAccount->id,
                'amount'=>$purchase->total,
            ]);
        }
    }
}
