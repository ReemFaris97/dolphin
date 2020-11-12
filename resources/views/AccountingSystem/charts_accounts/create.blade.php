@extends('AccountingSystem.layouts.master')
@section('title','إنشاء حساب   جديد')
@section('parent_title','الدليل المحاسبى')
@section('action', URL::route('accounting.ChartsAccounts.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إنشاء حساب جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.ChartsAccounts.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.charts_accounts.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
