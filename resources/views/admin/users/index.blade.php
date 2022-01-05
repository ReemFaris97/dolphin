@extends('admin.layouts.app')
@section('title') الاعضاء
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['الاعضاء'=>route('admin.users.index'),])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="static-tabs">
            <a class="links-tabs-active" href="#">كل الاعضاء</a>
            <a  href="{!!route('admin.users.create')!!}">اضافة عضو جديد</a>
        </div>
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    {{-- <h3 class="m-portlet__head-text">
                        كل الاعضاء
                    </h3> --}}
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('admin.users.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه عضو</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('admin.users._table')
        </div>
    </div>
@endsection

@section('scripts')
@endsection
