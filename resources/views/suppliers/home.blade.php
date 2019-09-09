@extends('suppliers.layouts.app')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">الموردين / الرئيسية</h3>
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
                                        عدد الموردين
                                    </h4><br>
                                    <span class="m-widget24__desc">

												</span>
                                    <span class="m-widget24__stats m--font-brand">

												</span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar"
                                             style="width: 33%;"
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





                    </div>
                </div>
            </div>

            <!--end:: Widgets/Stats-->


        </div>
    </div>
@endsection
