@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','تعديل  المستودع')
@section('parent_title','إدارة  المستودعات')
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
            {!!Form::model($store, ['route' => ['accounting.stores.update' ,$store->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}
            @include('AccountingSystem.stores.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection