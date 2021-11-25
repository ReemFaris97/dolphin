@extends('AccountingSystem.layouts.master')

@section('title','   تسجيل دخول نقطة البيع')
@section('parent_title','إدارة  نقظة البيع')
@section('action', URL::route('accounting.categories.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> تسجيل دخول نقطة البيع</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.sessions.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

            @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> اسم الوردية </label>
    {!! Form::select("shift_id",shifts(),null,['class'=>'form-control js-example-basic-single ','placeholder'=>' اختر اسم الوردية '])!!}
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>  كود الجهاز </label>
    {!! Form::select("device_id",$devices,null,['class'=>'form-control js-example-basic-single ','placeholder'=>'   اختر كود الجهاز  '])!!}
</div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="form-group block-gp">
                    <label> اختر المستودع </label>
                    {!! Form::select('store_id', $stores, null, ['class' => 'selectpicker form-control j category_id', 'id' => 'store_id', 'placeholder' => ' اختر المستودع ', 'data-live-search' => 'true', 'x-model' => 'selected']) !!}
                </div>
            </div>


<div class="form-group col-sm-4 col-xs-12 pull-left">
    <label> إيميل الكاشير </label>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  إيميل الكاشير'])!!}
</div>



<div class="form-group col-sm-4 col-xs-12 pull-left">
    <label>  كلمه المرور </label>
    {!! Form::password('password',['class'=>'form-control  m-input','placeholder'=>' كلمه المرور'])!!}
</div>

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
