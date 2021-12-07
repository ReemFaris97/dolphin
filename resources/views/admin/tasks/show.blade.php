@extends('admin.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المهمات'=>route('admin.tasks.index'),$task->name=>route('admin.tasks.show',$task->id)])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <style>
        .informations p{
            width:30%;
            font-size: 16px;
            font-weight: 600;
        }

    </style>

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">

                        {!! $task->name !!}
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                </ul>
            </div>
        </div>
        <h4 style="margin: 15px 30px;">البيانات الأساسية</h4>
        <div style="display:flex; margin: 20px 50px; flex-wrap:wrap;" class="informations">
                            <p>الاسم :
                            {!!$task->name!!}</p>
                            <p>النوع :
                            {!!\App\Models\Task::$types[$task->type]!!}
                            </p>
                            <p>الوصف :
                            {!!$task->description!!}
                            </p>
                            @if($task->type=='date')
                                <p> التاريخ :
                                {!!$task->date->toDateString()!!}
                                </p>
                            @endif
                            <p>وقت بدايه المهمه :
                            {!!$task->time_from!!}
                            </p>
                            @if($task->type=='depends')
                                <p> البند :
                                {!!$task->clause->name!!}
                                </p>
                                <p> المعادله :
                                {!!$task->equation_mark .' ',$task->clause_amount!!}
                                </p>
                            @endif
                            @if($task->type=='period')
                                <p>الفتره :
                                    @switch($task->period)
                                        @case(1) يومية @break
                                        @case(30) شهرية @break
                                        @case(365) سنوية @break
                                    @endswitch
                                </p>
                            @endif
                            @if($task->type=='after_task'))
                                <p>المهمه المعتمده عليها :
                                {!!optional($task->afterTask)->name!!}
                                </p>
                            @endif
        </div>
        <div class="m-portlet__body">
            <ul class="nav nav-tabs" role="tablist">

                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#task_users">المنفذون</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#task_log">سجل تغير الموظفين</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#task_notes">ملاحظات المهمات </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " data-toggle="tab" href="#images">المرفقات</a>
                </li>
            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="task_users" role="tabpanel">
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>المده</th>
                            <th>التقيم</th>
                            <th>الموظف</th>
                            <th>القائم على التقيم</th>
                            <th>القائم على انهاء المهمه</th>
                            <th>تاريخ الانتهاء</th>
                            <th>تاريخ التقيم</th>
                            <th class="noExport">الاعدادت</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($task->task_users as $user)
                            <tr>
                                <td>{!! $loop->iteration !!}</td>
                                <td>
                                    <div>{!! $user->to_time->format('Y/m/d H:m:s') !!}</div>

                                                  <div data-countdown="{!! $user->to_time->format('Y/m/d H:m:s') !!}" >
                                                    {!! $user->to_time->format('Y/m/d H:m:s') !!}
                                                </div>


                                </td>
                                <td>{!!$user->rate!!} /5</td>
                                <td>{!!optional($user->user)->name!!}</td>
                                <td>{!!optional($user->rater)->name!!}</td>
                                <td>{!!optional($user->finisher)->name!!}</td>
                                <td>{!!\Carbon\Carbon::parse($user->finished_at)->toDateString()!!}</td>
                                <td>{!!$user->rated_at ? \Carbon\Carbon::parse($user->rated_at)->toDateString() : "لم تقيم بعد" !!}</td>
                                <td>

                                    @can('replace_tasks')
                                        <a class="btn btn-info" data-toggle="modal"
                                           data-target="#edit_task_{!! $user->id !!}">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    @endif
                                    @if($user->rate==null&& $user->rater_id==Auth::user()->id &&$user->finished_at!=null)
                                        <a class="btn btn-primary" data-toggle="modal"
                                           data-target="#rate_task_{!! $user->id !!}">
                                            <i class="fas fa-star"></i>
                                            تقيم
                                        </a>
                                    @endif

                                    @if($user->worker_finished_at== null && $user->user_id==Auth::user()->id)
                                        @if(\App\Models\Task::future()->where('id',$user->id)->first())
                                        <form method="POST" action="{!!route('admin.tasks.finishWorker',$user->id)!!}">
                                            @csrf()
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-check"></i>
                                                اتمام
                                            </button>
                                        </form>
                                        @endif
                                    @endif

                                        @php($check =  \App\Models\Task::present()->where('id',$user->id)->first())
                                        @if($user->finished_at==null && $user->finisher_id==Auth::user()->id && $user->can_finish &&$user->worker_finished_at!=null & !$check)
                                        <form method="POST" action="{!!route('admin.tasks.finish',$user->id)!!}">
                                            @csrf()
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-check"></i>
                                                انهاء
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>
                <div class="tab-pane " id="task_log" role="tabpanel">
                    <table class="table table-striped- table-bordered table-hover table-checkable datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الموظف السابق</th>
                            <th>الموظف الحالى</th>
                            <th>تاريخ التغير</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($task->task_users_logs as $log)
                            <tr>
                                <td>{!! $loop->iteration !!}</td>

                                <td>{!!optional($log->old_user)->name!!}</td>
                                <td>{!!optional($log->new_user)->name!!}</td>
                                <td>{!!optional($log->created_at)->toDateString()!!}</td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>


                <div class="tab-pane " id="task_notes" role="tabpanel" style=" margin-top: 15px;  margin-bottom: 55px;">
                    @if($task->finished_by == null)
                        @if(\App\Models\Task::future()->where('id',$user->id)->first())
                    <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#task_notes_create_modal">اضافه ملاحظه
                    </button>
                        @endif
                    @endif
                    <!--begin::Portlet-->
                    {{-- @foreach($task->notes as $note)
                        <div class="m-portlet m-portlet--bordered m-portlet--unair">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <h3 class="m-portlet__head-text">
                                            {!! optional($note->user)->name !!}
                                        </h3>


                                        <form method="POST" action="{!!route('admin.notes.destroy',$note->id)!!}"
                                              class="pull-left">
                                            @csrf() @method('delete')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="if(!confirm('هل انت متاكد من حذف الملاحظه')) event.preventDefault() ">
                                                <i class="fas fa-trash"></i>
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">

                                @if($note->image)

                                    <img src="{!! asset($note->image) !!}" width="200" height="200"
                                         class="mx-auto d-block rounded">

                                @endif
                                <div class="col-md-12 card-body ">
                                    <p> {!! $note->description !!}
                                    </p>
                                </div>
                            </div>


                        </div>
                @endforeach --}}





                 <!--begin::Portlet-->
				<table class="dataTable table table-striped- table-bordered table-hover table-checkable">
        <thead>
        <tr>
            <th>صاحب المهمة</th>
            <th>الوصف</th>
            <th>الصور</th>
            <th class="noExport">الاعدادت</th>
        </tr>
        </thead>
        <tbody>
        @foreach($task->notes as $note)
            <tr>
                <td>{!! optional($note->user)->name !!}</td>
                <td>{!! $note->description !!}</td>
				<td>
					<ul class="table-images-wrapper">
					@if($note->image)
