@extends('admin.layouts.app')
@section('title') اضافه  إشعارات الاداره
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=[' الإشعارات الاداره'=>route('admin.notifications-category.index'),'اضافه'=>route('admin.admin-notifications.create')])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')


    <div class="m-content">
        <div class="row">

            <div class="col-md-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="static-tabs">
                        <a  href="{{route('admin.my.notifications')}}">كل الاشعارات</a>
                        <a class="links-tabs-active" href="{!! route('admin.admin-notifications.create') !!}">   ارسال اشعار جديد </a>
                    </div>
                    {{-- <div class="m-portlet__head belong-to-aform">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    ارسال اشعار جديد
                                </h3>
                            </div>
                        </div>
                    </div>
 --}}
                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','route'=>'admin.admin-notifications.store','files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right form-relative-white'])!!}
                    @include('admin.admin_notifications._form')

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">ارسال</button>
                        </div>
                    </div>

                {!!Form::close()!!}
                <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
