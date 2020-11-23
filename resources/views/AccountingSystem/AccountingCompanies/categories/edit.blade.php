@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','تعديل التصنيف')
@section('parent_title','إدارة تصنيفات الاصناف')
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
            {!!Form::model($category, ['route' => ['company.categories.update' ,$category->id] ,'class'=>'parsley-validate-form  phone_validate','method' => 'PATCH','files'=>true]) !!}
            @include('AccountingSystem.AccountingCompanies.categories.form')
            {!!Form::close() !!}
        </div>
    </div>
@endsection