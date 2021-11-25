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
			<h5 class="panel-title">إعدادات اعاده تعين حسابات البنوك والصناديق</h5>
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
					   @if($setting->type == 'select')

						   <div class="form-group col-xs-6  {{$setting->name}} ">
							   <label> {{$setting->title}} </label>
							   <div class="form-group col-md-6 pull-left">
								   {!! Form::select($setting->name.'[]',$chart_accounts,$setting->value,['class'=>'form-control select2'])!!}
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


		</div><!-- end col -->
		@endsection
		@section('scripts')
            <script>
                $(document).ready(function (){
                    $('.select2').select2();
                });
            </script>
		@endsection
