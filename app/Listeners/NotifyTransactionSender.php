<?php

namespace App\Listeners;

use App\Traits\FirebasOperation;
use App\Models\DistributorTransaction;
use App\Events\DistributorTransactionReceived;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTransactionSender
{
    use FirebasOperation;



    /**
     * Handle the event.
     *
     * @param  DistributorTransactionReceived  $event
     * @return void
     */
    public function handle(DistributorTransactionReceived $event)
    {
        $title = 'هناك اشعار جديد';
        $message = "تم استلام المبلغ النقدى  ";
        $type = 'new_transaction_received';
        $data = [
            'item_id' => $event->transaction->id,
            'message' => $message,
            'type' => $type,
            'title' => $title

        ];
        if ($event->transaction->sender_type == User::class) {
            $users = User::where('id', $event->transaction->sender)
                ->get();
            $this->fire($title, $message, $data, $users);
            /** @var  \App\Models\User $user  */
            foreach ($users as $user) {
                $user->sendNotification($data, $type);
            }
        }
    }
}
