@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>اسم العضو </label>
	{!! Form::text("name",null,['class'=>'form-control','placeholder'=>' اسم العضو','required'])!!}
</div>

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>جوال العضو </label>
	{!! Form::number("phone",null,['class'=>'form-control','placeholder'=>' جوال العضو ','required'])!!}
</div>

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label> البريد الإلكتروني للعضو </label>
	{!! Form::email("email",null,['class'=>'form-control','placeholder'=>' البريد الإلكتروني للعضو','required'])!!}
</div>
<div class="form-group col-sm-4 col-xs-6 pull-left">
    <label> رصيد الاجازات </label>
    {!! Form::text("holiday_balance",null,['class'=>'form-control','placeholder'=>'  رصيد الاجازات','required'])!!}
</div>

@if (!isset($user))
<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label> الصلاحية </label>
	{!! Form::select("role",['is_admin'=>'ادمن','is_saler'=>'كاشير','is_accountant'=>'محاسب'],Null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>اختر الدور/المهام</label>
	<select name="role_id" class="form-control role" id="role_id" required>
		<option selected disabled>اختر الدور/المهام</option>
		@foreach($roles as $role)
		<option value="{{$role->id}}">{{$role->name}}</option>
		@endforeach
	</select>
</div>
@else
<div class="form-group col-sm-4 col-xs-6 pull-left">
	<select class="form-control js-example-basic-single pull-right" name="role">
		<option> اختر الصلاحية</option>
		<option value="is_admin" {{($user->is_admin==1 ? 'selected' : '')}}> ادمن</option>
		<option value="is_saler" {{($user->is_saler==1 ? 'selected' : '')}}>كاشير</option>
		<option value="is_accountant" {{($user->is_accountant==1 ? 'selected' : '')}}>محاسب</option>
	</select>
</div>
<div class="form-group col-sm-4 col-xs-6 pull-left">
	<select name="role_id" class="form-control role" id="role_id" required>
		@foreach($roles as $role)
		<option value="{{$role->id}}" @if($user->role_id==$role->id) selected @endif >{{$role->name}}</option>
		@endforeach
	</select>
</div>
@endif
<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>كلمة المرور</label>
	{!! Form::password('password',['class'=>'form-control m-input','placeholder'=>'ادخل كلمة المرور','required'])!!}
</div>

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>الراتب </label>
	{!! Form::number("salary",null,['class'=>'form-control','placeholder'=>' الراتب ','required'])!!}
</div>

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>تاريخ التعين </label>
	{!! Form::date("hiring_date", null,['class'=>'form-control','required'])!!}
</div>

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label> المسمى الوظيفى </label>
	{!! Form::select("title_id",$titles,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر المسمى الوظيفى ','required'])!!}
</div>


@if( isset($user))

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>صوره العضو الحالية : </label>
	<img src="{{getimg($user->image)}}" style="width:100px; height:100px">
</div>

@endif

<div class="form-group col-sm-4 col-xs-6 pull-left">
	<label>صوره العضو </label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">اختيارى</span>
	{!! Form::file("image",null,['class'=>'form-control'])!!}
</div>
<div class="col-xs-12 permissions"></div>
<div class="text-center col-xs-12">
	<div class="text-right">
		<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
	</div>
</div>
<script>
	$("#role_id").on('change', function() {
		var id = $(this).val();
		$.ajax({
			url: "/accounting/get-permissions/" + id,
			type: "GET",
		}).done(function(data) {
			$('.permissions').html(data.permission);
		}).fail(function(error) {
			console.log(error);
		});

	});
</script>
