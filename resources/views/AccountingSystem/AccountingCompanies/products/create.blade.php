@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','إنشاء منتج  جديد')
@section('parent_title','إدارة  الاصناف')
@section('styles')
    <style>
        .dd{
            width: 130px;
            height: 50px;
            padding: 15px;
            margin: 15px;
            background-color: green;
        }
    </style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة منتج جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'company.products.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.AccountingCompanies.products.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection