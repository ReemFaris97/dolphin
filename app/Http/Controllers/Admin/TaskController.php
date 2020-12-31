<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Http\Requests\TaskUserRequest;
use App\Events\TaskRated;
use App\Models\Clause;
use App\Models\Task;
use App\Models\TaskUser;
use App\Traits\TaskOperation;
use App\Traits\Viewable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use PhpParser\Node\Expr\Array_;

class TaskController extends Controller
{
    use TaskOperation, Viewable;

    protected $viewable = 'admin.tasks.';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $old_tasks = Task::old(auth()->id())->with('task_users')->get()->reverse();;
        $present_tasks = Task::present(auth()->id())->with('task_users')->get()->reverse();
        $future_tasks = Task::future(auth()->id())->with('task_users')->get()->reverse();
        $page_title = "مهمات النظام";


        return $this->toIndex(compact('present_tasks', 'old_tasks', 'future_tasks', 'page_title'));
    }

    public function userTasks()
    {
        /*if (!auth()->user()->hasPermissionTo('view_tasks')) {
            return abort(401);
        }*/
        $present_tasks = Task::present(\Auth::id())->get()->reverse();
        $old_tasks = Task::old(\Auth::id())->get()->reverse();
        $future_tasks = Task::future(\Auth::id())->get()->reverse();
        $page_title = "المهمات المسنده الى ";
        return $this->toIndex(compact('present_tasks', 'old_tasks', 'future_tasks', 'page_title'));
    }

    public function CreatedTasks()
    {
        /*if (!auth()->user()->hasPermissionTo('view_tasks')) {
            return abort(401);
        }*/
        $present_tasks = Task::present()->where('user_id', \Auth::id())->get()->reverse();;
        $old_tasks = Task::old()->where('user_id', \Auth::id())->get()->reverse();;
        $future_tasks = Task::future()->where('user_id', \Auth::id())->get()->reverse();;
        $page_title = "المهمات المضافه";
        return $this->toIndex(compact('present_tasks', 'old_tasks', 'future_tasks', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->hasPermissionTo('add_tasks')) {
            return abort(401);
        }
        //       $tasks = Task::pluck('name', 'id');
        $present_tasks = Task::present()->get()->reverse()->pluck('name','id');
        $future_tasks = Task::future()->get()->reverse()->pluck('name','id');
        $tasks = $present_tasks->merge($future_tasks);


        $users = User::pluck('name', 'id');
        $clauses = Clause::pluck('name', 'id');


        return $this->toCreate(compact('tasks', 'users', 'clauses'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users = $request->users;
        foreach ($users as $i=>$user)
        {
            if ($user['user_id'] == null)
            {
                $user['days']=null;
                $user['hours']=null;
                $user['minutes']=null;
            }
        }
        $rules=[
            "name" => "required|string|max:191",
            "description" => "required|string",
            "type" => "required|string|in:period,date,after_task,depends",
            "date" => "nullable|date",
            "time_from" => "required_if:type,date|required_if:type,period|nullable",
            "clause_id" => "required_if:type,depends|nullable|integer|exists:clauses,id",
            "equation_mark" => "required_if:type,depends|nullable|in:<,>,==,<=,>=",
            "period" => "required_if:type,period|integer|nullable|min:0",
           // 'after_task_id' => 'required_if:type,after|nullable|integer|exists:tasks,id',
            'users'=>'required|array',
            "users.*.user_id" => 'nullable|integer|exists:users,id',
            "users.*.days" => "nullable|integer|min:0|max:265",
            "users.*.hours" => "nullable|integer|min:0|max:24",
            "users.*.minutes" => "nullable|integer|min:0|max:60",
            "users.*.rater_id" => "nullable|integer|exists:users,id",
            "users.*.finisher_id" =>"nullable|integer|exists:users,id",
            'clause_amount' => 'required_if:task,depends|nullable|min:0'];
        if ($request->after_task_id == 0) {
            $request['after_task_id'] = null;
        }
        // dd($request->all());
        $this->validate($request,$rules);
        $task = $this->RegisterTask($request);

        toast('تم الحفظ بنجاح', 'success', 'top-right');

        return redirect()->route('admin.tasks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return $this->toShow(compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->hasPermissionTo('edit_tasks')) {
            return abort(401);
        }

        $tasks = Task::pluck('name', 'id');

        $users = User::pluck('name', 'id');
        $clauses = Clause::pluck('name', 'id');

        $task = Task::findOrFail($id);
        return $this->toEdit(compact('users', 'tasks', 'clauses', 'task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $task_updated = $this->UpdateTask($id, $request);
        toast('تم التعديل بنجاح', 'success', 'top-right');

        return redirect()->route('admin.tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->hasPermissionTo('delete_tasks')) {
            return abort(401);
        }
        Task::destroy($id);
        toast('تم الحذف بنجاح', 'success', 'top-right');

        return back();
    }

    public function finishTask($id)
    {
        $this->TaskFinish($id);
        toast('تم انهاء بنجاح', 'success', 'top-right');

        return back();
    }

    public function finishWorkerTask($id)
    {
        $this->TaskWorkerFinish($id);
        toast('تم انهاء بنجاح', 'success', 'top-right');

        return back();
    }

    public function rateTask($id, Request $request)
    {
        $this->TaskRate($id, $request);
        toast('تم التقيم بنجاح', 'success', 'top-right');

        return back();
    }


    public function TaskUserUpdate($id, Request $request)
    {
        $rules = [
            "user_id" => 'required|integer|exists:users,id',
            "days" => "required|integer",
            "hours" => "required|integer",
            "minutes" => "required|integer",
            "rater_id" => "required|integer|exists:users,id",
            "finisher_id" =>"required|integer|exists:users,id",
        ];
        $messages = [
            "user_id.required"=>"اسم الموظف مطلوب",
            "days.required"=>"الأيام مطلوبة",
            "days.integer"=>"الأيام يجب ان تكون رقم صحيح",
            "hours.required"=>"الساعات مطلوبة",
            "hours.integer"=>"الساعات يجب ان تكون رقم صحيح",
            "minutes.required"=>"الدقائق مطلوبة",
            "minutes.integer"=>"الدقائق يجب ان تكون رقم صحيح",
            "rater_id.required"=>"الموظف المقيم مطلوب",
            "finisher_id.required"=>"موظف قائم بالإنهاء مطلوب",

        ];
        $this->validate($request,$rules,$messages);
        $this->UpdateUserTask($id, $request);
        toast('تم التعديل  بنجاح', 'success', 'top-right');
        return back();
    }

    public function storeTaskNote($id, Request $request)
    {
        $requests = $request->validate([
            'description' => 'required|string',
            'image' => 'nullable|image'
        ]);
        $this->storeNote($id, $request);
        toast('تم الاضافه بنجاح  بنجاح', 'success', 'top-right');
        return back();
    }

    public function storeTaskImage($id, Request $request)
    {
        $requests = $request->validate([
            'image' => 'required|image'
        ]);
        $this->storeImage($id, $request);
        toast('تم الاضافه بنجاح  بنجاح', 'success', 'top-right');
        return back();
    }

    public function getAjaxClauseAmount(Request $request){
        $clause = Clause::find($request->id);
        return response()->json([
            'status'=>true,
            'data'=>$clause->default_amount
        ]);

    }

    public function getReplacePage(){
        $users = User::pluck('name','id');
        return view('admin.tasks.replace_tasks',compact('users'));
    }

    public function getAjaxAllTasks(Request $request){
        if ($request->id !="")
        {
            $tasks_ids = User::find($request->id)->tasks->pluck('task_id');
            $allTasks = Task::whereIn('id',$tasks_ids)->get();
        }
        else{
            $allTasks = Task::get();
        }
        return response()->json([
            'status' => true,
            'data' =>   view('admin.tasks.getAjaxAllTasks')->with('allTasks',$allTasks)->render()
        ]);
    }
    public function postReplaceTasks(Request $request){

        $rules = [
            'previous_user_id' => 'required|integer|exists:users,id',
            'user_id' => 'required|integer|exists:users,id',
            'tasks' => 'required|array',
            'tasks.*' =>'required|integer|exists:tasks,id',
        ];
        $messages = [
            "previous_user_id.required"=>"الموظف السابق مطلوب",
            "previous_user_id.integer"=>"يجب اختيار موظف من الليست الموجودة",
            "user_id.required"=>"اسم الموظف مطلوب",
            "user_id.integer"=>"يجب اختيار موظف من الليست الموجودة",
            "tasks.required"=>"يجب اختيار مهمة او اكثر",
        ];

        $this->validate($request,$rules,$messages);


        foreach ($request->tasks as $task)
        {
            event(new TaskRated(Task::find($task)->creator,Task::find($task)));

            $task = TaskUser::where(['user_id'=>$request->previous_user_id,'task_id'=>$task])->first();
            if ($task)
            {
                $task->update(['user_id'=>$request->user_id,]);
            }
        }

        toast('تم تعديل اسناد المهمه بنجاح ', 'success', 'top-right');
        return redirect()->back();

    }



}
