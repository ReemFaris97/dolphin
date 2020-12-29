<table class="table table-striped- table-bordered table-hover table-checkable datatable">
    <thead>
    <tr>
        <th>#</th>
        <th>عنوان المهمه</th>
        <th>وصف المهمه</th>
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
    @foreach($task_users as $user)
        <tr>
            <td>{!! $loop->iteration !!}</td>
            <td>{!!optional($user->task)->name!!}</td>
            <td>{!!optional($user->task)->description!!}</td>
            <td>
                <div>{!! $user->to_time->format('Y/m/d H:m:s') !!}</div>
                <div data-countdown="{!! $user->to_time->format('Y/m/d H:m:s') !!}"></div>
            </td>
            <td>{!!$user->rate!!} /5</td>
            <td>{!!optional($user->user)->name!!}</td>
            <td>{!!optional($user->rater)->name!!}</td>
            <td>{!!optional($user->finisher)->name!!}</td>
            <td>{!!\Carbon\Carbon::parse($user->finished_at)->toDateString()!!}</td>
            <td>{!!\Carbon\Carbon::parse($user->rated_at)->toDateString()!!}</td>
            <td>


                @if($user->rate==null&& $user->rater_id==Auth::user()->id &&$user->worker_finished_at!=null)
                    <a class="btn btn-primary" data-toggle="modal"
                       data-target="#rate_task_{!! $user->id !!}">
                        <i class="fas fa-star"></i>
                        تقيم
                    </a>
                @endif
                @if(
                $user->worker_finished_at==null &&
                 $user->user_id==Auth::user()->id
                && $user->status=='active'
                )
                    <form method="POST" action="{!!route('admin.tasks.finishWorker',$user->id)!!}">
                        @csrf()
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-check"></i>
اتمام                        </button>
                    </form>
@endif
                    @if($user->finished_at==null && $user->finisher_id==Auth::user()->id &&  $user->worker_finished_at!=null)
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


@if($page_title='مهمات تحتاج للتقيم')
    @foreach($task_users as $user)
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
@endif
