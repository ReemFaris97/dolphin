<?php

namespace App\Listeners;

use App\Events\BankDepositConfirmed;
use App\Models\User;
use App\Traits\FirebasOperation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyDistributorConfirmation
{

    use FirebasOperation;

    /**
     * Handle the event.
     *
     * @param \App\Events\BankDepositConfirmed $event
     * @return void
     */
    public function handle(BankDepositConfirmed $event)
    {
        $title = 'تأكيد عملية ايداع';
        $message = $event->bankDeposit->deposit_number . " تم تأكيد عملية الايداع رقم : ";
        $type = 'deposit_confirmed';

        $data = [
            'item_id' => $event->bankDeposit->deposit_number,
            'message' => $message,
            'type' => $type,
            'title' => $title
        ];

        $user = User::whereId($event->bankDeposit->user_id)->first();
        $this->fire($title, $message, $data, $user);
        $user->sendNotification($data, $type);
    }
}
