@extends('AccountingSystem.layouts.master')
@section('title','تعديل شريحة الضرائب')
@section('parent_title','إدارة  الضرائب')
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
            {!!Form::model($tax, ['route' => ['accounting.taxs.update' ,$tax->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.taxs.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
