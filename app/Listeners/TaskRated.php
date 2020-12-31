<?php

namespace App\Listeners;


use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskRated
{

    use FirebasOperation;

    public function handle(\App\Events\TaskRated $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم تقييم المهمه  '
            .$event->task->name.
            ' من قبل المشرف ';
        $type = 'rated_task';
        $data = [
            'item_id'=>$event->task->id,
            'message'=>$message,
            'type'=>$type,
        ];
        $current_task = $event->task->currentTask();

        $this->fire($title, $message, $data, User::where('id', $current_task->user_id)->get());

        optional($current_task->user)->sendNotification($data, $type);
    }

}
