@extends('AccountingSystem.layouts.master')
@section('parent_title','إدارة الاعدادت')
{{-- @section('action', URL::route('accounting.products.index')) --}}
@section('title','إعدادات القيود')
@section('styles')
@endsection
@section('content')

	<!-- Page-Title -->
	<div class="panel panel-flat">

		<div class="panel-heading">
			<h5 class="panel-title">إعدادات  القيود  </h5>
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


				   @foreach($settings as $setting)
					   @if($setting->type == 'text')

						   <div class="form-group col-xs-4 {{ $errors->has('name') ? ' has-error' : '' }} {{$setting->name}} ">
							   <label> {{$setting->title}} </label>
							   <div class="form-group col-ms-6 pull-left">
								   {!! Form::text($setting->name,$setting->value,['class'=>'form-control'])!!}
							   </div>
						   </div>


                           @elseif(
                           $setting->type == 'select'
                           )
                               <div class="form-group col-xs-4
                                {{ $errors->has($setting->name) ? ' has-error' : '' }}">
                                   <label> {{$setting->page}} </label>
                                   <div class="form-group col-ms-6 pull-left">
                                       {!! Form::select("$setting->name",              \App\Models\AccountingSystem\AccountingAccount::where('kind','!=','main')->pluck('ar_name','id')
                                       ,$setting->value,['class'=>'form-control','style'=>'100%!important'])!!}
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
<script>

    $("select").select2({
        dir: "rtl",
        width: 'resolve' // need to override the changed default

    });
</script>
		@endsection
