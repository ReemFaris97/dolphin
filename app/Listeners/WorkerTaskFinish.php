<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Events\WorkerTaskFinished;
use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class WorkerTaskFinish
{

    use FirebasOperation;

    public function handle(WorkerTaskFinished $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم أداء المهمة '
            .$event->task->name
           ;
        $type = 'finish_task';
        $data = [
            'item_id'=>$event->task->id,
            'message'=>$message,
            'type'=>$type,
        ];
        if ($event->task->currentTask()->finisher_id != null) {

            $this->fire($title, $message, $data, User::where('id', $event->task->currentTask()->finisher_id)->get());
            $event->task->currentTask()->finisher->sendNotification($data, $type);
        }
    }

}
