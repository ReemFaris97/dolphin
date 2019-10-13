@extends('distributor.layouts.app')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">المندوبين / الرئيسية</h3>
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
                                        عدد المندوبين
                                    </h4><br>
                                    <span class="m-widget24__desc">

												</span>
                                    <span class="m-widget24__stats m--font-brand">
                                                {{$data['distributors_count']}}
												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar"
                                             style="width: {{$data['distributors_count']}}%;"
                                              aria-valuenow=""
                                             aria-valuemin="0" aria-valuemax="100"></div>
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
                                        عدد العملاء
                                    </h4><br>
                                    <span class="m-widget24__desc">

												</span>
                                    <span class="m-widget24__stats m--font-info">
                                            {{$data['clients_count']}}
												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar"
                                             style="width: {{$data['clients_count']}}%;"
                                              aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
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
                            <a href="">

                            <!--begin::New Orders-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        عدد المخازن
                                    </h4><br>
                                    <span class="m-widget24__desc">

												</span>
                                    <span class="m-widget24__stats m--font-danger">
                                        {{$data['stores_count']}}
												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar"
                                             style="width: {{$data['stores_count']}}%;"
                                            aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
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
                            <a href="">
                            <!--begin::New Users-->
                            <div class="m-widget24">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        عدد المنتجات
                                    </h4><br>
                                    <span class="m-widget24__desc">

												</span>
                                    <span class="m-widget24__stats m--font-success">
                                                {{$data['products_count']}}
												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-success" role="progressbar"
                                             style="width: {{$data['products_count']}}%;"
                                              aria-valuenow="50" aria-valuemin="0"
                                             aria-valuemax="100"></div>
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
                                            عدد سيارات المندوبين
                                        </h4><br>
                                        <span class="m-widget24__desc">

												</span>
                                        <span class="m-widget24__stats m--font-brand">
                                                {{$data['cars_count']}}
												</span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar m--bg-brand" role="progressbar"
                                                 style="width: {{$data['cars_count']}}%;"
                                                 aria-valuenow=""
                                                 aria-valuemin="0" aria-valuemax="100"></div>
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








                        {{--                        <div class="col-md-12 col-lg-12 col-xl-12">--}}

{{--                            <!--begin::New Users-->--}}
{{--                            <div class="m-widget24" style="height:180px">--}}
{{--                                <div class="m-widget24__item">--}}
{{--                                    <h4 class="m-widget24__title">--}}
{{--                                        الموظف المثالى لهذا الشهر :--}}

{{--									</h4>--}}
{{--										--}}
{{--                                    <div class="m-widget24__desc">--}}
{{--                                    </div>--}}
{{--                                    <div class="text-center mb-4 ">--}}
{{--                                        <span class="fas fa-star "--}}
{{--                                              @if(optional(idol_user())->rate()>=1)--}}
{{--                                              style="color:orange" @endif ></span>--}}
{{--                                        <span class="fas fa-star"--}}
{{--                                              @if(optional(idol_user())->rate()>=2)style="color:orange" @endif ></span>--}}
{{--                                        <span class="fas fa-star"--}}
{{--                                              @if(optional(idol_user())->rate()>=3)style="color:orange" @endif ></span>--}}
{{--                                        <span class="fas fa-star"--}}
{{--                                              @if(optional(idol_user())->rate()>=4)style="color:orange" @endif></span>   <span class="fas fa-star"--}}
{{--                                              @if(optional(idol_user())->rate()>=5)style="color:orange" @endif></span>--}}
{{--                                    </div>--}}
{{--                                    <span class="m-widget24__stats m--font-success">--}}
{{--										--}}
{{--                                           {!! round(optional(idol_user())->rate() ) !!}--}}
{{--									</span>--}}

{{--                                </div>--}}

{{--                            </div>--}}

{{--                            <!--end::New Users-->--}}
{{--                        </div>--}}


                    </div>
                </div>
            </div>

            <!--end:: Widgets/Stats-->


        </div>
    </div>
@endsection
