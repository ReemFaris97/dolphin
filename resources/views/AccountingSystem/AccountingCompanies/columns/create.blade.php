@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','إنشاء عمود  جديد')
@section('parent_title','إدارة  الاصناف')

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة عمود جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'company.columns.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.AccountingCompanies.columns.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection