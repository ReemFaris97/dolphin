<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;

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
        foreach ($event->task->user_tasks as $task_user) {
            $user = User::where('id', $task_user->user_id)->get();
            // dd($user);
            $this->fire($title, $message, $data, $user);
            $user->first()->sendNotification($data, $type);
        }
    }

}
