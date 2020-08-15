@extends('AccountingSystem.layouts.master')
@section('title','اضافة  أصل او عهدة  جديد')
@section('parent_title','إدارة  الاصول  والعهده')
@section('action', URL::route('accounting.assets-custodies.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  إضافة   أصل او عهدة  </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.assets-custodies.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}
            @include('AccountingSystem.assets_custodies.form')
            {!!Form::close() !!}
        </div>

        </div>
    </div>

 @endsection
