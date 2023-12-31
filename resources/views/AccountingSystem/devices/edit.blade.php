@extends('AccountingSystem.layouts.master')
@section('title','تعديل  الجهاز')
@section('parent_title','إدارة  الاجهزه')
@section('action', URL::route('accounting.devices.index'))

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
            {!!Form::model($device, ['route' => ['accounting.devices.update' ,$device->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.devices.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
