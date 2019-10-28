@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','تعديل التحويل')
@section('parent_title','إدارة   الايرادات والمصروفات')
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
            {!!Form::model($clause, ['route' => ['company.transactions.update' ,$clause->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.AccountingCompanies.transactions.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection