@extends('AccountingSystem.layouts.master')
@section('title','إنشاء سند صرف   منتجات')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> سند اخراج منتجات</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.stores.bond_store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <input type="hidden" name="type" value="exchange">

            <div class="form-group col-md-6 pull-left">
                <label> رقم السند</label>
                <input value="<?php echo mt_rand();?>" name="bond_num" class="form-control" placeholder="رقم السند">
            </div>

            <div class="form-group col-md-6 pull-left">
                <label>تاريخ السند  </label>
                {!! Form::date("date",null,['class'=>'form-control'])!!}
            </div>
            <div class="form-group col-md-6 pull-left">
                <label>بيان السند</label>
                {!! Form::text("description",null,['class'=>'form-control','placeholder'=>'بيان السند  '])!!}
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


@endsection