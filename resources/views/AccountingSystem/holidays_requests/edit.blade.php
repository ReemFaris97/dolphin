@extends('AccountingSystem.layouts.master')
@section('title','تعديل  المسمى وظيفى')
@section('parent_title','إدارةالممسمى الوظيفى ')
@section('action', URL::route('accounting.taxs.index'))

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
            {!!Form::model($title, ['route' => ['accounting.debts.update' ,$title->id] ,'class'=>'parsley-validate-form phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.debts.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
