<div class="one-single-emp-wrapper">
	
	<div class="form-group m-form__group">
	<label>الموظف {{$i }}</label>
	{!! Form::select('users['.$i.'][user_id]',$users,"",['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم الموظف'])!!}

</div>

{{--
<div class="form-group m-form__group date-task
@if(isset($task))  {!! ShowOrHide($task,['period','date']) !!}@endif ">
    <label> تاريخ بدء المهمه {{$i}}</label>
{!! Form::text('users['.$i.'][date]',null,['class'=>'form-control m-input datepicker'])!!}
</div>--}}
<div class="form-group m-form__group d-flexx">
<div class="col-md-4 d-inline-block">
		<label> الايام {{$i }} </label>
		{!! Form::number('users['.$i.'][days]',0,['class'=>'form-control m-input ','oninput'=>'this.value = Math.abs(this.value)'])!!}
	</div>
	<div class="col-md-4 d-inline-block">
		<label> الساعات {{ $i }} </label>
		{!! Form::number('users['.$i.'][hours]',0,['class'=>'form-control m-input ','min'=>0,'max'=>24,'oninput'=>'this.value = Math.abs(this.value)'])!!}
	</div>
	<div class="col-md-4 d-inline-block ">
		<label> الدقائق {{ $i }} </label>
		{!! Form::number('users['.$i.'][minutes]',0,['class'=>'form-control m-input','min'=>0,'max'=>60,'oninput'=>'this.value = Math.abs(this.value)'])!!}
	</div>
</div>

<div class="single-magic">
    <div class="checker-wrapper">
        <input class="styled-checkbox checkbox_check" id="if-{{ $i }}-emp" type="checkbox" value="value1">
        <label for="if-{{ $i }}-emp" class="the-checklabel">التقييم من قبل شخص معين</label>
    </div>
    <div class=" will-be-toggled form-group m-form__group">
        <label>اختار الموظف المقييم {{ $i }}</label>
        {!! Form::select('users['.$i.'][rater_id]',$users,null,['class'=>'form-control m-input select2','placeholder'=>' ادخل اسم المقيم'])!!}
    </div>
</div>
<div class="single-magic">
    <div class="checker-wrapper">
        <input class="styled-checkbox checkbox_check" id="if-{{ $i }}-emp2" type="checkbox" value="value1">
        <label for="if-{{ $i }}-emp2" class="the-checklabel">بلاغ انتهاء لشخص معين</label>
    </div>
    <div class=" will-be-toggled form-group m-form__group">
        <label>اختيار الموظف المنهى{{ $i }}</label>
        {!! Form::select('users['.$i.'][finisher_id]',$users,"",['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المنهى '])!!}
    </div>
</div>

</div>

