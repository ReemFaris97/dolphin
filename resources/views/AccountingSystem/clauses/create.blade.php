@extends('AccountingSystem.layouts.master')

@section('title','إنشاء سند    جديد')
@section('parent_title','إدارة  سندات  القبض  والصرف')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة سند  جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.clauses.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

            @include('AccountingSystem.clauses.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
