@extends('AccountingSystem.layouts.master')
@section('title','تعديل الفترة الماليه'.{{$period->name}})
@section('parent_title','إدارة  الفترات الماليه')
@section('action', URL::route('accounting.fiscalPeriods.index'))

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
            {!!Form::model($year, ['route' => ['accounting.fiscalPeriods.update' ,$year->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.fiscal_periods.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
