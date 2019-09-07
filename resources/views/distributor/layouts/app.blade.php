<!DOCTYPE html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>  الشركة القابضة للمهام</title>
    <meta name="description" content="Blank inner page examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta name="fcm" content="{!! route('distributor.firebase.store') !!}">--}}

    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!--end::Web font -->

    <!--begin::Global Theme Styles -->
    <link href="{!! asset('dashboard/assets/vendors/base/vendors.bundle.rtl.css') !!}" rel="stylesheet"
          type="text/css"/>

    <link href="{!! asset('dashboard/assets/demo/demo12/base/style.bundle.rtl.css') !!}" rel="stylesheet"
          type="text/css"/>
    <link href="{!! asset('dashboard/assets/jquery.fancybox.min.css') !!}" rel="stylesheet"
          type="text/css"/>
    <!--begin::Page Vendors Styles -->
    <link href="{!! asset('dashboard/assets/vendors/custom/datatables/datatables.bundle.css')!!}" rel="stylesheet"
          type="text/css"/>
	
	<!--begin::The Animate Style -->
    <link href="{!! asset('dashboard/assets/animate.min.css')!!}" rel="stylesheet" type="text/css"/>	
	<!--begin::The MAin Style -->
    <link href="{!! asset('dashboard/assets/main.css')!!}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles -->

    <link rel="manifest" href="{!! asset('dashboard/assets/firebase/manifest.json') !!}">

    <link rel="shortcut icon" href="{!! asset('dashboard/assets/demo/demo12/media/img/logo/favicon.png')!!}"/>
    @stack('header')
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">

{{--
    @dd(auth()->user()->rate())
--}}
@include('distributor.layouts._navbar')
<!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                class="la la-close"></i></button>
    @include('distributor.layouts._sidebar')

    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">
                            @yield('title')
                        </h3>
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="#" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>
                            @yield('breadcrumb')
                        </ul>
                    </div>

                </div>
            </div>

            <!-- END: Subheader -->
            <div class="m-content">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @yield('content')


            </div>
        </div>
    </div>

    <!-- end:: Body -->

    <!-- begin::Footer -->

@include('distributor.layouts._footer')
<!-- end::Footer -->
</div>


<!-- begin::Scroll Top -->
<div id="m_scroll_top" class="m-scroll-top">
    <i class="la la-arrow-up"></i>
</div>

<!-- end::Scroll Top -->


<!--begin::Global Theme Bundle -->
<script src="{!! asset('dashboard/assets/vendors/base/vendors.bundle.js')!!}" type="text/javascript"></script>
<script src="{!! asset('dashboard/assets/demo/demo12/base/scripts.bundle.js')!!}" type="text/javascript"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<!--begin::Page Vendors -->
<script src="{!! asset('dashboard/assets/vendors/custom/datatables/datatables.bundle.js')!!}"
        type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts -->
<script src="{!! asset('dashboard/assets/demo/demo12/custom/crud/datatables/extensions/buttons-normal.js')!!}"
        type="text/javascript"></script>
<script src=" {!! asset('js/app.js') !!}"></script>
<script src="{!! asset('dashboard/assets/jquery.fancybox.min.js') !!}"></script>
<script src="{!! asset('dashboard/assets/bootstrap-datepicker.ar.min.js') !!}"></script>
<script src="{!! asset('dashboard/assets/vendors/custom/countdown/jquery.countdown.min.js') !!}"></script>
<script src="{!! asset('dashboard/assets/scripts.js') !!}"></script>
@include('sweetalert::alert')
<!--end::Page Scripts -->
@stack('scripts')
@yield('owl')
<script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-messaging.js"></script>
<script src="{!! asset('dashboard/assets/firebase/firebase_scripts.js') !!}"></script>
<!--end::Global Theme Bundle -->
</body>

<!-- end::Body -->
</html>
