<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Events\TaskRated;
use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskRate
{

    use FirebasOperation;

    public function handle(TaskCreated $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم اسناد صلاحية تقييم المهمه  '
            . $event->task->name .
            ' اليك ';
        $type = 'rate_task';
        $data = [
            'item_id' => $event->task->id,
            'message' => $message,
            'type' => $type,
        ];

        foreach ($event->task->user_tasks as $task_user) if ($task_user->rater_id != null) {

            $user = User::where('id', $task_user->rater_id)->get();
            $this->fire($title, $message, $data, $user);
            $user->first()->sendNotification($data, $type);
        }


    }

}
