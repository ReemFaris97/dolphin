@extends('AccountingSystem.layouts.master')
@section('title',)
@section('parent_title','أدارة الموظفين ')
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
            {!!Form::model($document, ['route' => ['accounting.documents.update' ,$type,$document->id] ,'class'=>'parsley-validate-form phone_validate','method' => 'put','files'=>true]) !!}

            @include('AccountingSystem.documents.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
