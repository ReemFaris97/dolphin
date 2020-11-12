@extends('AccountingSystem.layouts.master')
@section('title','تعديل  بيانات امين المستودع')
@section('parent_title','إدارة فروع الشركات')
@section('action', URL::route('accounting.storeKeepers.index'))
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
            {!!Form::model($storeKeeper, ['route' => ['accounting.storeKeepers.update' ,$storeKeeper->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}
            @include('AccountingSystem.storekeepers.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection