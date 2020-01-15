@extends('AccountingSystem.layouts.master')
@section('title','إنشاء شريحه ضرائب  جديد')
@section('parent_title','إدارة  الضرائب')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة  شريحه ضرائب جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.taxs.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.taxs.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