<!--						if you want to put multiple images m please begin the foreach from here-->
						<li class="img-list-wrapper">
							<a href="{!! asset($note->image) !!}" data-fancybox="note-image">
								<img src="{!! asset($note->image) !!}">
							</a>
						</li>
<!--						and end it here-->
						@else
						<li>
							لا يوجد صورة
						</li>
						 @endif
					</ul>
				</td>
				<td>
					 <form method="POST" action="{!!route('admin.notes.destroy',$note->id)!!}" class="pull-left">
						@csrf() @method('delete')
						<button type="submit" class="btn btn-danger"
								onclick="if(!confirm('هل انت متاكد من حذف الملاحظه')) event.preventDefault() ">
							<i class="fas fa-trash"></i>
							حذف
						</button>
					</form>
				</td>
            </tr>
        @endforeach
        </tbody>
    </table>
                <!--end::Portlet-->






                </div>
                <div class="tab-pane " id="images" role="tabpanel" style=" margin-top: 15px;  margin-bottom: 55px;">
                    @if($task->finished_by == null)
                        @if(\App\Models\Task::future()->where('id',$user->id)->first())
                    <button type="button" class="btn btn-warning" data-toggle="modal"
                            data-target="#task_images_create_modal">اضافه مرفق
                    </button>
                        @endif
                    @endif
                    <!--begin::Portlet-->
                    <div class="m-portlet m-portlet--bordered m-portlet--unair">

                        <div class="m-portlet__body">
                            <div class="row appended-attachements-wrappers">
                                @foreach($task->images as $image)


                                <div class="appended-attachements-wrapper">
									<form method="POST" action="{!!route('admin.images.destroy',$image->id)!!}"
                                          class="pull-left">
                                        @csrf() @method('delete')
                                        <button type="submit" class="btn btn-danger"
                                                onclick="if(!confirm('هل انت متاكد من حذف المرفق')) event.preventDefault() ">
                                            <i class="fas fa-trash"></i>
                                            حذف
                                        </button>


                                    </form>
									<a href="{!! asset($image->image) !!}" class="mr-2" data-fancybox="images">
										<img src="{!! asset($image->image) !!}" />
									</a>
									</div>

                                @endforeach
                            </div>
                        </div>


                    </div>

                    <!--end::Portlet-->

                </div>


            </div>


        </div>
    </div>
    {{--modals--}}
    @php($users=\App\Models\User::pluck('name','id'))
    @foreach($task->task_users as $user)

        @can('replace_tasks')
            <!--begin:: edit task user Modal-->
            <div class="modal fade" id="edit_task_{!! $user->id !!}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                        {!! Form::model($user,['method'=>'put','route'=>['admin.task_user.update',$user->id]]) !!}

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">التقيم</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group m-form__group">
                                <label>الموظف </label>
                                {!! Form::select('user_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم الموظف'])!!}
                            </div>

                            <div class="form-group m-form__group ">
                                <div class="col-md-3 d-inline-block">
                                    <label> الايام </label>
                                    {!! Form::number('days',null,['class'=>'form-control m-input '])!!}
                                </div>
                                <div class="col-md-3 d-inline-block">
                                    <label> الساعات </label>
                                    {!! Form::number('hours',null,['class'=>'form-control m-input ','min'=>0,'max'=>24])!!}
                                </div>
                                <div class="col-md-3 d-inline-block ">
                                    <label> الدقائق </label>
                                    {!! Form::number('minutes',null,['class'=>'form-control m-input','min'=>0,'max'=>60])!!}
                                </div>

                            </div>
                            <div class="form-group m-form__group">
                                <label>اختار الموظف المقييم </label>
                                {!! Form::select('rater_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المقيم'])!!}
                            </div>


                            <div class="form-group m-form__group">
                                <label>اختيار الموظف لبلاغ الانتهاء </label>
                                {!! Form::select('finisher_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المنشئ'])!!}
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                            <button type="submit" class="btn btn-primary">انهاء</button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!--end::edit task user Modal-->
        @endcan
        @if($user->rate==null&& $user->rater_id==Auth::user()->id &&$user->finished_at!=null)

            <!--begin:: edit task user Modal-->
            <div class="modal fade" id="rate_task_{!! $user->id !!}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <form method="post" action="{!! route('admin.tasks.rate',$user->id) !!}">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">التقيم</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="recipient-name" class="form-control-label">التقيم</label>
                                    {!! Form::select('rate',[1=>1,2=>2,3=>3,4=>4,5=>5],null,['class'=>'from-control select2','style'=>'width:100%']) !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                <button type="submit" class="btn btn-primary">انهاء</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!--end::edit task user Modal-->
        @endif
    @endforeach
    {{--end modals--}}
    <!--begin::Modal-->
    <div class="modal fade" id="task_notes_create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{!! route('admin.task.note.store',$task->id) !!}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">اضافه ملاحظه</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="message-text" class="form-control-label">الملاحظه</label>
                            <textarea class="form-control" name="description" id="message-text"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="note-image" class="form-control-label">الصوره المرفقة</label>
                            <input id="note-image" type="file" name="image" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--end::Modal-->  <!--begin::Modal-->
    <div class="modal fade" id="task_images_create_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="post" action="{!! route('admin.task.images.store',$task->id) !!}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">

                        <h5 class="modal-title" id="exampleModalLabel">اضافه مرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="note-image" class="form-control-label">الصوره المرفقة</label>
                            <input id="note-image" type="file" name="image" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="submit" class="btn btn-primary">حفظ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@endsection
@section('scripts')
@endsection
