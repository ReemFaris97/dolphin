<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingMoneyClause;
use App\Models\AccountingSystem\AccountingSupplier;
use App\Models\AccountingSystem\AccountingSupplierLog;

class MoneyClauseLogObserver
{
    public function created(AccountingMoneyClause $clause)
    {
        //        dd($clause);
        if ($clause->concerned == "supplier") {
            $supplier = AccountingSupplier::find($clause->supplier_id);

            if ($clause->type == "revenue") {
                $log = new AccountingSupplierLog();

                $log->supplier_id = $supplier->id;
                $log->clause_id = $clause->id;
                $log->amount = $clause->amount;
                $log->status = "creditor";
                $log->type = "سند قبض";
                $log->new_balance = round($supplier->balance, 2);
                $log->save();
            } else {
                $log = new AccountingSupplierLog();

                $log->supplier_id = $supplier->id;
                $log->clause_id = $clause->id;
                $log->amount = $clause->amount;
                $log->status = "debit";
                $log->type = "سند صرف";
                $log->new_balance = round($supplier->balance, 2);
                $log->save();
            }
        }
    }
}
