@extends('AccountingSystem.layouts.master')
@section('title','تعديل  العملة')
@section('parent_title','اعدادات العملات')
@section('action', URL::route('accounting.currencies.index'))

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
            {!!Form::model($currency, ['route' => ['accounting.currencies.update' ,$currency->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.currencies.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
