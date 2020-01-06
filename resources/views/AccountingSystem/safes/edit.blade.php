@extends('AccountingSystem.layouts.master')
@section('title',' تعديل الخزينة')
@section('parent_title','إدارة  خزائن البيع')
@section('action', URL::route('accounting.products.index'))

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
            {!!Form::model($safe, ['route' => ['accounting.safes.update' ,$safe->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.safes.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection