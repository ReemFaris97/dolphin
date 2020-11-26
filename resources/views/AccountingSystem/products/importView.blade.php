@extends('AccountingSystem.layouts.master')
@section('title',' رفع منتجات من ملف')
@section('parent_title','إدارة الاصناف')
@section('action', URL::route('accounting.products.index'))
@section('styles')
<style>
	.dd {
		width: 130px;
		height: 50px;
		padding: 15px;
		margin: 15px;
		background-color: green;
	}
</style>
<link href="{{asset('admin/assets/css/custom-tabs.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">  رفع منتجات من ملف</h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	<div class="panel-body">
		{!!Form::open( ['route' => 'accounting.products.import' ,'id'=>'montag-form','class'=>'form novalidate', 'method' => 'Post','files' => true]) !!}
	
	<div class="form-group col-xs-12 pull-left">	
	<input type="file" name="file" class="form-control">
	</div>
	<div class="text-center col-xs-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
		{!!Form::close() !!}
	</div>
</div>
</div>
@endsection
@section('scripts')
@endsection