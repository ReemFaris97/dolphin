@extends('admin.layouts.app')
@section('title') {!! $page_title !!}
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
                    {{--       <li class="m-portlet__nav-item">
                               @if(auth()->user()->hasPermissionTo('add_tasks'))
                               <a href="{!!route('admin.tasks.create')!!}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                                   <span>
                                       <i class="fas fa-plus"></i>
                                       <span>اضافه مهمه</span>
                                   </span>
                               </a>
                               @endif
                           </li>
                           <li class="m-portlet__nav-item"></li>
           --}}
                </ul>
            </div>
        </div>
        <div class="m-portlet__body">

            @include('admin.task_users._table')

        </div>
    </div>
@endsection

@section('scripts')
@endsection
