<?php

namespace App\Observers;

use App\Models\AccountingSystem\AccountingPayment;
use App\Models\Task;

class PaymentObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\AccountingSystem\AccountingPayment  $payment
     * @return void
     */
    public function creating(AccountingPayment $payment)
    {
        if ($payment->active == 1) {
            foreach (AccountingPayment::all() as $item) {
                $item->update([
                    "active" => 0,
                ]);
            }
        }
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
}
