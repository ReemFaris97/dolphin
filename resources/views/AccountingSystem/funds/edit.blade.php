@extends('AccountingSystem.layouts.master')
@section('title',' تعديل الخزينة')
@section('parent_title','إدارة  خزائن البيع')
@section('action', URL::route('accounting.funds.index'))

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
            {!!Form::model($fund, ['route' => ['accounting.funds.update' ,$fund->id] ,'class'=>'phone_validate','method' => 'PATCH']) !!}

            @include('AccountingSystem.funds.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
