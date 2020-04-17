<?php

namespace App\Observers;

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
            if($purchase->payment=='agel') {

                $log=new AccountingSupplierLog();

                $log->supplier_id=$supplier->id;
                $log->return_id=$purchase->id;
                $log->amount=$purchase->total;
                $log->status='debit';
                $log->type='مرتجعات';
                $log->new_balance=round($supplier->balance,2);
                $log->save();
//                dd($log);
            }
        }
    }
}
