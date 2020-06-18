@extends('AccountingSystem.layouts.master')
@section('title','إنشاء صلاحية  جديدة')
@section('parent_title','إدارة الصلاحيات')
@section('action', URL::route('accounting.roles.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة صلاحيه جديدة</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

                    <form action="{{route('accounting.roles.store')}}" method="Post" class="form phone_validate" >
                    @csrf

                    @include('AccountingSystem.roles.form')

                    </form>

        </div>

    </div>
    </div>

@endsection