@extends('AccountingSystem.layouts.master')
@section('title','تعديل  المركز'.{{$center->name}})
@section('parent_title','إدارة   مراكز التكلفة')
@section('action', URL::route('accounting.taxs.index'))

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
            {!!Form::model($center, ['route' => ['accounting.costCenters.update' ,$center->id] ,'class'=>'phone_validate','method' => 'PATCH','files'=>true]) !!}

            @include('AccountingSystem.cost_centers.form')

            {!!Form::close() !!}
        </div>


    </div>
@endsection
