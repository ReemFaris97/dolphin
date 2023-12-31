@extends('AccountingSystem.layouts.master')
@section('title','إنشاء فرع  جديد')
@section('parent_title','إدارة فروع الشركات')
@section('action', URL::route('accounting.branches.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة فرع جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.branches.store' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.branches.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection