@extends('AccountingSystem.layouts.master')
@section('title','تعديل الوجه')
@section('parent_title','إدارة  المنتجات')

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
            {!!Form::model($face, ['route' => ['accounting.faces.update' ,$face->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.faces.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection