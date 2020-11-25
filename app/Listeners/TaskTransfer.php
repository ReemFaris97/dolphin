<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Events\TaskTransfered;
use App\Http\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskTransfer
{

    use FirebasOperation;

    public function handle(TaskTransfered $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم نقل المهمه المسندة اليك  '
            .$event->task->name.
            ' الى موظف اخر ';
        $type = 'transfer_task';
        $data = [
            'item_id'=>$event->task->id,
            'message'=>$message,
            'type'=>$type,
        ];
        $this->fire($title,$message,$data,User::where('id',$event->task->currentTask()->worker_id)->get());
        $event->task->currentTask()->user->sendNotification($data,$type);
    }

}
