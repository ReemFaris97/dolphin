<?php

namespace App\Listeners;

use App\Events\ChargeCreated;
use App\Traits\FirebasOperation;
use App\Models\User;

class ChargeCode
{
    use FirebasOperation;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function handle(ChargeCreated $event)
    {
        $title = "هناك اشعار جديد";
        $message =
            " كود تأكيد للعهده  " .
            $event->charge->name .
            " هي " .
            $event->charge->code;
        $type = "charge_code";
        $data = [
            "item_id" => $event->charge->id,
            "message" => $message,
            "type" => $type,
            "worker_name" => $event->charge->worker->name,
        ];

        $this->fire(
            $title,
            $message,
            $data,
            User::where("id", $event->charge->worker_id)->get()
        );
        $event->charge->worker->sendNotification($data, $type);
    }
}
