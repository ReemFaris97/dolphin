@extends('AccountingSystem.layouts.master')
@section('title','تعديل  البنك')
@section('parent_title','إدارة  البنوك')
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
            {!!Form::model($bank, ['route' => ['accounting.banks.update' ,$bank->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.banks.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
