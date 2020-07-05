@extends('AccountingSystem.layouts.master')
@section('title','تعديل  القيد')
@section('parent_title','إداره القيود المحاسيبه')
@section('action', URL::route('accounting.entries.index'))

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
            {!!Form::model($entry, ['route' => ['accounting.entries.update' ,$entry->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.entries.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
