



<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>   الشركة القابضة للمندوبين |@yield('title') </title>
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
    <link rel="shortcut icon" href="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}"/>
    <style>
.m-menu__nav{
background-color: #e7eaef !important
}
    </style>

    <link href="{!! asset('dashboard/assets/customize.css')!!}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/modfication-css.css') }}">


    @stack('header')


	<!--Customize Style -->

    @include('sweetalert::alert')




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






<!-- BEGIN: Header -->

<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="#" class="m-brand__logo-wrapper">
                            <img alt="" src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo.png')!!}"/>
                        </a>
                    </div>
                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

                        <!-- BEGIN: Left Aside Minimize Toggle -->
                        <a href="javascript:" id="m_aside_left_minimize_toggle"
                           class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block  ">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                        <a href="javascript:" id="m_aside_left_offcanvas_toggle"
                           class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Responsive Header Menu Toggler -->
                        <a id="m_aside_header_menu_mobile_toggle" href="javascript:"
                           class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                            <span></span>
                        </a>

                        <!-- END -->

                        <!-- BEGIN: Topbar Toggler -->
                        <a id="m_aside_header_topbar_mobile_toggle" href="javascript:"
                           class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                            <i class="flaticon-more"></i>
                        </a>

                        <!-- BEGIN: Topbar Toggler -->
                    </div>
                </div>
            </div>

            <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head flx-content-header" id="m_header_nav">

                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                        id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div id="m_header_menu"
                     class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                    <ul class="m-menu__nav ">

                    </ul>
                </div>

                <!-- END: Horizontal Menu -->
                {{-- <div class="dectionary-h4">
                    <h4>الفهرس</h4>
                </div> --}}
                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">

                            <li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                m-dropdown-toggle="click" m-dropdown-persistent="1" onclick="read_notification('{!! route('admin.notification.read') !!}')">
                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">
												<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper"><i
                                                            class="flaticon-alarm"></i></span>
													<span id="notification_span"
                                                          class="m-nav__link-badge m-badge m-badge--danger  d-none">!</span>
												</span>
                                </a>
                                <div class="m-dropdown__wrapper" style="right: -15em;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">

                                                <div class="tab-pane active" id="topbar_notifications_notifications"
                                                     role="tabpanel">
                                                    <div class="m-scrollable" data-scrollable="true" data-height="250"
                                                         data-mobile-height="200">
                                                        <div class="m-list-timeline m-list-timeline--skin-light">
                                                            <div class="m-list-timeline__items "
                                                                 id="notification-items">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="m-nav__item m-topbar__user-profile  m-dropdown m-dropdown--medium m-dropdown--arrow  m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                m-dropdown-toggle="click">
                                <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="{!! asset(Auth::user()->image )!!}"
                                                         class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                                    <span class="m-nav__link-icon m-topbar__usericon  m--hide">
													<span class="m-nav__link-icon-wrapper"><i
                                                            class="flaticon-user-ok"></i></span>
												</span>

                                    <span class="m-topbar__username m--hide">{!! Auth::user()->name !!}</span>
                                </a>
                                <div class="m-dropdown__wrapper">
                                    <span
                                        class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__header m--align-center">
                                            <div class="m-card-user m-card-user--skin-light">
                                                <div class="m-card-user__pic">

                                                    <img src="{!! asset(Auth::user()->image )!!}"
                                                         class="m--img-rounded m--marginless" alt=""/>
                                                </div>
                                                <div class="m-card-user__details">
                                                    <span

                                                        class="m-card-user__name m--font-weight-500">
                                                            {!! Auth::user()->name !!}
                                                    </span>



                                                    <a href="#"

                                                       class="m-card-user__email m--font-weight-300 m-link">{!! Auth::user()->email !!} </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav m-nav--skin-light">
                                                    <li class="m-nav__section m--hide">
                                                        <span class="m-nav__section-text">الراوبط</span>
                                                    </li>
                                                    <li class="m-nav__item">

                                                        <a href=""
                                                           class="m-nav__link">
                                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                            <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span
                                                                                    class="m-nav__link-text">حسابي</span>

																			</span>
																		</span>
                                                        </a>
                                                    </li>

                                                    <li class="m-nav__separator m-nav__separator--fit">
                                                    </li>
                                                    <li class="m-nav__item">
                                                        <a href="#"
                                                           class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"
                                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">تسجيل الخروج</a>

                                                        <form id="logout-form" action="{{ route('admin.logout') }}"
                                                              method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>

