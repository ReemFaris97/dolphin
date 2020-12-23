<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskCreated;
use App\Events\TaskFinished;
use App\Events\TaskRated;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\LastTasks;
use App\Http\Resources\ReportResource;
use App\Http\Resources\SingleTaskResource;
use App\Http\Resources\SingleTasksUpdateResource;
use App\Http\Resources\TasksResource;
use App\Models\Clause;
use App\Models\Image;
use App\Models\Note;
use App\Models\NotificationCategory;
use App\Models\Task;
use App\Models\TaskUser;
use App\Traits\ApiResponses;
use App\Traits\TaskOperation;
use App\Traits\Viewable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    use ApiResponses,TaskOperation;

    public function index()
    {

        if (\request('type') == "present")
            $tasks =  Task::present(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
        elseif (\request('type') == "future")
            $tasks = Task::future(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
        elseif (\request('type') == "old")
            $tasks = Task::old(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
        elseif (\request('type') == "to_finish")
            $tasks = Task::toFinish(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
        elseif (\request('type') == "to_rate")
            $tasks = Task::toRate(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
        elseif (\request('type') == "mine")
            $tasks = Task::Mine(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
        else
            $tasks = Task::whereUserId(auth()->user()->id)->orderby('id','desc')->paginate($this->paginateNumber);
     dd($tasks);
        return $this->apiResponse(new TasksResource($tasks));
    }

    public function home()
    {
        $present_tasks = Task::present(auth()->user()->id)->count();
        $old_tasks = Task::old(auth()->user()->id)->count();
        $future_tasks = Task::future(auth()->user()->id)->count();
        $finished_user_tasks = TaskUser::whereNotNull('finished_at')
            ->where('user_id',auth()->user()->id)->orderby('finished_at','desc')->whereDate('finished_at',Carbon::today())->get()->take(5);
        $data = [
          'present_tasks'=>$present_tasks,
          'old_tasks'=>$old_tasks,
          'future_tasks'=>$future_tasks,
          'finished_tasks'=>LastTasks::collection($finished_user_tasks),
        ];
        return $this->apiResponse($data);
    }

    public function homeToFinish()
    {
        $toRateTasks = Task::toRate(auth()->user()->id)->count();
        $toFinishTasks = Task::toFinish(auth()->user()->id)->count();

        $data = [
          'to_rate_tasks'=>$toRateTasks,
          'to_finish_tasks'=>$toFinishTasks,
        ];
        return $this->apiResponse($data);
    }

    public function show($id)
    {

        $task = Task::find($id);
        if (!$task) return $this->notFoundResponse();
        return $this->apiResponse(new SingleTaskResource($task));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $request['users'] = json_decode($request->users,TRUE);
        $rules = [
            "name" => "required|string|max:191",
            "description" => "required|string",
            "type" => "required|string|in:period,date,after_task,depends",
            "date" => "nullable|date",
            "time_from" => "required_if:type,date|required_if:type,period|nullable",
            "clause_id" => "required_if:type,depends|nullable|integer|exists:clauses,id",
            "equation_mark" => "required_if:type,depends|nullable|in:<,>,=,<=,>=",
            "period" => "required_if:type,period|integer|nullable",
            'after_task_id' => 'required_if:type,after|nullable|integer|exists:tasks,id',
            'users'=>'required|array',
            "users.*.user_id" => 'nullable|integer|exists:users,id',
            "users.*.days" => "nullable|integer|min:0|max:265",
            "users.*.hours" => "nullable|integer|min:0|max:24",
            "users.*.minutes" => "nullable|integer|min:0|max:60",
//            "users.*.rater_id" => "nullable|integer|exists:users,id",
//            "users.*.finisher_id" =>"nullable|integer|exists:users,id",
            'clause_amount' => 'required_if:task,depends|nullable',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $task = $this->RegisterTask($request);
        if ($task == false) return $this->unKnowError();
//        event(new TaskCreated($task->creator,$task));
        return $this->apiResponse(new SingleTasksUpdateResource($task));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $task = Task::find($id);
        if (!$task) return $this->notFoundResponse();
        $rules = [
            "name" => "sometimes|string|max:191",
            "description" => "sometimes|string",
            "type" => "sometimes|string|in:period,date,after_task,depends",
            "date" => "nullable|date",
            "time_from" => "nullable",
            "clause_id" => "nullable|integer|exists:clauses,id",
            "equation_mark" => "nullable|in:<,>,=,<=,>=",
            "period" => "nullable",
            'after_task_id' => 'nullable|integer|exists:tasks,id',
            'clause_amount' => 'nullable'
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $this->UpdateTask($id,$request);
        return $this->apiResponse(new SingleTasksUpdateResource($task));
    }


    public function workerFinish($id)
    {
        $task = Task::find($id);
        if (!$task) return  $this->notFoundResponse();
        $task_user_id= $task->currentTask()->id;
        $this->TaskWorkerFinish($task_user_id);

        $task_user = TaskUser::find($task_user_id);
        if ($task_user)
        {
            if (is_null($task_user->finisher_id))
                $this->finish($id);
        }

        return $this->apiResponse('تم انجاز المهمة بنجاح');

    }

    public function finish($id)
    {
        $task = Task::find($id);
        if (!$task) return  $this->notFoundResponse();
        $task_user_id= $task->currentTask()->id;
        $this->TaskFinish($task_user_id);
//        event(new TaskFinished($task->creator,$task));
        return $this->apiResponse('تم انهاء المهمة بنجاح');
    }

    public function rate(Request $request,$id)
    {
        $task = Task::find($id);
       if (!$task) return  $this->notFoundResponse();

        $rules = [
            "rate" => "required|integer",
            "comment" => "nullable|string",
        ];

        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }

       $task_user_id= $task->currentTask()->id;
       $this->TaskRate($task_user_id,$request);
//        event(new TaskRated($task->creator,$task));
       return $this->apiResponse('تم التقييم بنجاح');
    }

    public function addAttachment(Request $request,$id)
    {
        $task = Task::find($id);
       if (!$task) return  $this->notFoundResponse();
        $rules = [
            'image' => 'required|mimes:jpg,jpeg,gif,png'
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $requests['image'] = saveImage($request->image, 'images');
        $image = $task->images()->create($requests);
        $data =['id'=>$image->id,'image'=>getimg($image->image)];
       return $this->apiResponse($data);
    }

    public function destroy($id)
    {
        $task = Task::find($id);
        if (!$task) return $this->notFoundResponse();
        $task->delete();
        return $this->apiResponse('تم الحذف بنجاح');
    }

    public function deleteImage($id)
    {
        $image = Image::find($id);
        if (!$image) return $this->notFoundResponse();
        $image->delete();
        return $this->apiResponse('تم الحذف بنجاح');
    }

    public function deleteNote($id)
    {
        $note = Note::find($id);
        if (!$note) return $this->notFoundResponse();
        $note->delete();
        return $this->apiResponse('تم الحذف بنجاح');
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    public function addNotes(Request $request,$id)
    {
        $task = Task::find($id);
        if (!$task) return $this->notFoundResponse();
        $rules = [
            'description' => 'required|string',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $note = $this->addTaskNotes($task,$request);
        $data = [
            'id'=>$note->id,
            'description'=>$note->description,
            'user_name'=>$note->user->name,
            'can_delete'=>($note->user_id === auth()->user()->id)?true:false,
        ];
        return $this->apiResponse($data);
    }

    public function reAssignTasks(Request $request)
    {
        $rules = [
            'previous_user_id' => 'required|integer|exists:users,id',
            'user_id' => 'required|integer|exists:users,id',
            'tasks' => 'required|array',
            'tasks.*' =>'required|integer|exists:tasks,id',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }

        foreach ($request->tasks as $task)
        {
            event(new TaskRated(Task::find($task)->creator,Task::find($task)));

            $task = TaskUser::where(['user_id'=>$request->previous_user_id,'task_id'=>$task])->first();
            if ($task)
            {
                $task->update(['user_id'=>$request->user_id,]);
            }
        }

        return $this->apiResponse('تم تعديل اسناد المهمه بنجاح ');
    }

    public function Report(Request $request)
    {
        $rules = [
            'worker_id' => 'required|integer|exists:users,id',
            'from' => 'required|date',
            'to' => 'required|date',
        ];
        $validation = $this->apiValidation($request,$rules);
        if ($validation instanceof Response) {
            return $validation;
        }
        $rows = TaskUser::whereUserId($request->worker_id)->whereNotNull('finished_at')->get();
        $tasks = $rows->filter(function ($task_user)use ($request){
            $from_date=Carbon::parse($request->from);
            $to_date=Carbon::parse($request->to);
            return ($from_date->greaterThanOrEqualTo($task_user->to_time)
                &&$to_date->lessThanOrEqualTo($task_user->from_time));
        });

        return $this->apiResponse(['rate'=>rates()[round(User::find($request->worker_id)->rate())??0],'tasks'=>new ReportResource($tasks)]);

    }

}
