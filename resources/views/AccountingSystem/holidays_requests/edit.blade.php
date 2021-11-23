@extends('AccountingSystem.layouts.master')
@section('title','تعديل طلب اجازة')
@section('parent_title','  إدارة  الاجازات ')
@section('action', URL::route('accounting.holidays-requests.index'))

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
            {!!Form::model($request, ['route' => ['accounting.holidays-requests.update' ,$request->id] ,'class'=>'parsley-validate-form phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.holidays_requests.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
