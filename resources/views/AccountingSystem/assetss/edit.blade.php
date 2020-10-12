@extends('AccountingSystem.layouts.master')
@section('title','تعديل الاصل  '.{{$asset->name}})
@section('parent_title','إدارة الاصول  ')
@section('action', URL::route('accounting.assets.index'))

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">

            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::model($asset, ['route' => ['accounting.assets.update' ,$asset->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.assetss.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
