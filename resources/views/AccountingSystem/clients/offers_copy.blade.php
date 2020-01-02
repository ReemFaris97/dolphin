@extends('AccountingSystem.layouts.master')
@section('title','  نسخ عروض  العملاء   ')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.clients.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  نسخ عروض  العملاء</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.clients.copy' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}


            <div class="form-group col-md-6 ">
                <label>اسم العميل الاول  </label>
                {!! Form::select("first_client_id",$clients,null,['class'=>'form-control','placeholder'=>'اسم العميل الاول'])!!}
            </div>
            <div class="form-group col-md-6 ">
                <label>اسم العميل التانى  </label>
                {!! Form::select("second_client_id",$clients,null,['class'=>'form-control','placeholder'=>'  اسم العميل الثانى '])!!}
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