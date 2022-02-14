@extends('AccountingSystem.layouts.master')
@section('title','الاشعارات')
@section('parent_title','الاشعارات')
@section('action', URL::route('accounting.suppliers.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">ارسال الاشعارات</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => ['accounting.suppliers.notification',$supplier] ,'class'=>'form phone_validate', 'method' => 'Post']) !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="form-group col-md-6 pull-left">
                <label>العنوان  </label>
                {!! Form::text("title",null,['class'=>'form-control','placeholder'=>'  العنوان  '])!!}
            </div>


            <div class="form-group col-md-6 pull-left">
                <label>النص</label>
                {!! Form::text("body",null,['class'=>'form-control','placeholder'=>'النص '])!!}
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
