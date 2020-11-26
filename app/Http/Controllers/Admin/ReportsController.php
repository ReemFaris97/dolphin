<?php

namespace App\Http\Controllers\Admin;

use App\Models\TaskUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function getWorkerForm()
    {
        if(!auth()->user()->hasPermissionTo('view_workers_reports')){
            return abort(401);
        }
        $users = User::pluck('name', 'id');
        return view('admin.reports.worker_form', compact('users'));
    }

    public function workerReport(Request $request)
    {

        $this->validate($request,['user_id'=>"required"],['user_id.required'=>"إسم الموظف مطلوب"]);
        $user = User::find($request->user_id);
        $rows = TaskUser::where('finished_at', '!=', null)->whereUserId($request->user_id)->get();

        if ($request->from != null) {

            $rows = $rows->filter(function ($task_user) use ($request) {
                $from_date = Carbon::parse($request->from);
                return optional($task_user->finished_at)->greaterThanOrEqualTo($from_date);
            });
        }
        if ($request->to != null) {

            $rows = $rows->filter(function ($task_user) use ($request) {
                $to_date = Carbon::parse($request->to);
                return optional($task_user->finished_at)->lessThanOrEqualTo($to_date);
            });
        }
        /*      $rows = $rows->filter(function ($task_user) use ($request) {
                  $from_date = Carbon::parse($request->from);
                  $to_date = Carbon::parse($request->to);
                  return optional($task_user->finished_at)->between($from_date, $to_date);
              });*/
        return view('admin.reports.worker_details', compact('rows', 'user'));

    }
    public function TaskSearch(Request $request)
    {
        $task_users = TaskUser::whereHas('task', function ($task) use ($request) {
            $task->where('name', 'like', "%{$request->name}%");
        })->get();
        $page_title = " {$request->name}نتائج البحث عن ";

        return view('admin.task_users.index', compact('task_users', 'page_title'));

    }
}
