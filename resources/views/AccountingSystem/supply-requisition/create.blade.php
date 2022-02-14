@extends('AccountingSystem.layouts.master')
@section('title','إنشاء امر توريد  جديد')
@section('parent_title',' إدارة  البنوك')
@section('action', URL::route('accounting.supply-requisitions.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة امر توريد جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div>
                <div class="row">
                    {!!Form::open( ['route' => 'accounting.supply-requisitions.store' ,'class'=>'form phone_validate', 'method' => 'Post']) !!}

                    @include('AccountingSystem.supply-requisition.form')

                    {!!Form::close() !!}
                </div>
            </div>

        </div>


    </div>

@endsection
