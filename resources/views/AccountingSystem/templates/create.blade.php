@extends('AccountingSystem.layouts.master')
@section('title','إنشاء تقرير  جديد')
@section('parent_title','إدارة  التقارير المالية')
@section('action', URL::route('accounting.templates.index'))

@section('styles')
    <style>
.row_account{
display: inline-block;
    }
    </style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة تقرير جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.templates.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

<div class="row_account">
            <div class="form-group col-sm-3 col-xs-3 pull-left ">
                <label>  اختر  البند الاول </label>
                {!! Form::select("account_id",accounts(),null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
            </div>

            <div class="form-group col-sm-1 col-xs-1 pull-left ">
                <label>  اختر العملية</label>
                {!! Form::select("operation",['+'=>'+','-'=>'-','*'=>'*','/'=>'/'],null,['class'=>'form-control'])!!}
            </div>
            <div class="form-group col-sm-3 col-xs-3 pull-left ">
                <label>  اختر  البند الثانى </label>
                {!! Form::select("account_id",accounts(),null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
            </div>

            <div class="form-group col-sm-1 col-xs-1 pull-left ">
                <label> </label>
                <h1>=</h1>

            </div>
            <div class="form-group col-sm-3 col-xs-3 pull-left ">
                <label>   ادخل اسم البند المحصل</label>
                <input type="text" name="" class="form-control">

            </div>
    <div class="form-group col-sm-3 col-xs-3 pull-left ">
        <button type="button" class="btn btn-success" id="add-new">+ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

        <div class="accounts">
        </div>
            <div class="text-center col-md-12">
                <div class="text-right">
                    <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
                </div>
            </div>
            {!!Form::close() !!}
        </div>

    </div>

 @endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script>
        $(document).ready(function(){
$("#add-new").on('click' , function() {
    // alert("edsf");
    $(".accounts").append(`
<div class='row_account'>
         <div class="form-group col-sm-3 col-xs-3 pull-left ">
                         <label>  اختر  البند الاول </label>
           {!! Form::select("account_id",accounts(),null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
    </div>
      <div class="form-group col-sm-1 col-xs-1 pull-left ">
                <label>  اختر العملية</label>
                {!! Form::select("operation",['+'=>'+','-'=>'-','*'=>'*','/'=>'/'],null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-sm-3 col-xs-3 pull-left ">
        <label>  اختر  البند الثانى </label>
{!! Form::select("account_id",accounts(),null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
    </div>

    <div class="form-group col-sm-1 col-xs-1 pull-left ">
        <label> </label>
        <h1>=</h1>

    </div>
    <div class="form-group col-sm-3 col-xs-3 pull-left ">
        <label>   ادخل اسم البند المحصل</label>
        <input type="text" name="" class="form-control"/>

    </div>
</div>
`);
})
        })
    </script>
@endsection
