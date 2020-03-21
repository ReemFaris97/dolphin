@extends('AccountingSystem.layouts.master')
@section('title','اضافة مورد   جديد')
@section('parent_title','إدارة  الموردين')
@section('action', URL::route('accounting.suppliers.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة مورد جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.suppliers.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.suppliers.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
