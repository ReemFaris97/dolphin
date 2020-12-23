<?php

namespace App\Observers;

use App\Events\TaskTransfered;
use App\Models\Task;
use App\Models\TaskLog;
use App\Models\TaskUser;
use App\Models\User;
use Carbon\Carbon;

class TaskUserObserver
{
    public function updating(TaskUser $taskUser)
    {
        if ($taskUser->isDirty('user_id')) {
            $new_user_id = $taskUser->user_id;
            $old_user_id = $taskUser->getOriginal('user_id');
            $task_id = $taskUser->task_id;
            TaskLog::create(compact('new_user_id', 'old_user_id', 'task_id'));
            event(new TaskTransfered(new User(), $taskUser->task));
        }
        if ($taskUser->isDirty('rate')) {
            $taskUser->rated_at = Carbon::now();
        }

        /*->where('worker_finished_at','!=',null)*/
        if ($taskUser->isDirty('worker_finished_at')) {

            ////start task after  task
            Task::where('after_task_id', $taskUser->task_id)->update(
                ['date' => $taskUser->finished_at, 'time_from' => $taskUser->finished_at]
            );
            ////start period   task

            if ($taskUser->task->type == 'period') {
                $task = $taskUser->task;
                $users = $taskUser->task->task_users;
                $task->date = $task->date->addDays($task->period);
                $task = Task::create($task->toArray());

                foreach ($users as $user) {
                    $user->task_id = $task->id;
                    $user->finished_at = null;
                    $user->rated_at = null;
                    $user->rate = null;
                    $user->comment = null;
                    $user->worker_finished_at = null;
                    TaskUser::create($user->toArray());
                }


            };


        }


    }


}
