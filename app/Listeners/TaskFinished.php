<?php

namespace App\Listeners;


use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskFinished
{

    use FirebasOperation;

    public function handle(\App\Events\TaskFinished $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم انهاء المهمه  '
            . $event->task->name .
            ' من قبل المشرف ';
        $type = 'finished_task';
        $data = [
            'item_id' => $event->task->id,
            'message' => $message,
            'type' => $type,
        ];
        if ($event->task->currentTask()->finisher_id != null) {
            $this->fire($title, $message, $data, User::where('id', $event->task->currentTask()->user_id)->get());
            $event->task->currentTask()->user->sendNotification($data, $type);
        }
    }

}
