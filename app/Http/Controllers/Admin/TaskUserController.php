<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\TaskUser;
use App\Traits\Viewable;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\TaskController as Controller;
use Illuminate\Support\Facades\Auth;

class TaskUserController extends Controller
{
    use Viewable;
    protected $viewable = 'admin.task_users.';

    public function presentTasks()
    {
        $task_users = TaskUser::where('finished_at', null)->where(function ($q) {
            $q->where('finisher_id', \Auth::id());
            $q->orWhere('user_id', Auth::id());
        })->get()->filter('presentFilter')->reverse();
        $page_title = 'مهمات تحت العمل';
        return $this->toIndex(compact('task_users', 'page_title'));
    }

    public function TasksFinishedToDay()
    {
        $task_users = TaskUser::where('worker_finished_at', '!=', null)->whereDate('finished_at', date('Y-m-d'))->where('finisher_id', \Auth::id())->get()->reverse();
        $page_title = 'المهام المنتهيه اليوم';
        return $this->toIndex(compact('task_users', 'page_title'));
    }

    public function oldUnfinishedTask()
    {


        $task_users = TaskUser::notFinished()->get()->filter('oldFilter');
        $page_title = 'المهام السابقه الغير منتهيه';

        return $this->toIndex(compact('task_users', 'page_title'));

    }

    public function ratableTasks()
    {
        $task_users = TaskUser::where('finished_at', '!=', null)->where('rate', null)->where('rater_id', \Auth::id())->get()->reverse();
        $page_title = 'مهمات تحتاج للتقيم';
        return $this->toIndex(compact('task_users', 'page_title'));
    }
}
