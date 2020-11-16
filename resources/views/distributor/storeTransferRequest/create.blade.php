@extends('distributor.layouts.app')
@section('title') اضافه منتج جديد
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['الاصناف'=>route('distributor.storeTransfer.index'),'اضافه'=>route('distributor.storeTransfer.create')])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')


    <div class="m-content">
        <div class="row">
            <div class="col-md-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head belong-to-aform">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    نقل مخزون من مندوب لآخر
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','route'=>'distributor.storeTransfer.store','files'=>'true','class'=>'clearfix m-form m-form--fit m-form--label-align-right'])!!}

                    @include('distributor.storeTransferRequest._form')

                    <div class="m-portlet__foot m-portlet__foot--fit full--width">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">حفظ</button>
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
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endsection
