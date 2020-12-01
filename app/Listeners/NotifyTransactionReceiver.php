<?php

namespace App\Listeners;

use App\Http\Traits\FirebasOperation;
use App\Models\DistributorTransaction;
use App\Events\DistributorTransactionAdded;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTransactionReceiver
{
    use FirebasOperation;

    /**
     * Handle the event.
     *
     * @param  DistributorTransactionAdded  $event
     * @return void
     */
    public function handle(DistributorTransactionAdded $event)
    {
        $title = 'هناك اشعار جديد';
        $message = "تم تحويل مبلغ نقدى جديد ";
        $type = 'new_transaction_added';
        $data = [
            'item_id' => $event->transaction->id,
            'message' => $message,
            'type' => $type,
            'title' => $title

        ];

        if ($event->transaction->receiver_type == User::class) {
            $users = User::where('id', $event->transaction->receiver_id)
                ->get();
            $this->fire($title, $message, $data, $users);
            /** @var  \App\Models\User $user  */

            foreach ($users as $user) {
                $user->sendNotification($data, $type);
            }
        }
    }
}
