@extends('AccountingSystem.layouts.master')
@section('title','إنشاء منتج  جديد')
@section('parent_title','إدارة  المنتجات')

@section('action', URL::route('accounting.products.index'))
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
            {!!Form::open( ['route' => 'accounting.products.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.products.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection