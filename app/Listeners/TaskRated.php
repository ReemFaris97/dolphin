<?php

namespace App\Listeners;


use App\Http\Traits\FirebasOperation;
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
        $this->fire($title,$message,$data,User::where('id',$event->task->currentTask()->user_id)->get());
        $event->task->currentTask()->user->sendNotification($data,$type);
    }

}
