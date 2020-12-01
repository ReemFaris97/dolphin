<?php

namespace App\Listeners;

use App\Events\ClientActivationChanged;
use App\Http\Traits\FirebasOperation;
use App\Models\Client;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyDistributorWithNewActivationStatus
{
    use FirebasOperation;



    /**
     * Handle the event.
     *
     * @param  ClientActivationChanged  $event
     * @return void
     */
    public function handle(ClientActivationChanged $event)
    {
        $title = 'هناك اشعار جديد';
        $message = "تم تغير تفعيل عميل";
        $type = 'client_activation';
        $data = [
            'item_id' => $event->client->id,
            'message' => $message,
            'type' => $type,
            'title' => $title
        ];

        $users = User::where('is_distributor', 1)->get();

        $this->fire($title, $message, $data, $users);
        /** @var  \App\Models\User $user  */

        foreach ($users as $user) {
            $user->sendNotification($data, $type);
        }
    }
}
