<?php

namespace App\Listeners;

use App\Http\Traits\FirebasOperation;
use App\Models\StoreTransferRequest;
use App\Events\StoreTransferRequestAdded;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyTransferRequestReceiver
{
    use FirebasOperation;


    /**
     * Handle the event.
     *
     * @param  StoreTransferRequestAdded  $event
     * @return void
     */
    public function handle(StoreTransferRequestAdded $event)
    {

        $title = 'هناك اشعار جديد';
        $message = "تم ارسال طلب نقل مخزون جديد";
        $type = 'new_store_transaction_added';
        $data = [
            'item_id' => $event->store_transaction->id,
            'message' => $message,
            'type' => $type,
        ];
        $users = User::where('id', $event->store_transaction->receiver_store_id)
            ->get();
        $this->fire($title, $message, $data, $users);
        /** @var  \App\Models\User $user  */
        foreach ($users as $user) {
            $user->sendNotification($data, $type);
        }
    }
}