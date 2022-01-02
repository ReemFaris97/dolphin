@extends('AccountingSystem.layouts.master')
@section('title','     ')
@section('parent_title','       ')
{{--@section('action', URL::route('accounting.productionLines.index'))--}}
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض
                <div class="btn-group beside-btn-title">    </div>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            {{-- content--}}
        </div>

    </div>


@endsection
