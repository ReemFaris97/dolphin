@extends('AccountingSystem.layouts.master')
@section('title','تعديل بيان')
@section('parent_title','إدارة  البنود')
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
            {!!Form::model($benod, ['route' => ['accounting.benods.update' ,$benod->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.benods.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection