@extends('admin.layouts.app')

@section('content')
    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        {{-- <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">الرئيسية</h3>
                </div>

            </div>
        </div> --}}

        <!-- END: Subheader -->
        <div class="m-content">

            <!--begin:: Widgets/Stats-->
            <div class="m-portlet  m-portlet--unair">
                <div class="m-portlet__body  m-portlet__body--no-padding">
                    <div class="row m-row--no-padding m-row--col-separator-xl">

                        @if(auth()->user()->hasPermissionTo('view_workers'))
                            <div class="col-md-12 col-lg-6 col-xl-3">
                                <a href="{{route('admin.users.index')}}">
                                    <!--begin::Total Profit-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                عدد اعضاء الادارة
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-brand">
													{{$data['admins']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-brand" role="progressbar"
                                                     style="width: {{$data['admins']}}%;" aria-valuenow="{{$data['admins']}}"
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
                        @endif
                        @if(auth()->user()->hasPermissionTo('view_workers'))
                            <div class="col-md-12 col-lg-6 col-xl-3">
                                <a href="{{route('admin.users.index')}}">
                                    <!--begin::New Feedbacks-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                عدد الموظفين (المستخدمين)
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-info">
													{{$data['users']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-info" role="progressbar"
                                                     style="width: {{$data['users']}}%;" aria-valuenow="50" aria-valuemin="0"
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
                        @endif
                        @if(auth()->user()->hasPermissionTo('view_tasks'))
                            <div class="col-md-12 col-lg-6 col-xl-3">
                                <a href="{{route('admin.tasks.index')}}">

                                    <!--begin::New Orders-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                عدد المهام
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-danger">
														{{$data['tasks']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-danger" role="progressbar"
                                                     style="width: {{$data['tasks']}}%;" aria-valuenow="50" aria-valuemin="0"
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
                        @endif

                        @if(auth()->user()->hasPermissionTo('view_charges'))
                            <div class="col-md-12 col-lg-6 col-xl-3">
                                <a href="{{route('admin.charges.index')}}">
                                    <!--begin::New Users-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                عدد العهد
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-success">
													{{$data['charges']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-success" role="progressbar"
                                                     style="width:{{$data['charges']}} %;" aria-valuenow="50" aria-valuemin="0"
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
                        @endif

                        @if(auth()->user()->hasPermissionTo('view_tasks'))
                            <div class="col-md-12 col-lg-6 col-xl-3">
                                <a href="{{route('admin.tasks.index')}}">

                                    <!--begin::New Feedbacks-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                عدد المهام المنجزه
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-info">
													{{$data['finished_tasks']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-info" role="progressbar"
                                                     style="width: {{$data['finished_tasks']}}%;" aria-valuenow="50"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
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
                                <a href="{{route('admin.tasks.index')}}">
                                    <!--begin::New Orders-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                المهام الحاليه
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-danger">
													{{$data['current_tasks']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-danger" role="progressbar"
                                                     style="width: {{$data['current_tasks']}}%;" aria-valuenow="50"
                                                     aria-valuemin="0" aria-valuemax="100"></div>
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
                                <a href="{{route('admin.tasks.index')}}">
                                    <!--begin::Total Profit-->
                                    <div class="m-widget24">
                                        <div class="m-widget24__item">
                                            <h4 class="m-widget24__title">
                                                عدد المهام المستقبلية
                                            </h4><br>
                                            <span class="m-widget24__desc">

												</span>
                                            <span class="m-widget24__stats m--font-brand">
													{{$data['future_tasks']}}
												</span>
                                            <div class="m--space-10"></div>
                                            <div class="progress m-progress--sm">
                                                <div class="progress-bar m--bg-brand" role="progressbar"
                                                     style="width: {{$data['future_tasks']}}%;" aria-valuenow="50"
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
                        @endif

                        <div class="col-md-12 col-lg-6 col-xl-3">
                            <a href="{{route('admin.clauses.index')}}">
                                <!--begin::New Users-->
                                <div class="m-widget24">
                                    <div class="m-widget24__item">
                                        <h4 class="m-widget24__title">
                                            عدد البنود او الارقام
                                        </h4><br>
                                        <span class="m-widget24__desc">

												</span>
                                        <span class="m-widget24__stats m--font-success">
														{{$data['clauses']}}
												</span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar m--bg-success" role="progressbar"
                                                 style="width: {{$data['clauses']}}%;" aria-valuenow="50" aria-valuemin="0"
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





                        <div class="col-md-12 col-lg-12 col-xl-12">

                            <!--begin::New Users-->
                            <div class="m-widget24" style="height:180px">
                                <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                        الموظف المثالى لهذا الشهر : {!! optional(idol_user())->name !!}

                                    </h4>
                                    <div class="m-widget24__desc">
                                    </div>
                                    <div class="text-center mb-4 ">
                                        <span class="fas fa-star "
                                              @if(optional(idol_user())->rate()>=1)
                                              style="color:orange" @endif ></span>
                                        <span class="fas fa-star"
                                              @if(optional(idol_user())->rate()>=2)style="color:orange" @endif ></span>
                                        <span class="fas fa-star"
                                              @if(optional(idol_user())->rate()>=3)style="color:orange" @endif ></span>
                                        <span class="fas fa-star"
                                              @if(optional(idol_user())->rate()>=4)style="color:orange" @endif></span>   <span class="fas fa-star"
                                                                                                                               @if(optional(idol_user())->rate()>=5)style="color:orange" @endif></span>
                                    </div>
                                    <span class="m-widget24__stats m--font-success">

                                           {!! round(optional(idol_user())->rate() ) !!}
									</span>

                                </div>

                            </div>

                            <!--end::New Users-->
                        </div>


                    </div>
                </div>
            </div>

            <!--end:: Widgets/Stats-->


        </div>
    </div>
@endsection
