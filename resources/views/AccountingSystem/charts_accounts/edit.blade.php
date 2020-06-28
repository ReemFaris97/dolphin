@extends('AccountingSystem.layouts.master')
@section('title','تعديل  الحساب')
@section('parent_title','  الدليل المحاسبى')
@section('action', URL::route('accounting.ChartsAccounts.index'))

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
            {!!Form::model($account, ['route' => ['accounting.ChartsAccounts.update' ,$account->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.charts_accounts.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
