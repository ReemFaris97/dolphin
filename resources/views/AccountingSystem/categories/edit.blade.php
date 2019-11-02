@extends('AccountingSystem.layouts.master')
@section('title','تعديل التصنيف')
@section('parent_title','إدارة تصنيفات الاقسام')
@section('action', URL::route('accounting.categories.index'))
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
            {!!Form::model($category, ['route' => ['accounting.categories.update' ,$category->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.categories.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection