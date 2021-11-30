@extends('distributor.layouts.app')

@section('content')
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">المندوبين / الرئيسية</h3>
                @php($today=\Carbon\Carbon::today()->format('d-m-Y'))
                <h4 style="margin-bottom: 45px;">حالة اليوم :{{$today}} </h4>

            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content">
        <!--begin:: Widgets/Stats-->
        <div class="m-portlet  m-portlet--unair">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <a href="#">
                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                         الخطة الاجمالية
                                    </h4><br>
                                    <span class="m-widget24__desc">
                                    </span>
                                    <span class="m-widget24__stats m--font-brand">
                                        {{$data['trips_all_count']}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$data['trips_all_count']}}%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                    </span>
                                    <span class="m-widget24__number">
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <a href="#">
                            <!--begin::New Feedbacks-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        عدد الزيارات
                                    </h4><br>
                                    <span class="m-widget24__desc">
                                    </span>
                                    <span class="m-widget24__stats m--font-info">
                                        {{$data['trips_count']}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar" style="width: {{$data['trips_count']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                    </span>
                                    <span class="m-widget24__number">
                                    </span>
                                </div>
                            </div>
                            <!--end::New Feedbacks-->
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <a href="#">
                            <!--begin::New Orders-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                         اجمالى مرات الرفض
                                    </h4><br>
                                    <span class="m-widget24__desc">
                                    </span>
                                    <span class="m-widget24__stats m--font-danger">
                                        {{$data['trips_refused_count']}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: {{$data['trips_refused_count']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                    </span>
                                    <span class="m-widget24__number">
                                    </span>
                                </div>
                            </div>
                            <!--end::New Orders-->
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <a href="#">
                            <!--begin::New Users-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                  المسارات المسحوبة
                                    </h4><br>
                                    <span class="m-widget24__desc">
                                    </span>
                                    <span class="m-widget24__stats m--font-success">
                                        {{$data['routes_count']}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-success" role="progressbar" style="width: {{$data['routes_count']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                    </span>
                                    <span class="m-widget24__number">
                                    </span>
                                </div>
                            </div>
                            <!--end::New Users-->
                        </a>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <a href="#">
                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                   المسارات المنجزة
                                    </h4><br>
                                    <span class="m-widget24__desc">
                                    </span>
                                    <span class="m-widget24__stats m--font-brand">
                                        {{$data['routes_finished_count']}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$data['routes_finished_count']}}%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                    </span>
                                    <span class="m-widget24__number">
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </a>
                    </div>
{{--                    <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                        <a href="#">--}}
{{--                            <!--begin::Total Profit-->--}}
{{--                            <div class="m-widget24">--}}
{{--                                <div class="m-widget24__item">--}}
{{--                                    <h4 class="m-widget24__title">--}}
{{--                                        المسارات الغير مسلمة--}}
{{--                                    </h4><br>--}}
{{--                                    <span class="m-widget24__desc">--}}
{{--                                    </span>--}}
{{--                                    <span class="m-widget24__stats m--font-brand">--}}
{{--                                        {{$data['routes_not_finished_count']}}--}}
{{--                                    </span>--}}
{{--                                    <div class="m--space-10"></div>--}}
{{--                                    <div class="progress m-progress--sm">--}}
{{--                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$data['routes_not_finished_count']}}%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                    </div>--}}
{{--                                    <span class="m-widget24__change">--}}
{{--                                    </span>--}}
{{--                                    <span class="m-widget24__number">--}}
{{--                                    </span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <!--end::Total Profit-->--}}
{{--                        </a>--}}
{{--                    </div>--}}
                    <div class="col-md-12 col-lg-6 col-xl-3">
                        <a href="#">
                            <!--begin::Total Profit-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        إجمالى المبيعات
                                    </h4><br>
                                    <span class="m-widget24__desc">
                                    </span>
                                    <span class="m-widget24__stats m--font-brand">
                                        {{$data['sales_total']}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{$data['sales_total']}}%;" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="m-widget24__change">
                                    </span>
                                    <span class="m-widget24__number">
                                    </span>
                                </div>
                            </div>
                            <!--end::Total Profit-->
                        </a>
                    </div>

                </div>
            </div>
        </div>
    {{--     <!--end:: Widgets/Stats-->
        <!----------- start chart ----------->
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Area Chart
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="m_morris_2" style="height:500px;"></div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
        <!----------- end chart -----------> --}}
    </div>
</div>
@endsection
@section('chart')
<script src="{!! asset('dashboard/assets/demo/default/base/scripts.bundle.js') !!}"></script>
<script src="{!! asset('dashboard/assets/demo/default/custom/components/charts/morris-charts.js') !!}"></script>
@endsection
