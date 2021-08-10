@extends('distributor.layouts.app')
@section('title')
الفواتير
@endsection
@section('header')
@endsection
@section('breadcrumb') @php($breadcrumbs=['الفواتير'=>route('distributor.bills.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل الفواتير
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">

            </div>
        </div>
        <div class="m-portlet__body">
            @include('distributor.bills._table')
        </div>
    </div>
@endsection

