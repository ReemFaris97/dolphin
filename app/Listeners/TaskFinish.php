<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskFinish
{

    use FirebasOperation;

    public function handle(TaskCreated $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم اسناد صلاحية انهاء المهمه  '
            .$event->task->name.
            ' اليك ';
        $type = 'finish_task';
        $data = [
            'item_id'=>$event->task->id,
            'message'=>$message,
            'type'=>$type,
        ];



        foreach ($event->task->user_tasks as $task_user) if ($task_user->finisher_id != null) {

            $user = User::where('id', $task_user->finisher_id)->get();
            $this->fire($title, $message, $data, $user);
            $user->first()->sendNotification($data, $type);
        }
        

    }

}
