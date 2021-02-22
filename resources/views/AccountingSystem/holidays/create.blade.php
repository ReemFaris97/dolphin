@extends('AccountingSystem.layouts.master')
@section('title','اضافة اجازة جديد')
@section('parent_title','إدارة  الموظفين')
@section('action', URL::route('accounting.holidays.index'))

@section('styles')
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  إضافةأجازة جديدة  </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.holidays.store' ,'class'=>'parsley-validate-form form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.holidays.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
