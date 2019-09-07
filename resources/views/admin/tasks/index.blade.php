@extends('admin.layouts.app')
@section('title') المهمات
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=[ $page_title=>'#',])
    @includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
{!! $page_title !!}                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    @if(auth()->user()->hasPermissionTo('assign_task'))
                    <a href="{!!route('admin.tasks.create')!!}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه مهمه</span>
                        </span>
                    </a>
                    @endif
                </li>
                <li class="m-portlet__nav-item"></li>

            </ul>
        </div>
    </div>
    <div class="m-portlet__body">

        <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#old_tasks">المهمات المنتهيه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#present_tasks">المهمات الحاليه</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="#future_tasks">المهمات المستقبليه </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="old_tasks" role="tabpanel">
                @include('admin.tasks._table',['tasks'=>$old_tasks])
            </div>
            <div class="tab-pane " id="present_tasks" role="tabpanel">
                @include('admin.tasks._table',['tasks'=>$present_tasks])
            </div>
            <div class="tab-pane " id="future_tasks" role="tabpanel">
                @include('admin.tasks._table',['tasks'=>$future_tasks])

            </div>
        </div>


    </div>
</div>
@endsection

@section('scripts')
@endsection
