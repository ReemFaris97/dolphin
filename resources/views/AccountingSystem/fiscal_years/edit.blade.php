@extends('AccountingSystem.layouts.master')
@section('title','تعديل السنه الماليه'.$year->name)
@section('parent_title','إدارة  السنوات الماليه')
@section('action', URL::route('accounting.taxs.index'))

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
            {!!Form::model($year, ['route' => ['accounting.fiscalYears.update' ,$year->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.fiscal_years.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
