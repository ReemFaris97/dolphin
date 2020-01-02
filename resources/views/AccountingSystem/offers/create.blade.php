@extends('AccountingSystem.layouts.master')
@section('title','إنشاء عرض  سعر  جديد')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.offers.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة  عرض سعر جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.offers.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

            @include('AccountingSystem.offers.form')

            <div class="text-center col-md-12">
                <div class="text-right">
                    <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                </div>
            </div>
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection