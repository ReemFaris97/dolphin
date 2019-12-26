@extends('AccountingSystem.layouts.master')
@section('title','تعديل  المورد')
@section('parent_title','إدارة  الموردين')
@section('action', URL::route('accounting.suppliers.index'))

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
            {!!Form::model($supplier, ['route' => ['accounting.suppliers.update' ,$supplier->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.suppliers.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection