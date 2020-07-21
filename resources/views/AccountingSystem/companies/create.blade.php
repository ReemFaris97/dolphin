@extends('AccountingSystem.layouts.master')
@section('title','إنشاء منظمه  جديد')
@section('parent_title','إدارة المنظمه')
@section('action', URL::route('accounting.companies.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة منظمه جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.companies.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.companies.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
