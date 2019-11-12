@extends('admin.layouts.app')
@section('title') مرتجعات الموردين
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['مرتجعات الموردين'=>route('admin.suppliers-discards.index'),])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل المرتجعات
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('admin.suppliers-discards.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه مرتجع جديد</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('admin.discards._table')
        </div>
    </div>
@endsection

@section('scripts')
@endsection
