@extends('AccountingSystem.layouts.master')
@section('parent_title','إدارة الاعدادت')
{{-- @section('action', URL::route('accounting.products.index')) --}}
@section('title','إعدادات  الدليل المحاسبى')
@section('styles')
@endsection
@section('content')

	<!-- Page-Title -->
	<div class="panel panel-flat">

		<div class="panel-heading">
			<h5 class="panel-title">إعدادات  الدليل المحاسبى</h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> التكويد الشجرى</a></li>
			<li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">لوحة التحكم</a></li>
		</ul>

		<div class="tab-content">
			<div role="tabpanel" id="menu1" class="tab-pane active ">
		       <div class="panel-body">
			@foreach($accounts as $account)
			{!!Form::open( ['route' => ['accounting.AccountSettings.update',$account->id] , 'method' => 'PATCH','files'=>true,'id'=>$account->id]) !!}

				<h1>{{$account->account->ar_name}}</h1>
				<div class="form-group col-xs-3 pull-left">
					<label> تلقائى</label>
					<input type="radio" name="automatic"  @if($account->automatic=='1') checked @endif class="form-control" value="1">
				</div>
				<div class="form-group col-xs-3  pull-left">
					<label> رقم التكويد الاساسى</label>
				<input type="text" name="main_code" class="form-control" value={{$account->main_code}}  >
				</div>

				<div class="form-group col-xs-3 pull-left">
					<label> الرقم  المتصاعد</label>
					<input type="text" name="increased_number" class="form-control"  value={{$account->increased_number}} >
				</div>

				<div class="form-group col-xs-3 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">
					<label> نوع التكويد</label>
					<div class="form-line new-radio-big-wrapper clearfix">
						<span class="new-radio-wrap">
						<label>متزايد</label>
			     	<input type="radio" name="status" value="increase" class="form-control" @if($account->status=='increase') checked @endif >
					</span>
						<span class="new-radio-wrap">
						<label> متسلسل</label>
			     	<input type="radio" name="status" value="serial" class="form-control" @if($account->status=='serial') checked @endif >
					</span>
					</div>
				</div>

			<div class="text-right col-xs-3 ">
				<button type="submit" class="btn btn-success" onclick="this.form.submit();">حفظ <i class="icon-arrow-left13 position-right"></i></button>
			</div>
			{!!Form::close() !!}
			@endforeach
	     	</div>
			</div>
			<div role="tabpanel" id="menu2" class="tab-pane">

				<table class="table ">
					<thead>
					<tr>

						<th> اسم الحساب </th>
						<th> الكود </th>

						<th>تفعيل</th>
					</tr>
					</thead>
					<tbody>

					@foreach($chart_accounts as $account)
						<tr>

							<td>{!! $account->ar_name!!}</td>
							<td>{!! $account->code!!}</td>
							<td>
								<a href="{{route('accounting.ChartsAccounts.active',['id'=>$account->id])}}" data-toggle="tooltip" data-original-title="تفعيل" class="btn btn-success"> تفعيل </a>
								<a href="{{route('accounting.ChartsAccounts.dis_active',['id'=>$account->id])}}" data-toggle="tooltip" data-original-title="الغاء التفعيل" class="btn btn-danger"> الغاء  </a>

							</td>
						</tr>
					@endforeach
					</tbody>
				</table>

			</div>
		</div>

		</div><!-- end col -->
		@endsection
		@section('scripts')

		@endsection
