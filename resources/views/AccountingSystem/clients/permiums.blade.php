@extends('AccountingSystem.layouts.master')
@section('title','تقسيط مديونيه العملاء   ')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.clients.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقسيط مديونيه العملاء</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.clients.permiums_store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}



            <div class="form-group col-md-6 ">
                <label>اسم العميل   </label>
                {!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>'اسم العميل '])!!}
            </div>



            <div class="form-group col-md-6 pull-left">
                <label>قيمه المديونية:  </label>
              {{--ajexs--}}{{--ajexs--}}{{--ajexs--}}{{--ajexs--}}{{--ajexs--}}{{--ajexs--}}
            </div>


            <div class="form-group col-md-6 pull-left">
                <label> قيمه  الفائده:  </label>
                {!! Form::text("code",null,['class'=>'form-control','placeholder'=>' قيمة الفائده'])!!}
            </div>

            <div class="form-group col-md-6 pull-left">
                <label>الاجمالى  بعد الفائده:  </label>
                {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'الاجمالى بعد الفائده '])!!}
            </div>

            <div class="form-group col-md-6 pull-left">
                <label>  قيمة القسط:  </label>
                {!! Form::text("premium_value",null,['class'=>'form-control','placeholder'=>'قيمه القسط'])!!}
            </div>

            <div class="form-group col-md-6 pull-left">
                <label> فتره القسط:  </label>
                {!! Form::select("premium_period",['daily'=>'يوميا','weekly'=>'اسبوعيا','monthly'=>'شهريا',],null,['class'=>'form-control','placeholder'=>' فتره القسط'])!!}
            </div>

            <div class="form-group col-md-6 pull-left">
                <label>  عدد الاقساط:  </label>
                {!! Form::text("premium_number",null,['class'=>'form-control','placeholder'=>'  عدد الاقساط'])!!}
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