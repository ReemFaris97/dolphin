@extends('AccountingSystem.layouts.master')
@section('title','إنشاء عملة  جديد')
@section('parent_title','اعدادات العملة')
@section('action', URL::route('accounting.currencies.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة عملة جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.currencies.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.currencies.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
