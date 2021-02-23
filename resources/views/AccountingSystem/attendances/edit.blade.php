@extends('AccountingSystem.layouts.master')
@section('title','تعديل    السجل')
@section('parent_title','إدارة  الموظفين ')
@section('action', URL::route('accounting.attendances.index'))

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
            {!!Form::model($attendance, ['route' => ['accounting.attendances.update' ,$attendance->id] ,'class'=>'parsley-validate-form phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.attendances.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
