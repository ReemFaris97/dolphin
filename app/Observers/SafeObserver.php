<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingAccount;
use App\Models\AccountingSystem\AccountingBank;
use App\Models\AccountingSystem\AccountingPayment;
use App\Models\AccountingSystem\AccountingSafe;
use App\Models\Task;

class SafeObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\AccountingSystem\AccountingSafe  $safe
     * @return void
     */
    public function created(AccountingSafe $safe)
    {
        $account = AccountingAccount::create([
            "ar_name" => $safe->name,
            "en_name" => $safe->name,
            "kind" => "sub",
            "status" => "debtor",
            "active" => "1",
            "account_id" => getsetting("accounting_safe_id"),
            "safe_id" => $safe->id,
        ]);
        $safe->update([
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
