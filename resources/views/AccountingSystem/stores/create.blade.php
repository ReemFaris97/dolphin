@extends('AccountingSystem.layouts.master')
@section('title','إنشاء مخزن  جديد')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')
<style>
    .map-inputs .form-control{
       max-width: 250px;
        margin: 0 0 10px 0;
    }
    .right30 input[type="radio"]{
        right: 25px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة مخزن جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.stores.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.stores.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection