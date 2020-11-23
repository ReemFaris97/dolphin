@extends('AccountingSystem.layouts.master')
@section('title','تعديل المنتج')
@section('parent_title','إدارة  الاصناف')
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
            {!!Form::model($product, ['route' => ['accounting.products.update' ,$product->id] ,'class'=>'novalidate','novalidate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.products.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection