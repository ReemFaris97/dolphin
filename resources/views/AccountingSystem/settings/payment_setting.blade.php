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
			<h5 class="panel-title">إعدادات اعاده تعين الدفع </h5>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>

		{{--<ul class="nav nav-tabs">--}}
			{{--<li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> المشتريات</a></li>--}}
			{{--<li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2"> الموردين</a></li>--}}
			{{--<li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> مرتجعات المشتريات</a></li>--}}

		{{--</ul>--}}

		{{--<div class="tab-content">--}}
			{{--<div role="tabpanel" id="menu1" class="tab-pane active ">--}}
		       <div class="panel-body">

                   {!!Form::open( ['route' => 'accounting.settings.store' , 'method' => 'Post','files'=>true]) !!}

                           <div class="form-group col-xs-12 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">
                               <div>
                                   <label> {{$setting->title}}</label>

                                   <div class="form-line new-radio-big-wrapper clearfix  {{$setting->name}}">
                                     @foreach($payments as $payment)
                                           <span class="new-radio-wrap">
											<label>{{$payment->name}}</label>
											{!! Form::radio($setting->name.'[]',$payment->id,false,['class'=>'form-control',getsetting('accounting_payment_id') ==$payment->id ?'checked':''])!!}
										</span>
                                       @endforeach
                                   </div>
                               </div>
                           </div>


				   <div class="clearfix"></div>


                   <div class="text-right ">
                       <button type="submit" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                   </div>
                   {!!Form::close() !!}
	     	</div>

		</div>

		@endsection
		@section('scripts')

		@endsection
