<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingEntry;
use App\Models\AccountingSystem\AccountingEntryLog;
use App\Models\AccountingSystem\AccountingSupplier;

class SupplierObserver
{
    public function created(AccountingSupplier $supplier)
    {
        AccountingAccount::create([
            "ar_name" => $supplier->name,
            "en_name" => $supplier->name,
            "kind" => "sub",
            "status" => "Creditor",
            "active" => "1",
            "account_id" => getsetting("accounting_id_supplier"),
            "supplier_id" => $supplier->id,
        ]);
    }

    public function updated(AccountingSupplier $supplier)
    {
    }
}