<!-- END: Header -->





<!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                class="la la-close"></i></button>







                <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">

                    <!-- BEGIN: Aside Menu -->
                    <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                         m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">
                        <ul class="m-menu__nav ">
                            {{--************************************************************************--}}

                            <li class="m-menu__item " aria-haspopup="true"><a href="{!! route('distributor.home') !!}"
                                                                              class="m-menu__link "><span
                                        class="m-menu__item-here"></span><i class="m-menu__link-icon flaticon-home-1"></i><span
                                        class="m-menu__link-text">الرئيسية</span></a></li>


                            {{--            ***********************************************************************************************************--}}

                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span
                                        class="m-menu__link-text"> الإعدادات</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text"> أنواع المستودعات</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.store_categories.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">أنواع المستودعات</span></a></li>
                                        <!--*********************************************************************************************-->
                                        {{--                            @endif--}}
                                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.expenditureTypes.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">أنواع الصرف </span></a></li>
                                        <!--*********************************************************************************************-->

                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.expenditureClauses.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">بنود الصرف </span></a></li>
                                        <!--*********************************************************************************************-->

                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.readers.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">اسماء العدادات </span></a></li>
                                        <!--*********************************************************************************************-->

                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.client-classes.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">أنواع شرائح الضرائب  </span></a></li>
                                        <!--*********************************************************************************************-->
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.refuses.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text"> أسباب الرفض </span></a></li>
                                        <!--*********************************************************************************************-->


                                    </ul>
                                </div>
                            </li>

                            {{--************************************************************************--}}  {{--************************************************************************--}}
                            {{--************************************************************************--}}  {{--************************************************************************--}}




                            {{--************************************************************************--}}


                            {{--            ***********************************************************************************************************--}}
                            {{--************************************************************************--}}

                            {{--************************************************************************--}}

                            {{--            ***********************************************************************************************************--}}
                            {{--************************************************************************--}}
                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span
                                        class="m-menu__link-text"> المندوبين</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">المندوبين</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.distributors.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">كل المندوبين</span></a></li>

                                        {{--                            @endif--}}
                                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.cars.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">سيارات المندوبين </span></a></li>
                                        {{--                            @endif--}}
                                    </ul>
                                </div>
                            </li>
                            {{--            ***********************************************************************************************************--}}

                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">المستودعات</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">كل المستودعات</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.stores.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">كل المستودعات</span></a></li>

                                        {{--                            @endif--}}
                                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.stores.create') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">إضافة مستودع جديد </span></a></li>
                                        {{--                            @endif--}}
                                    </ul>
                                </div>
                            </li>


                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">
                                         الاصناف (المنتجات)</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">كل الاصناف</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.products.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">كل الاصناف</span></a></li>

                                        {{--                            @endif--}}
                                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.products.create') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">إضافة صنف جديد </span></a></li>
                                        {{--                            @endif--}}
                                    </ul>
                                </div>
                            </li>
                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">نقل الاصناف بين مندوبين</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">كل عمليات النقل</span></span></li>
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.storeTransfer.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">كل عمليات النقل</span></a></li>

                                        {{--                            @endif--}}
                                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{{route('distributor.stores.moveProduct')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">إنشاء عملية نقل جديدة</span></a></li>

                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{{route('distributor.stores.addProduct')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">انتاج</span></a></li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{{route('distributor.stores.damageProduct')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">اتلاف</span></a></li>

                                    </ul>
                                </div>
                            </li>

                            {{--************************************************************************--}}  {{--************************************************************************--}}
                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text"> المسارات</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">كل المسارات</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.routes.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">كل المسارات</span></a></li>

                                        {{--                            @endif--}}
                                        {{--                            @if(auth()->user()->hasPermissionTo('add_workers'))--}}
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.trips.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">  رحلات المسارات </span></a></li>
                                        {{--                            @endif--}}
                                    </ul>
                                </div>
                            </li>
                            {{--************************************************************************--}}
                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">إدارة العملاء</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">العملاء</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.clients.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">كل العملاء</span></a></li>


                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.clients.activation') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">العملاء  بانتظار التفعيل </span></a></li>
                                    </ul>
                                </div>
                            </li>


                            {{--************************************************************************--}}
                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span
                                        class="m-menu__link-text"> الحسابات والسجلات</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>


                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">

                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">كل المصروفات</span></span></li>

                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.bills.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text"> الفواتير</span></a></li>


                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.expenses.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text"> المصروفات</span></a></li>
                                        <li class="m-menu__item " aria-haspopup="true" m-menu-link-redirect="1"><a
                                                href="{!! route('distributor.bank-deposits.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text"> سجل الايداعات</span></a></li>

                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{!! route('distributor.transactions.index') !!}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text"> سجل نقل الأموال (التحويلات المالية)</span></a></li>

                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.dailyReports.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">سجل الملخصات اليومية</span></a></li>
                                    </ul>
                                </div>
                            </li>


                            {{--************************************************************************--}}


                            {{--            ***********************************************************************************************************--}}
                            <li class="m-menu__item  m-menu__item--submenu {{--m-menu__item--open m-menu__item--expanded--}}"
                                aria-haspopup="true" m-menu-submenu-toggle="hover"><a href="javascript:"
                                                                                      class="m-menu__link m-menu__toggle"><span
                                        class="m-menu__item-here"></span><i
                                        class="m-menu__link-icon flaticon-user"></i><span
                                        class="m-menu__link-text"> التقارير</span><i
                                        class="m-menu__ver-arrow la la-angle-right"></i></a>
                                <div class="m-menu__submenu "><span class="m-menu__arrow"></span>
                                    <ul class="m-menu__subnav">
                                        <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true"><span
                                                class="m-menu__link"><span class="m-menu__item-here"></span><span
                                                    class="m-menu__link-text">تقرير المبيعات</span></span></li>
                                        {{--                            @if(auth()->user()->hasPermissionTo('view_workers'))--}}
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.sales.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير المبيعات</span></a></li>


                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.routes.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير  تسليم المسارات </span></a></li>

                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.expenses.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير المصروفات </span></a></li>

                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.store_movement.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير حركه المخزون</span></a></li>
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.distributor.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير تحركات المندوبين</span></a></li>
                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.distributor_movements.index')}}"
                                                class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير حركات المندوبين</span></a></li>

                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.selling_movement.index')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير حركه البيع </span></a></li>

                                        <li class="m-menu__item  {{--m-menu__item--active--}}" aria-haspopup="true"><a
                                                href="{{route('distributor.reports.billsReport')}}" class="m-menu__link "><i
                                                    class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span
                                                    class="m-menu__link-text">تقرير   كشف حساب عميل </span></a>
                                        </li>


                                    </ul>
                                </div>


                            </li>

                        </ul>
                    </div>

                    <!-- END: Aside Menu -->
                </div>


                <div class="modal fade" id="search_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">ابحث عن مهمه</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="#">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label> ابحث عن مهمه</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="submit" class="btn btn-primary">بحث</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    <!-- END: Left Aside -->
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">
                           الفهرس
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
            <div class="m-content m-content-mt0">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               {{--  @yield('content') --}}
               <div >
                <!-- Accordion -->
                <div class="accordion js-accordion" data-id="accordion1">
                    <!-- Accordion item -->
                    <button type="button" id="accordionOne" class="accordion__button js-accordion__button is-active" aria-expanded="false"  aria-controls="sectionOne" >
                        ادارة عضويات الادارة :
                    </button>
                    <div id="sectionOne" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionOne">
                        <div class="content-dectionary">
                         <div class="smll-content-dectionary">
                            <div class="row">
                                <div class="links-dectionary">
                                    <a href="#">عرض العضويات</a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#">عرض المسميات الوظيفية</a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#">عرض رواتب الموظفين</a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#">اضافة عضو جديد </a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#"> اضافة مسمي وظيفي</a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#"> دفع رواتب الموظفين</a>
                                </div>
                            </div>
                         </div>
                       </div>
                    </div>
                    <!--/ Accordion item -->
                    <!-- Accordion item -->
                    <button type="button" id="accordionTwo" class="accordion__button js-accordion__button" aria-expanded="false" aria-controls="sectionTwo">  ادارة  الموظفين :</button>
                    <div id="sectionTwo" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionTwo">
                        <div class="content-dectionary">
                            <div class="smll-content-dectionary">

                                <div class="row">
                                    <div class="links-dectionary">
                                        <a href="#"> وثائق الموظفين</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">طلبات الاجازات</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">السلف</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">وثائق الفروع </a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#"> الاجازات </a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#"> البدلات</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">الرواتب </a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">خصومات واضافات</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#"> الحضور والانصراف</a>
                                    </div>
                                </div>
                           </div>
                        </div>
                    </div>
                    <!--/ Accordion item -->
                    <!-- Accordion item -->
                    <button type="button" id="accordionThree" class="accordion__button js-accordion__button" aria-expanded="false" aria-controls="sectionThree">ادارة الشركات :</button>
                    <div id="sectionThree" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionThree">
                        <div class="content-dectionary">
                            <div class="smll-content-dectionary smll-content-edit-width">
                                <h4 class="title-dictionary">  ادارة  الشركات :</h4>
                                <div class="row">
                                    <div class="links-dectionary">
                                        <a href="#">عرض الشركات</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">اضافة شركة جديدة</a>
                                    </div>

                                </div>
                           </div>
                        </div>
                    </div>
                    <!--/ Accordion item -->
                    <!-- Accordion item -->
                    <button type="button" id="accordionFour" class="accordion__button js-accordion__button" aria-expanded="false" aria-controls="sectionFour">ادارة فرع الشركة :</button>
                    <div id="sectionFour" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionFour">
                        <div class="content-dectionary">
                            <div class="smll-content-dectionary smll-content-edit-width">
                                <div class="row">
                                    <div class="links-dectionary">
                                        <a href="#">عرض فروع الشركة</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">اضافة  جميع الورديات</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">اضافة فرع جديد </a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">اضافة  وردية جديدة</a>
                                    </div>
                                </div>
                          </div>
                        </div>
                    </div>
                    <!--/ Accordion item -->
                    <!-- Accordion item -->
                    <button type="button" id="accordionFive" class="accordion__button js-accordion__button" aria-expanded="false" aria-controls="sectionFive">  ادارة  الخزائن :</button>
                    <div id="sectionFive" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionFive">
                        <div class="content-dectionary">
                            <div class="smll-content-dectionary smll-content-edit-width">
                                <div class="row">
                                    <div class="links-dectionary">
                                        <a href="#">عرض الخزائن</a>
                                    </div>
                                    <div class="links-dectionary">
                                        <a href="#">اضافة خزينة جديدة</a>
                                    </div>

                                </div>
                         </div>
                    </div>
                </div>
                    <!--/ Accordion item -->


                <!-- Accordion item -->
                <button type="button" id="accordionSex" class="accordion__button js-accordion__button" aria-expanded="false" aria-controls="sectionSex"> ادارة الاجهزة :</button>
                <div id="sectionSex" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionSex">
                    <div  class="content-dectionary">
                        <div class="smll-content-dectionary smll-content-edit-width">
                            <div class="row">
                                <div class="links-dectionary">
                                    <a href="#">عرض الاجهزة</a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#">اضافة جهاز جديد</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Accordion item -->

                <!-- Accordion item -->
                <button type="button" id="accordionSeven" class="accordion__button js-accordion__button" aria-expanded="false" aria-controls="sectionSeven"> ادارة خطوط الانتاج :</button>
                <div id="sectionSeven" class="accordion__body js-accordion__body" role="region" aria-labelledby="accordionSeven">
                    <div  class="content-dectionary">
                        <div class="smll-content-dectionary smll-content-edit-width">
                            <div class="row">
                                <div class="links-dectionary">
                                    <a href="#">عرض خطوط الانتاج</a>
                                </div>
                                <div class="links-dectionary">
                                    <a href="#">اضافة خط  </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!--/ Accordion item -->


                </div>
                <!--/ Accordion -->
            </div>
            </div>

                <div class="content-dectionary">
                   <div class="smll-content-dectionary">
                        <h4 class="title-dictionary">  ادارة عضويات الادارة :</h4>
                        <div class="row">
                            <div class="links-dectionary">
                                <a href="#">عرض العضويات</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">عرض المسميات الوظيفية</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">عرض رواتب الموظفين</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">اضافة عضو جديد </a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#"> اضافة مسمي وظيفي</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#"> دفع رواتب الموظفين</a>
                            </div>
                        </div>
                   </div>

                   <div class="smll-content-dectionary">
                        <h4 class="title-dictionary">  ادارة  الموظفين :</h4>
                        <div class="row">
                            <div class="links-dectionary">
                                <a href="#"> وثائق الموظفين</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">طلبات الاجازات</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">السلف</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">وثائق الفروع </a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#"> الاجازات </a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#"> البدلات</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">الرواتب </a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">خصومات واضافات</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#"> الحضور والانصراف</a>
                            </div>
                        </div>
                   </div>
                   <div class="smll-content-dectionary smll-content-edit-width">
                        <h4 class="title-dictionary">  ادارة  الشركات :</h4>
                        <div class="row">
                            <div class="links-dectionary">
                                <a href="#">عرض الشركات</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">اضافة شركة جديدة</a>
                            </div>

                        </div>
                   </div>
                   <div class="smll-content-dectionary smll-content-edit-width">
                        <h4 class="title-dictionary">  ادارة  فرع الشركة :</h4>
                        <div class="row">
                            <div class="links-dectionary">
                                <a href="#">عرض فروع الشركة</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">اضافة  جميع الورديات</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">اضافة فرع جديد </a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">اضافة  وردية جديدة</a>
                            </div>
                        </div>
                  </div>
                  <div class="smll-content-dectionary smll-content-edit-width">
                        <h4 class="title-dictionary">  ادارة  الخزائن :</h4>
                        <div class="row">
                            <div class="links-dectionary">
                                <a href="#">عرض الخزائن</a>
                            </div>
                            <div class="links-dectionary">
                                <a href="#">اضافة خزينة جديدة</a>
                            </div>

                        </div>
                 </div>
                 <div class="smll-content-dectionary smll-content-edit-width">
                    <h4 class="title-dictionary">  ادارة  الاجهزة :</h4>
                    <div class="row">
                        <div class="links-dectionary">
                            <a href="#">عرض الاجهزة</a>
                        </div>
                        <div class="links-dectionary">
                            <a href="#">اضافة جهاز جديد</a>
                        </div>

                    </div>
                </div>
                <div class="smll-content-dectionary smll-content-edit-width">
                    <h4 class="title-dictionary">  ادارة  خطوط الانتاج :</h4>
                    <div class="row">
                        <div class="links-dectionary">
                            <a href="#">عرض خطوط الانتاج</a>
                        </div>
                        <div class="links-dectionary">
                            <a href="#">اضافة خط  </a>
                        </div>

                    </div>
                </div>

                </div>
               </div>


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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js
"></script>
<!--end::Page Vendors -->
<!--begin::Page Scripts -->
<script src="{!! asset('dashboard/assets/demo/demo12/custom/crud/datatables/extensions/buttons-normal.js')!!}"
        type="text/javascript"></script>
<script src=" {!! asset('js/app.js') !!}"></script>
<script src="{!! asset('dashboard/assets/jquery.fancybox.min.js') !!}"></script>
<script src="{!! asset('dashboard/assets/bootstrap-datepicker.ar.min.js') !!}"></script>
<script src="{!! asset('dashboard/assets/vendors/custom/countdown/jquery.countdown.min.js') !!}"></script>
<script src="{!! asset('dashboard/assets/scripts.js') !!}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!--end::Page Scripts -->
@stack('scripts')
@yield('owl')


<script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-messaging.js"></script>
<script src="{!! asset('dashboard/assets/firebase/firebase_scripts.js') !!}"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        "use strict";

class Accordion {
    constructor(element, options = {}) {
        this.accordion = element;
        this.buttons = null;
        this.bodies = null;
        this.options = {
            activeClassName: "is-active",
            closeOthers: true,
            ...options
        };

        this.handleKeydown = this.handleKeydown.bind(this);
        this.handleClick = this.handleClick.bind(this);
        this.handleTransitionend = this.handleTransitionend.bind(this);

        this.init();
    }

    init() {
        if (this.accordion.classList.contains("is-init-accordion")) {
            throw Error("Accordion is already initialized.");
        }

        this.buttons = [
            ...this.accordion.querySelectorAll(".js-accordion__button")
        ];
        this.bodies = [
            ...this.accordion.querySelectorAll(".js-accordion__body")
        ];

        // Handle active accordion item
        for (const button of this.buttons) {
            if (!button.classList.contains(this.options.activeClassName))
                continue;
            button.setAttribute("aria-expanded", "true");
            const body = button.nextElementSibling;
            body.style.display = "block";
            body.style.maxHeight = "none";
        }

        // Hide all bodies except the active
        for (const body of this.bodies) {
            if (
                body.previousElementSibling.classList.contains(
                    this.options.activeClassName
                )
            )
                continue;
            body.style.display = "none";
            body.style.maxHeight = "0px";
        }

        this.addEvents();

        this.accordion.classList.add("is-init-accordion");
    }

    closeOthers(elException) {
        for (const button of this.buttons) {
            if (button === elException) continue;
            button.classList.remove(this.options.activeClassName);
            button.setAttribute("aria-expanded", "false");
            const body = button.nextElementSibling;
            body.style.maxHeight = `${body.scrollHeight}px`;
            setTimeout(() => void (body.style.maxHeight = "0px"), 0);
        }
    }

    handleKeydown(event) {
        const target = event.target;
        const key = event.which.toString();

        if (
            target.classList.contains("js-accordion__button") &&
            key.match(/35|36|38|40/)
        ) {
            event.preventDefault();
        } else {
            return false;
        }

        switch (key) {
            case "36":
                // "Home" key
                this.buttons[0].focus();
                break;
            case "35":
                // "End" key
                this.buttons[this.buttons.length - 1].focus();
                break;
            case "38":
                // "Up Arrow" key
                const prevIndex = this.buttons.indexOf(target) - 1;
                if (this.buttons[prevIndex]) {
                    this.buttons[prevIndex].focus();
                } else {
                    this.buttons[this.buttons.length - 1].focus();
                }
                break;
            case "40":
                // "Down Arrow" key
                const nextIndex = this.buttons.indexOf(target) + 1;
                if (this.buttons[nextIndex]) {
                    this.buttons[nextIndex].focus();
                } else {
                    this.buttons[0].focus();
                }
                break;
        }
    }

    handleClick(event) {
        const button = event.currentTarget;
        const body = button.nextElementSibling;

        if (this.options.closeOthers) {
            this.closeOthers(button);
        }

        // Set height to the active body
        if (body.style.maxHeight === "none") {
            body.style.maxHeight = `${body.scrollHeight}px`;
        }

        if (button.classList.contains(this.options.activeClassName)) {
            // Close accordion item
            button.classList.remove(this.options.activeClassName);
            button.setAttribute("aria-expanded", "false");
            setTimeout(() => void (body.style.maxHeight = "0px"), 0);
        } else {
            // Open accordion item
            button.classList.add(this.options.activeClassName);
            button.setAttribute("aria-expanded", "true");
            body.style.display = "block";
            body.style.maxHeight = `${body.scrollHeight}px`;
        }
    }

    handleTransitionend(event) {
        const body = event.currentTarget;
        if (body.style.maxHeight !== "0px") {
            // Remove the height from the active body
            body.style.maxHeight = "none";
        } else {
            // Hide the active body
            body.style.display = "none";
        }
    }

    addEvents() {
        this.accordion.addEventListener("keydown", this.handleKeydown);
        for (const button of this.buttons) {
            button.addEventListener("click", this.handleClick);
        }
        for (const body of this.bodies) {
            body.addEventListener("transitionend", this.handleTransitionend);
        }
    }

    destroy() {
        this.accordion.removeEventListener("keydown", this.handleKeydown);
        for (const button of this.buttons) {
            button.removeEventListener("click", this.handleClick);
        }
        for (const body of this.bodies) {
            body.addEventListener("transitionend", this.handleTransitionend);
        }

        this.buttons = null;
        this.bodies = null;

        this.accordion.classList.remove("is-init-accordion");
    }
}

// ---

window.addEventListener("DOMContentLoaded", () => {
    const accordionEls = [...document.querySelectorAll(".js-accordion")];
    for (const accordionEl of accordionEls) {
        new Accordion(accordionEl);
    }
});

    </script>

<!--end::Global Theme Bundle -->
</body>
<!-- end::Body -->
</html>






