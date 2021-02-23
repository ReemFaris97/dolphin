@extends('AccountingSystem.layouts.master')
@section('title','اضافة  طلب إجازة جديد')
@section('parent_title','إدارة  الموظفين')
@section('action', URL::route('accounting.fiscalYears.index'))

@section('styles')
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  إضافة  طلب إجازة  </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.holidays-requests.store' ,'class'=>'parsley-validate-form form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.holidays_requests.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
