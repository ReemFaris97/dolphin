<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\Task;

class BankObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\AccountingSystem\AccountingBank  $bank
     * @return void
     */
    public function created(AccountingBank $bank)
    {
        $account = AccountingAccount::create([
            "ar_name" => $bank->name,
            "en_name" => $bank->name,
            "kind" => "sub",
            "status" => "debtor",
            "active" => "1",
            "account_id" => getsetting("accounting_bank_id"),
            "bank_id" => $bank->id,
        ]);
        $bank->update([
            "account_id" => $account->id,
        ]);
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
}
