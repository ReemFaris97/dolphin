@extends('AccountingSystem.AccountingCompanies.layouts.master')
@section('title','إنشاء مخزن  جديد')
@section('parent_title',' إدارة مخازن الشركة')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة مخزن للشركة جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'company.stores.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.AccountingCompanies.stores.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection