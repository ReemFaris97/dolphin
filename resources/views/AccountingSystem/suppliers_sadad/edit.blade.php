@extends('AccountingSystem.layouts.master')
@section('title','تعديل  سند')
@section('parent_title','إدارة   سندات  القبض  والصرف')
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
            {!!Form::model($clause, ['route' => ['accounting.suppliers_sadad.update' ,$clause->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.suppliers_sadad.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection