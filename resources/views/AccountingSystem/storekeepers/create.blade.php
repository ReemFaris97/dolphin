@extends('AccountingSystem.layouts.master')
@section('title','إنشاء امين مستودع  جديد')
@section('parent_title','إدارة  المستودعات')
@section('action', URL::route('accounting.storeKeepers.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة امين مستودع جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.storeKeepers.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.storekeepers.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection