@extends('AccountingSystem.layouts.master')
@section('title','إنشاء  خط انتاج  جديد')
@section('parent_title','إدارة   خطوط الانتاج')
@section('action', URL::route('accounting.productionLines.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة خط جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.productionLines.store' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.production_lines.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
