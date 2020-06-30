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
			<div role="tabpanel" id="menu1" class="tab-pane active">
		       <div class="panel-body">

                   {!!Form::open( ['route' => 'accounting.settings.store' , 'method' => 'Post','files'=>true]) !!}
                   @foreach($settings as $setting)
                       @if($setting->type=='check')
                           <div class="form-group col-xs-4 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">

                                   <label> {{$setting->title}}</label>

                                   <div class="form-line new-radio-big-wrapper clearfix  {{$setting->name}}">
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
                       @endif

                       @if($setting->type=='radio')
                           <div class="form-group col-xs-4 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">


                                   <label> {{$setting->title}}</label>
                                   @if($setting->name=='coding_status')
                                       <div class="form-line new-radio-big-wrapper clearfix ">
                                           @if($setting->value=='1')
                                               <span class="new-radio-wrap">
											<label>تزايدى</label>
											{!! Form::radio($setting->name.'[]',1,true,['class'=>'form-control'])!!}
								      		</span>
									       <span class="new-radio-wrap">
											<label>تسلسلى</label>
											{!! Form::radio($setting->name.'[]',0,false,['class'=>'form-control'])!!}
										   </span>
                                           @elseif($setting->value=='0')
									    	<span class="new-radio-wrap">
										    <label>تزايدى</label>
											{!! Form::radio($setting->name.'[]',1,false,['class'=>'form-control'])!!}
											  </span>
											  <span class="new-radio-wrap">
											<label>تسلسلى</label>
											{!! Form::radio($setting->name.'[]',0,true,['class'=>'form-control'])!!}
											</span>
										   @endif
                                       </div>



                                   @endif

                           </div>
                       @endif
                   @endforeach
				   <div class="clearfix"></div>
				   @foreach($settings as $setting)
					   @if($setting->type == 'text')
						   <div class="form-group col-xs-4 {{ $errors->has('name') ? ' has-error' : '' }} {{$setting->name}} ">
							   <label> {{$setting->title}} </label>
							   <div class="form-group col-ms-6 pull-left">
								   {!! Form::text($setting->name.'[]',$setting->value,['class'=>'form-control'])!!}
							   </div>
						   </div>
					   @endif
				   @endforeach
				   <div class="clearfix"> </div>

                   <div class="text-right ">
                       <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                   </div>

                   {!!Form::close() !!}
	        	</div>

		</div>
			<div role="tabpanel" id="menu2" class="tab-pane">
				<div class="panel-body">
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
	</div>
		@endsection
		@section('scripts')

		@endsection
