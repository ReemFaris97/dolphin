@extends('AccountingSystem.layouts.master')

@section('title','إنشاء تصنيف  جديد')
@section('parent_title','إدارة تصنيفات الاقسام')
@section('action', URL::route('accounting.categories.index'))
@section('styles')
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة تصنيف جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.categories.store' ,'class'=>'parsley-validate-form form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.categories.form')
            {!!Form::close() !!}
        </div>
        </div>
 @endsection