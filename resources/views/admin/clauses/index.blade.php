@extends('admin.layouts.app')
@section('title') البنود
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['البنود'=>route('admin.clauses.index'),])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">

        <div class="static-tabs">
            <a class="links-tabs-active"  href="{!! route('admin.clauses.index') !!}">كل البنود</a>
            <a   href="{!! route('admin.clauses.create') !!}">اضافة بند  جديد</a>
        </div>
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل البنود
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        @if(auth()->user()->hasPermissionTo('add_clauses'))
                        <a href="{!!route('admin.clauses.create')!!}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه بند</span>
                        </span>
                        </a>
                        @endif
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('admin.clauses._table')
        </div>
    </div>
@endsection

@section('scripts')
@endsection
