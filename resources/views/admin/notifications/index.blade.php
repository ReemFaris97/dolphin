@extends('admin.layouts.app')
@section('title') كل الإشعارات
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=[' كل الإشعارات'=>route('admin.my.notifications'),])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="static-tabs">
            <a class="links-tabs-active" href="{{route('admin.my.notifications')}}">كل الاشعارات</a>
            <a   href="{!! route('admin.admin-notifications.create') !!}">   ارسال اشعار جديد </a>
        </div>
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل الإشعارات
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
{{--                    <li class="m-portlet__nav-item">--}}
{{--                        <a href="{!!route('admin.admin-notifications.create')!!}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">--}}
{{--                        <span>--}}
{{--                            <i class="fas fa-plus"></i>--}}
{{--                            <span>اضافه نوع جديد</span>--}}
{{--                        </span>--}}
{{--                        </a>--}}
{{--                    </li>--}}
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <div class="m-portlet__body">
            @include('admin.notifications._table')
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.notiTable').DataTable( {
                "order": [[ 3, "desc" ]]
            } );
        } );
    </script>
@endsection
