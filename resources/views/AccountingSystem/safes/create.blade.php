@extends('AccountingSystem.layouts.master')
@section('title','إنشاء خزينة  جديد')
@section('parent_title','إدارة  خزائن البيع')
@section('action', URL::route('accounting.safes.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة خزينة جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.safes.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.safes.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
