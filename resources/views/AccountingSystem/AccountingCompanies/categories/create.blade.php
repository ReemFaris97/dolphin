@extends('AccountingSystem.AccountingCompanies.layouts.master')

@section('title','إنشاء تصنيف  جديد')
@section('parent_title','إدارة تصنيفات  المنتجات')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة تصنيف جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'company.categories.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.AccountingCompanies.categories.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection