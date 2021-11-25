<div class="m-portlet__body">

    <div class="form-group m-form__group">
        <label>إسم المهمة</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>


    <div class="form-group m-form__group" style="flex: 0 0 30%; padding-top: 0;">
        <label>نوع المهمة</label>
        {{--{!! Form::select('type',\App\Models\Task::$types,'',['class'=>'form-control m-input select2','onChange'=>'change_inputs(this.value)'])!!}--}}

        <select name="type" class="form-control m-input select2" onchange="change_inputs(this.value)">
            <option value="" selected disabled>إختر نوع المهمة</option>
            @foreach(\App\Models\Task::$types as $key=>$value)
                <option value="{{$key}}">{{$value}}</option>
            @endforeach
        </select>

    </div>
    <div class="checker-wrapper" style="flex: 0 0 20%;">
		<input class="styled-checkbox checkbox_check" id="if-3-emps" type="checkbox" value="value1">
        <label for="if-3-emps" class="the-big-checklabel">مهمة لموظف واحد</label>
	</div>
    <div class="form-group m-form__group" style="flex: 1 0 100%;">
        <label>وصف المهمة</label>
        {!! Form::textarea('description',null,['class'=>'form-control m-input', 'style'=>'height: 130px;','placeholder'=>'الوصف'])!!}
    </div>


    <div class="form-group will-be-toggled m-form__group date-task period-task
        @if(isset($task))  {!! ShowOrHide($task,['period','date']) !!}  @else
        d-none @endif ">
        <label>تاريخ بدء المهمه</label>
        {!! Form::text('date',isset($task)?old('date')??optional($task->date)->format('m-d-Y'):old('date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
    </div>

    <div class="form-group m-form__group date-task period-task
        @if(isset($task))  {!! ShowOrHide($task,['period','date']) !!}  @else
        d-none @endif ">
        <label>الوقت</label>
        {!! Form::text('time_from',null,['class'=>'form-control m-input timepicker','autocomplete'=>'off'])!!}
    </div>






	<div id="threee-emps" style="
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content:space-between;">
    @if(!isset($task))
        @for($i=1;$i<=3;$i++)
            @include('admin.tasks._user_task')
        @endfor

    @endif

    <div class="form-group m-form__group depends-task
@if(isset($task))  {!! ShowOrHide($task,['depends']) !!}  @else  d-none @endif  ">
        <label>إختر البند</label>
        {!! Form::select('clause_id',$clauses,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم البند','id'=>'clauses'])!!}
    </div>
    <div class="form-group m-form__group depends-task
@if(isset($task))  {!! ShowOrHide($task,['depends']) !!}  @else   d-none @endif ">
        <label>قيمة  البند</label>
        {!! Form::number('clause_amount',null,['class'=>'form-control m-input ','id'=>'clause_amount'])!!}
    </div>


    <div class="form-group m-form__group depends-task
@if(isset($task))  {!! ShowOrHide($task,['depends']) !!}  @else d-none @endif ">
        <label>إختر  المعادله</label>
        {!! Form::select('equation_mark',[
            '<'=>'اكبر من', '>'=>'اصغر من', '=='=>'يساوى', '<='=>'اكبر من او يساوى', '>='=>'اصغر من او يساوى'],null,['class'=>'form-control m-input select2'])!!}
    </div>
    <div class="form-group m-form__group after_task-task
@if(isset($task))  {!! ShowOrHide($task,['after_task']) !!}   @else  d-none  @endif ">
        <label>المهمة الرئيسية</label>
        {!! Form::select('after_task_id',$tasks,null,['class'=>'form-control m-input select2'])!!}
    </div>
    <div class="form-group m-form__group period-task


        @if(isset($task))  {!! ShowOrHide($task,['period']) !!} @else  d-none @endif  ">
        <label>الفترة</label>
        {!! Form::select('period',['1'=>'يومية', '30'=>'شهرية', '365'=>'سنوية'],null,['class'=>'form-control m-input select2'])!!}
    </div>



</div>
</div>
