@extends('AccountingSystem.layouts.master')
@section('title','تعديل الشركة')
@section('parent_title','إدارة الشركات')
@section('action', URL::route('accounting.companies.index'))
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
            {!!Form::model($company, ['route' => ['accounting.companies.update' ,$company->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.companies.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection