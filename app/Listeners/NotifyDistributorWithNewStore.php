<?php

namespace App\Listeners;

use App\Traits\FirebasOperation;
use App\Models\Store;
use App\Events\NewStoreAdded;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyDistributorWithNewStore
{
    use FirebasOperation;

    /**
     * Handle the event.
     *
     * @param  NewStoreAdded  $event
     * @return void
     */
    public function handle(NewStoreAdded $event)
    {
        $title = "هناك اشعار جديد";
        $message = "تم اضافه مستودع جديد";
        $type = "new_store";
        $data = [
            "item_id" => $event->store->id,
            "message" => $message,
            "type" => $type,
            "title" => $title,
        ];
        if (
            $event->store->for_distributor == 1 &&
            $event->store->distributor_id != null
        ) {
            $users = User::where("id", $event->store->distributor_id)->get();

            $this->fire($title, $message, $data, $users);
            /** @var  \App\Models\User $user  */

            foreach ($users as $user) {
                $user->sendNotification($data, $type);
            }
        }
    }
}
