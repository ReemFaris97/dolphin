<?php

namespace App\Listeners;

use App\Http\Traits\FirebasOperation;
use App\Models\StoreTransferRequest;
use App\Events\StoreTransferRequestReceiver;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTransferRequestSender
{
    use FirebasOperation;



    /**
     * Handle the event.
     *
     * @param  StoreTransferRequestReceiver  $event
     * @return void
     */
    public function handle(StoreTransferRequestReceiver $event)
    {


        $title = 'هناك اشعار جديد';
        $message = "تم استلام طلب نقل المخزون";
        $type = 'new_store_transaction_received';
        $data = [
            'item_id' => $event->store_transaction->id,
            'message' => $message,
            'type' => $type,
            'title' => $title

        ];
        $users = User::where('id', $event->store_transaction->sender_id)
            ->get();
        $this->fire($title, $message, $data, $users);
        /** @var  \App\Models\User $user  */
        foreach ($users as $user) {
            $user->sendNotification($data, $type);
        }
    }
}
