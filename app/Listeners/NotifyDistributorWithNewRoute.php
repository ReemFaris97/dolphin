<?php

namespace App\Listeners;

use App\Events\DistributorRouteAdded as EventsDistributorRouteAdded;
use App\Traits\FirebasOperation;
use App\Models\DistributorRoute;
use App\Models\User;
use App\Events\DistributorRouteAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyDistributorWithNewRoute
{
    use FirebasOperation;

    /**
     * Handle the event.
     *
     * @param  DistributorRouteAdded  $event
     * @return void
     */
    public function handle(EventsDistributorRouteAdded $event)
    {
        $title = "هناك اشعار جديد";
        $message = "تم اضافه مسار جديد";
        $type = "new_distributor_route";
        $data = [
            "item_id" => $event->route->id,
            "message" => $message,
            "type" => $type,
            "title" => $title,
        ];

        $users = User::where("id", $event->route->user_id)->get();
        $this->fire($title, $message, $data, $users);
        /** @var  \App\Models\User $user  */

        foreach ($users as $user) {
            $user->sendNotification($data, $type);
        }
    }
}
