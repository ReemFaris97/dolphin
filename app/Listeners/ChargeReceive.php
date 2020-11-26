<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Http\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChargeReceive
{

    use FirebasOperation;

    public function handle(ChargeReceived $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم تأكيد استلامك للعهده  '
            .$event->charge->name.
            ' من المشرف ';
        $type = 'charge';
        $data = [
            'item_id'=>$event->charge->id,
            'message'=>$message,
            'type'=>$type,
            'worker_name'=>$event->charge->worker->name
        ];
        $this->fire($title,$message,$data,User::where('id',$event->charge->worker_id)->get());
        $event->charge->worker->sendNotification($data,$type);
    }

}
