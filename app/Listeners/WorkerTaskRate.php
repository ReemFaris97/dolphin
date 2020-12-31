<?php

namespace App\Listeners;

use App\Events\ChargeReceived;
use App\Events\TaskCreated;
use App\Events\TaskRated;
use App\Events\WorkerTaskFinished;
use App\Traits\FirebasOperation;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
class WorkerTaskRate
{

    use FirebasOperation;

    public function handle(WorkerTaskFinished $event)
    {
        $title = 'هناك اشعار جديد';
        $message = ' تم أداء المهمة   '
            . $event->task->name .
            'برجاء تقيمها';
        $type = 'rate_task';
        $data = [
            'item_id' => $event->task->id,
            'message' => $message,
            'type' => $type,
        ];
        if ($event->task->currentTask()->rater_id != null) {

            $this->fire($title, $message, $data, User::where('id', $event->task->currentTask()->rater_id)->get());
            $event->task->currentTask()->rater->sendNotification($data, $type);
        }

    }

}
