<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Http\Traits\FirebasOperation;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskReceive
{

    use FirebasOperation;

    public function handle(TaskCreated $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم اسناد المهمه  '
            .$event->task->name.
            ' اليك ';
        $type = 'new_task';
        $data = [
            'item_id'=>$event->task->id,
            'message'=>$message,
            'type'=>$type,
        ];
        $this->fire($title,$message,$data,User::where('id',$event->task->currentTask()->user_id)->get());
        $event->task->currentTask()->user->sendNotification($data,$type);
    }

}
