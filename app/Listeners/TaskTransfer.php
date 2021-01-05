<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Events\TaskTransfered;
use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TaskTransfer
{

    use FirebasOperation;

    public function handle(TaskTransfered $event)
    {
        $this->notifyOldWorker($event);
        $this->notifyNewWorker($event);
    }

    public function notifyOldWorker($event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم نقل المهمه المسندة اليك  '
        . $event->task->task->name .
            ' الى موظف اخر ';
        $type = 'transfer_task';
        $data = [
            'item_id' => $event->task->task_id,
            'message'=>$message,
            'type'=>$type,
        ];
        $user = User::where('id', $event->task->getOriginal('user_id'))->get();
        $this->fire($title, $message, $data, $user);
        $user->first()->sendNotification($data, $type);

    }
    public function notifyNewWorker($event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم اسناد المهمه  '
        . $event->task->name .
            ' اليك ';
        $type = 'new_task';
        $data = [
            'item_id' => $event->task->task_id,
            'message' => $message,
            'type' => $type,
        ];
        $user =  $event->task->user()->get();
        $this->fire($title, $message, $data, $user);
        $user->first()->sendNotification($data, $type);

    }
}
