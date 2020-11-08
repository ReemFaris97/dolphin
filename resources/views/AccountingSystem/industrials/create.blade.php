@extends('AccountingSystem.layouts.master')
@section('title','إنشاء شركة مصنعة  جديدة')
@section('parent_title','إدارة  الشركات  المصنعة')
@section('action', URL::route('accounting.industrials.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة الشركة المصنعة جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.industrials.store' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.industrials.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection