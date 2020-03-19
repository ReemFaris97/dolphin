@extends('AccountingSystem.layouts.master')
@section('parent_title','إدارة الاعدادت')
{{-- @section('action', URL::route('accounting.products.index')) --}}
@section('title',$settings_page)
@section('styles')
@endsection
@section('content')
<form action="{{route('accounting.settings.store')}}" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data">
	{{ csrf_field() }}
	<!-- Page-Title -->
	<div class="panel panel-flat">
		<div class="panel-heading">
			<h5 class="panel-title"> اعدادت {{$settings_page}}</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>
		<div class="panel-body">
			{!!Form::open( ['route' => 'accounting.settings.store' , 'method' => 'Post','files'=>true]) !!}
			@foreach($settings as $setting)
			@if($setting->type=='radio')
			<div class="form-group col-xs-4 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">
				<div>
					<label> {{$setting->title}}</label>
				<div class="form-line new-radio-big-wrapper clearfix">
					@if($setting->value=='1')
					<span class="new-radio-wrap">
						<label>نعم</label>
						{!! Form::radio($setting->name.'[]',1,true,['class'=>'form-control'])!!}
					</span>
					<span class="new-radio-wrap">
						<label> لا</label>
						{!! Form::radio($setting->name.'[]',0,false,['class'=>'form-control'])!!}
					</span>
					@elseif($setting->value=='0')
					<span class="new-radio-wrap">
						<label>نعم</label>
						{!! Form::radio($setting->name.'[]',1,false,['class'=>'form-control'])!!}
					</span>
					<span class="new-radio-wrap">
						<label> لا</label>
						{!! Form::radio($setting->name.'[]',0,true,['class'=>'form-control'])!!}
					</span>
					@endif
				</div>
				</div>
			</div>
			@endif
			@endforeach
			<div class="clearfix"></div>


			@foreach($settings as $setting)
				@if($setting->type=='multi_radio')
					<div class="form-group col-xs-6 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">
						<div>
							<label> {{$setting->title}}</label>
							<div class="form-line new-radio-big-wrapper clearfix">
								@if($setting->value=='daily')
									<span class="new-radio-wrap">
						<label>يومى</label>
						{!! Form::radio($setting->name.'[]','daily',true,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>يومى وفرعى</label>
						{!! Form::radio($setting->name.'[]','daily_branch',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>فرعى وجهاز</label>
						{!! Form::radio($setting->name.'[]','branch_device',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>حسب النظام</label>
						{!! Form::radio($setting->name.'[]','random',false,['class'=>'form-control'])!!}
					</span>
								@elseif($setting->value=='daily_branch')
									<span class="new-radio-wrap">
						<label>يومى</label>
						{!! Form::radio($setting->name.'[]','daily',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>يومى وفرعى</label>
						{!! Form::radio($setting->name.'[]','daily_branch',true,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>فرعى وجهاز</label>
						{!! Form::radio($setting->name.'[]','branch_device',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>حسب النظام</label>
						{!! Form::radio($setting->name.'[]','random',false,['class'=>'form-control'])!!}
					</span>
								@elseif($setting->value=='branch_device')
									<span class="new-radio-wrap">
						<label>يومى</label>
						{!! Form::radio($setting->name.'[]','daily',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>يومى وفرعى</label>
						{!! Form::radio($setting->name.'[]','daily_branch',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>فرعى وجهاز</label>
						{!! Form::radio($setting->name.'[]','branch_device',true,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>حسب النظام</label>
						{!! Form::radio($setting->name.'[]','random',false,['class'=>'form-control'])!!}
					</span>

								@elseif($setting->value=='random')
									<span class="new-radio-wrap">
						<label>يومى</label>
						{!! Form::radio($setting->name.'[]','daily',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>يومى وفرعى</label>
						{!! Form::radio($setting->name.'[]','daily_branch',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>فرعى وجهاز</label>
						{!! Form::radio($setting->name.'[]','branch_device',false,['class'=>'form-control'])!!}
					</span>
									<span class="new-radio-wrap">
						<label>حسب النظام</label>
						{!! Form::radio($setting->name.'[]','random',true,['class'=>'form-control'])!!}
					</span>


								@endif
							</div>
						</div>
					</div>
				@endif
			@endforeach
			<div class="clearfix"></div>

		@foreach($settings as $setting)
			@if($setting->type == 'value')

			<div class="form-group col-xs-4 {{ $errors->has('name') ? ' has-error' : '' }}">
				<label> {{$setting->title}}</label>
				<div class="form-group col-md-6 pull-left">
					<label>الطول mm</label>
					{!! Form::text($setting->name.'[]',$setting->height,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> العرض mm</label>
					{!! Form::text($setting->name.'[]',$setting->display,['class'=>'form-control'])!!}
				</div>
			</div>
			@endif
			@endforeach
			<div class="clearfix"></div>
			@foreach($settings as $setting)
			@if($setting->type == 'number')

			<div class="form-group col-xs-4 {{ $errors->has('name') ? ' has-error' : '' }}">
				<label> {{$setting->title}}</label>
				<div class="form-group col-md-6 pull-left">
					<label>اعلى </label>
					{!! Form::text($setting->name.'[]',$setting->up,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> اسفل </label>
					{!! Form::text($setting->name.'[]',$setting->dawn,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>يمين </label>
					{!! Form::text($setting->name.'[]',$setting->right,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> يسار </label>
					{!! Form::text($setting->name.'[]',$setting->left,['class'=>'form-control'])!!}
				</div>
			</div>
			@endif
			@endforeach
			<div class="clearfix"></div>
			@foreach($settings as $setting)
			@if($setting->type == 'text')

			<div class="form-group col-xs-4 {{ $errors->has('name') ? ' has-error' : '' }}">
			<label> {{$setting->title}}</label>
				<div class="form-group col-md-6 pull-left">
					{!! Form::text($setting->name.'[]',$setting->value,['class'=>'form-control'])!!}
				</div>
			</div>
			@endif
			@endforeach
            <div class="clearfix"></div>
            @foreach($settings as $setting)
			@if($setting->type == 'textarea')

			<div class="form-group col-xs-12 {{ $errors->has('name') ? ' has-error' : '' }}">
			<label> {{$setting->title}}</label>
				<div class="form-group col-md-12 pull-left">
                    {!! Form::textarea($setting->name.'[]',$setting->value,['class'=>'form-control editor'])!!}

				</div>
			</div>
			@endif
			@endforeach
			<div class="text-right ">
				<button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
			</div>
			{!!Form::close() !!}
		</div><!-- end col -->
		@endsection
		@section('scripts')
		{!! Html::script('/admin/ckeditor/ckeditor.js') !!}
		<script>
			$(document).ready(function() {
				CKEDITOR.replaceClass = 'editor';
			});
		</script>
		@endsection
