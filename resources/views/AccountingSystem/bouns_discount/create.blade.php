@extends('AccountingSystem.layouts.master')
@section('title','اضافة  خصم او اضافة جديدة')
@section('parent_title','إدارة الخصومات والاضافات  ')
@section('action', URL::route('accounting.bonus-discount.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  إضافة   خصم او اضافة  </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.bonus-discount.store' ,'class'=>'parsley-validate-form form phone_validate', 'method' => 'Post','files' => true]) !!}

            @include('AccountingSystem.bouns_discount.form')

            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
