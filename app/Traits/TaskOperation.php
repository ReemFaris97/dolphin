<?php


namespace App\Traits;


use App\Events\TaskCreated;
use App\Events\TaskFinished;
use App\Events\TaskRated;
use App\Events\WorkerTaskFinished;
use App\Models\Charge;
use App\Models\Image;
use App\Models\Note;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


trait TaskOperation
{

    public function RegisterTask($request)
    {
        $requests = $this->filterRequestOnType($request);
        DB::beginTransaction();
        try {
            $task = Task::create($requests);
            foreach ($request->users as $user)
                if ($user['user_id'] != null && $user['days'] != null && $user['hours'] != null && $user['minutes'] != null) {
                    if ($user['rater_id'] == 0) $user['rater_id'] = null;
                    if ($user['finisher_id'] == 0) $user['finisher_id'] = null;
                    $user['task_duration'] = toSeconds($user['days'], $user['hours'], $user['minutes']);
                    unset($user['days'], $user['hours'], $user['minutes']);
                    $task->users()->attach([$user['user_id'] => $user]);
                }

            DB::commit();

            event(new TaskCreated(new User(),$task));

            return $task;
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return false;
        }
    }

    public function UpdateTask($id, $request): bool
    {
        $task = Task::findOrFail($id);
        $requests = $this->filterRequestOnType($request);
        $task->fill($requests);
        return $task->save();
    }

    public function UpdateUserTask($id, $request): bool
    {
        $requests = $request->all();
        $requests['task_duration'] = toSeconds($requests['days'], $requests['hours'], $requests['minutes']);
        $task_user = TaskUser::find($id)->fill($requests);
        return $task_user->save();
    }

    public function TaskFinish($id): bool
    {
        $task = TaskUser::find($id);
        $task->fill(['finished_at' => Carbon::now()]);
        event(new TaskFinished(new User(),$task->task));
        return $task->save();
    }
    public function TaskWorkerFinish($id): bool
    {
        $task = TaskUser::find($id);
        $task->fill(['worker_finished_at' => Carbon::now()]);
        event(new WorkerTaskFinished(new User(),$task->task));
//        event(new TaskFinished(new User(),$task->task));
        return $task->save();
    }

    public function TaskRate($id, $request): bool
    {
        $task = TaskUser::find($id);
        $task->fill(['rate' => $request->rate, 'comment' => $request->comment]);
        event(new TaskRated(new User(),$task->task));
        return $task->save();
    }

    public function TaskAttachments($task, $request): void
    {
        foreach ($request->images as $image) {
            $task->images()->create(['image' => saveImage($image, '/images')]);
        }
    }

    public function addTaskNotes($task, $request)
    {
        $request['user_id'] = auth()->user()->id;
        $note = $task->notes()->create($request->all());
        return $note;
    }

    public function filterRequestOnType($request): array
    {
        $requests = $request->all();

        if ($request->type == 'date') {
            $requests = $request->only('name', 'description', 'user_id', 'type', 'date', 'time_from', 'users');
            $requests['date'] = Carbon::parse($requests['date']);
                $requests['time_from'] = Carbon::parse($requests['time_from']);

        } elseif ($request->type == 'period') {
            $requests = $request->only('name', 'description', 'user_id', 'type', 'date', 'time_from', 'users', 'period', 'date');
                $requests['date'] = Carbon::parse($requests['date']);
                $requests['time_from'] = Carbon::parse($requests['time_from']);

        } elseif ($request->type == 'after_task') {
            $requests = $request->only('name', 'description', 'user_id', 'type', 'users', 'after_task_id');

        } elseif ($request->type == 'depends') {
            $requests = $request->only('name', 'description', 'type', 'users', 'clause_id', 'clause_amount', 'equation_mark');

        }

        return $requests;
    }


    public function storeNote($id, $request): Note
    {
        $requests = $request->all();

        if ($request->hasFile('image')) {
            $requests['image'] = saveImage($request->image, 'notes');
        }

        $requests['user_id'] = \Auth::id();
        return Task::findOrFail($id)->notes()->create($requests);

    }

    public function storeImage($id, $request): Image
    {
        $requests = $request->all();
        $requests['image'] = saveImage($request->image, 'images');
        return Task::findOrFail($id)->images()->create($requests);
    }
}
