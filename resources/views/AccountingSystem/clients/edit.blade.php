@extends('AccountingSystem.layouts.master')
@section('title','تعديل العميل')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.clients.index'))

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
            {!!Form::model($client, ['route' => ['accounting.clients.update' ,$client->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.clients.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection