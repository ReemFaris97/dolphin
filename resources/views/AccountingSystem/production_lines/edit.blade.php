@extends('AccountingSystem.layouts.master')
@section('title','تعديل  الخط')
@section('parent_title','إدارة   خطوط الانتاج')
@section('action', URL::route('accounting.productionLines.index'))
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
            {!!Form::model($line, ['route' => ['accounting.productionLines.update' ,$line->id] ,'class'=>'phone_validate parsley-validate-form','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.production_lines.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
