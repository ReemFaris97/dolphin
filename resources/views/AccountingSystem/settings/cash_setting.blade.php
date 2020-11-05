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
			<h5 class="panel-title">إعدادات اعاده تعين حسابات النقدية</h5>
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
                {{-- @dd($settings) --}}
                   @foreach($settings as $setting)
                       @if($setting->type=='check')
                           <div class="form-group col-xs-4 backed-eee {{ $errors->has('name') ? ' has-error' : '' }}">
                               <div>
                                   <label> {{$setting->title}}</label>
                                        {{-- @dd($setting->title) --}}
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
                           </div>
                       @endif
                   @endforeach


				   @foreach($settings as $setting)
					   @if($setting->type == 'select')
						   <div class="form-group col-xs-6  {{$setting->name}} ">
							   <label> {{$setting->title}} </label>
							   <div class="form-group col-md-6 pull-left">
								   {!! Form::select($setting->name.'[]',$chart_accounts,$setting->value,['class'=>'form-control'])!!}
							   </div>
						   </div>
					   @endif
				   @endforeach
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
