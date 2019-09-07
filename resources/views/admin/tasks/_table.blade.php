<!--begin: Datatable -->


{{--'name', 'phone', 'email', 'password', 'image', 'job', 'nationality', 'company_name', 'blocked_at', 'is_admin',--}}

<table class="table table-striped- table-bordered table-hover table-checkable datatable">
    <thead>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الوصف</th>
        <th>التاريخ</th>
        <th>النوع</th>
        <th>الاعدادت</th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)

        <tr>
            <td>{!!$loop->iteration!!}</td>
            <td>{!!$task->name!!}</td>
            <td style="width: 350px;">{!!$task->description!!}</td>
            <td>{!!optional($task->date)->toDateString()!!}</td>
            <td>{!!\App\Models\Task::$types[$task->type]!!}</td>
            <td>
                @if(auth()->user()->hasPermissionTo('view_tasks'))
                    <a href="{!!route('admin.tasks.show',$task->id)!!}" class="btn btn-info"> <i class="fas fa-eye"></i>
                        مشاهده</a>
                @endif
                    @if(auth()->user()->hasPermissionTo('edit_tasks') && $task->task_users->where('worker_finished_at','!=',null)->count()<=0)
                    <a href="{!!route('admin.tasks.edit',$task->id)!!}" class="btn btn-primary"> <i
                            class="fas fa-pen"></i>
                        تعديل</a>
                @endif
                @if(auth()->user()->hasPermissionTo('delete_tasks'))
                    <form method="POST" action="{!!route('admin.tasks.destroy',$task->id)!!}">
                        @csrf() @method('delete')
                        <button type="submit" class="btn btn-danger"
                                onclick="if(!confirm('هل انت متاكد من حذف المهمه')) event.preventDefault() ">
                            <i class="fas fa-trash"></i>
                            حذف
                        </button>
                    </form>
                @endif

            </td>

        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>الاسم</th>
        <th>الوصف</th>
        <th>التاريخ</th>
        <th>النوع</th>
        <th>الاعدادت</th>
    </tfoot>
</table>

