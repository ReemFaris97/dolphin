@extends('AccountingSystem.layouts.master')
@section('title','تعديل  الشركة المصنعة')
@section('parent_title','إدارة  الشركات المصنعة')
@section('action', URL::route('accounting.industrials.index'))

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
            {!!Form::model($industrial, ['route' => ['accounting.industrials.update' ,$industrial->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.industrials.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection