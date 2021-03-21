@extends('distributor.layouts.app')
@section('title')
تقرير سجل التوالف
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
                                تقرير سجل التوالف
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->

                @include('distributor.reports.damages._form')
                <!--begin::Table-->
                @include('distributor.reports.damages._table')

            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
