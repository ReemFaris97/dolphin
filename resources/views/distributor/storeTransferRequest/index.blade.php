@extends('distributor.layouts.app')
@section('title') عمليات نقل المخزن بين المندوبين
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['نقل المخزن بين المندوبين'=>route('distributor.transactions.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل عمليات نقل المخزن
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('distributor.storeTransfer.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>إنشاء عملية نقل جديدة</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('distributor.storeTransferRequest._table')
        </div>
    </div>
@endsection

@section('scripts')

@endsection
