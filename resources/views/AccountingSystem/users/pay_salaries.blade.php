@extends('AccountingSystem.layouts.master')
@section('title',' دفع اجور الموظفين ')
@section('parent_title',' إدارةالموظفين ')
@section('styles')
@endsection
@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"> دفع الرواتب</h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

	<div class="panel-body">
		{!!Form::open( ['route' => 'accounting.users.pay' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true]) !!}
		<div class="form-group col-md-4 col-xs-12 pull-left">
			<label> دفع رواتب </label>
			{!! Form::select("type",['one_employee'=>'موظف واحد','job_title'=>'مسمى وظيفى كامل','all'=>'كل الموظفين'],Null,['class'=>'form-control','id'=>'type','required'])!!}
		</div>
		<div class="form-group col-md-4 pull-left one_employee">
			<label> اختر اسم الموظف </label>
			{!! Form::select("user_id",$users,null,['class'=>'form-control js-example-basic-single','id'=>'user_id','placeholder'=>' اختر اسم الموظف'])!!}
		</div>
		<div class="form-group col-md-4 pull-left job_title ">
			<label> اختر المسمى الوظيفى </label>
			{!! Form::select("title_id",$titles,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر المسمى الوظيفى ','id'=>'title_id'])!!}
		</div>
		<div class="form-group col-md-4 pull-left ">
			<label> اختر طريقةالدفع</label>
			{!! Form::select("payment_id",$payments,null,['class'=>'form-control js-example-basic-single','id'=>'payment_id','placeholder'=>' اختر طريقةالدفع'])!!}
		</div>
		<div class="salaries"></div>
		<div class="text-center col-md-12">
			<div class="text-right">
				<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
			</div>
		</div>
		{!!Form::close() !!}
	</div>
	<table class="table datatable-button-init-basic">
		<thead>
			<tr>
				<th>#</th>
				<th> اسم الموظف </th>
				<th> المسمى الوظيفى </th>
				<th> الراتب </th>
				<th> المكافأة </th>
				<th> المدفوع </th>
				<th> تاريخ الدفع </th>
			</tr>
		</thead>
		<tbody>
			@foreach($salaries as $row)
			<tr>
				<td>{!!$loop->iteration!!}</td>
				<td>{!! $row->user->name!!}</td>
				<td>{!!optional($row->user->title)->name !!}</td>
				<td>{!! $row->user->salary!!}</td>
				<td>{!! $row->bouns!!}</td>
				<td>{!! $row->total_salary!!}</td>
				<td>{!! $row->created_at!!}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
		//  $('.one_employee').hide();
		$(".job_title").hide();
	});
</script>
<script>
	$('#type').change(function() {
		var type = $('#type').val();
		if (type == 'one_employee') {
			$('.one_employee').show();
			$('.job_title').hide();
		} else if (type == 'job_title') {
			$('.job_title').show();
			$('.one_employee').hide();
		} else if (type == 'all') {
			$('.job_title').show();
			$('.one_employee').hide();
		}
	});
	$("#user_id").on('change', function() {
		var user_id = $('#user_id').val();
		var id = $(this).val();
		$.ajax({
			url: "/accounting/userSalary",
			type: "get",
			data: {
				'user_id': user_id
			}
		}).done(function(data) {
			$('.salaries').html(data.data);
		}).fail(function(error) {
			console.log(error);
		});
	});
	$("#title_id").on('change', function() {
		var title_id = $('#title_id').val();
		var id = $(this).val();
		$.ajax({
			url: "/accounting/titleSalary",
			type: "get",
			data: {
				'title_id': title_id
			}
		}).done(function(data) {
			$('.salaries').html(data.data);
		}).fail(function(error) {
			console.log(error);
		});
	});
</script>
@endsection