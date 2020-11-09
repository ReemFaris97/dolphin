@extends('AccountingSystem.layouts.master')
@section('title','تعديل العضو')
@section('parent_title','إدارة اعضاء الادارة')
@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	<div class="panel-body">
		{!!Form::model($user, ['route' => ['accounting.users.update' ,$user->id] ,'class'=>'parsley-validate-form phone_validate','method' => 'PATCH','files'=>true]) !!}
		@include('AccountingSystem.users.form')
		{!!Form::close() !!}
	</div>
</div>
@endsection