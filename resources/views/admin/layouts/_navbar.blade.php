<!-- BEGIN: Header -->

<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
    <div class="m-container m-container--fluid m-container--full-height">
        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
                <div class="m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-stack__item--middle m-brand__logo">
                        <a href="{!! route('admin.home') !!}" class="m-brand__logo-wrapper">
                            <img alt="" src="{!! asset('dashboard/assets/app/media/img/logos/logo-1.png')!!}"/>
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
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                <!-- BEGIN: Horizontal Menu -->
                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                        id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div id="m_header_menu"
                     class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-dark m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark ">
                    <ul class="m-menu__nav ">
                        {{-- <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i
                                     class="m-menu__link-icon flaticon-add"></i><span class="m-menu__link-text">Actions</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                             <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                 <ul class="m-menu__subnav">
                                     <li class="m-menu__item " aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-file"></i><span class="m-menu__link-text">Create New Post</span></a></li>
                                     <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-diagram"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
                                                             <span class="m-menu__link-text">Generate Reports</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--success">2</span></span> </span></span></a></li>
                                     <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-business"></i><span
                                                 class="m-menu__link-text">Manage Orders</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                         <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Latest Orders</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Pending Orders</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Processed Orders</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Delivery Reports</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Payments</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Customers</span></a></li>
                                             </ul>
                                         </div>
                                     </li>
                                     <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="#" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-chat-1"></i><span class="m-menu__link-text">Customer
                                                         Feedbacks</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                         <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Customer Feedbacks</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Supplier Feedbacks</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Reviewed Feedbacks</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Resolved Feedbacks</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Feedback Reports</span></a></li>
                                             </ul>
                                         </div>
                                     </li>
                                     <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Register Member</span></a></li>
                                 </ul>
                             </div>
                         </li>
                         <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i
                                     class="m-menu__link-icon flaticon-line-graph"></i><span class="m-menu__link-text">Reports</span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                             <div class="m-menu__submenu  m-menu__submenu--fixed m-menu__submenu--left" style="width:1000px">
                                 <div class="m-menu__subnav">
                                     <ul class="m-menu__content">
                                         <li class="m-menu__item">
                                             <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Finance Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                             <ul class="m-menu__inner">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Annual Reports</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-user"></i><span class="m-menu__link-text">HR Reports</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-clipboard"></i><span class="m-menu__link-text">IPO Reports</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Finance Margins</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-text">Revenue Reports</span></a></li>
                                             </ul>
                                         </li>
                                         <li class="m-menu__item">
                                             <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Project Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                             <ul class="m-menu__inner">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Coca Cola
                                                                     CRM</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Delta
                                                                     Airlines Booking Site</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Malibu
                                                                     Accounting</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Vineseed
                                                                     Website Rewamp</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Zircon
                                                                     Mobile App</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--line"><span></span></i><span class="m-menu__link-text">Mercury CMS</span></a></li>
                                             </ul>
                                         </li>
                                         <li class="m-menu__item">
                                             <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">HR Reports</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                             <ul class="m-menu__inner">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Staff
                                                                     Directory</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Client
                                                                     Directory</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Salary
                                                                     Reports</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Staff
                                                                     Payslips</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Corporate
                                                                     Expenses</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Project
                                                                     Expenses</span></a></li>
                                             </ul>
                                         </li>
                                         <li class="m-menu__item">
                                             <h3 class="m-menu__heading m-menu__toggle"><span class="m-menu__link-text">Reporting Apps</span><i class="m-menu__ver-arrow la la-angle-right"></i></h3>
                                             <ul class="m-menu__inner">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Report Adjusments</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Sources & Mediums</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Reporting Settings</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Conversions</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Report Flows</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><span class="m-menu__link-text">Audit & Logs</span></a></li>
                                             </ul>
                                         </li>
                                     </ul>
                                 </div>
                             </div>
                         </li>
                         <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i
                                     class="m-menu__link-icon flaticon-paper-plane"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap"> <span class="m-menu__link-text">Apps</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--brand m-badge--wide">new</span></span>
                                             </span></span><i class="m-menu__hor-arrow la la-angle-down"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                             <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                                 <ul class="m-menu__subnav">
                                     <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-business"></i><span class="m-menu__link-text">eCommerce</span></a></li>
                                     <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="crud/datatable_v1.html" class="m-menu__link m-menu__toggle"><i class="m-menu__link-icon flaticon-computer"></i><span
                                                 class="m-menu__link-text">Audience</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                         <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--right"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-users"></i><span class="m-menu__link-text">Active Users</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-interface-1"></i><span class="m-menu__link-text">User Explorer</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-lifebuoy"></i><span class="m-menu__link-text">Users Flows</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-1"></i><span class="m-menu__link-text">Market Segments</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic"></i><span class="m-menu__link-text">User Reports</span></a></li>
                                             </ul>
                                         </div>
                                     </li>
                                     <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-map"></i><span class="m-menu__link-text">Marketing</span></a></li>
                                     <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-graphic-2"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
                                                             <span class="m-menu__link-text">Campaigns</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--success">3</span></span> </span></span></a></li>
                                     <li class="m-menu__item  m-menu__item--submenu" m-menu-submenu-toggle="hover" m-menu-link-redirect="1" aria-haspopup="true"><a href="javascript:;" class="m-menu__link m-menu__toggle" title="Non functional dummy link"><i class="m-menu__link-icon flaticon-infinity"></i><span
                                                 class="m-menu__link-text">Cloud Manager</span><i class="m-menu__hor-arrow la la-angle-right"></i><i class="m-menu__ver-arrow la la-angle-right"></i></a>
                                         <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left"><span class="m-menu__arrow "></span>
                                             <ul class="m-menu__subnav">
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-add"></i><span class="m-menu__link-title"> <span class="m-menu__link-wrap">
                                                                         <span class="m-menu__link-text">File Upload</span> <span class="m-menu__link-badge"><span class="m-badge m-badge--danger">3</span></span> </span></span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-signs-1"></i><span class="m-menu__link-text">File Attributes</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-folder"></i><span class="m-menu__link-text">Folders</span></a></li>
                                                 <li class="m-menu__item " m-menu-link-redirect="1" aria-haspopup="true"><a href="actions.html" class="m-menu__link "><i class="m-menu__link-icon flaticon-cogwheel-2"></i><span class="m-menu__link-text">System Settings</span></a></li>
                                             </ul>
                                         </div>
                                     </li>
                                 </ul>
                             </div>
                         </li>--}}
                    </ul>
                </div>

                <!-- END: Horizontal Menu -->

                <!-- BEGIN: Topbar -->
                <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                    <div class="m-stack__item m-topbar__nav-wrapper">
                        <ul class="m-topbar__nav m-nav m-nav--inline">
                            {{-- <li class="m-nav__item m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center m-dropdown--mobile-full-width m-dropdown--skin-light	m-list-search m-list-search--skin-light" m-dropdown-toggle="click" id="m_quicksearch"
                                 m-quicksearch-mode="dropdown" m-dropdown-persistent="1">
                                 <a href="#" class="m-nav__link m-dropdown__toggle">
                                     <span class="m-nav__link-icon"><span class="m-nav__link-icon-wrapper"><i class="flaticon-search-1"></i></span></span>
                                 </a>
                                 <div class="m-dropdown__wrapper">
                                     <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>
                                     <div class="m-dropdown__inner ">
                                         <div class="m-dropdown__header">
                                             <form class="m-list-search__form">
                                                 <div class="m-list-search__form-wrapper">
                                                                 <span class="m-list-search__form-input-wrapper">
                                                                     <input id="m_quicksearch_input" autocomplete="off" type="text" name="q" class="m-list-search__form-input" value="" placeholder="بحث ...">
                                                                 </span>
                                                     <span class="m-list-search__form-icon-close" id="m_quicksearch_close">
                                                                     <i class="la la-remove"></i>
                                                                 </span>
                                                 </div>
                                             </form>
                                         </div>
                                         <div class="m-dropdown__body">
                                             <div class="m-dropdown__scrollable m-scrollable" data-scrollable="true" data-height="300" data-mobile-height="200">
                                                 <div class="m-dropdown__content">
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </li>--}}
							
							
							
							<li class="m-nav__item m-topbar__notifications m-dropdown m-dropdown--large m-dropdown--arrow m-dropdown--align-center 	m-dropdown--mobile-full-width"
                                m-dropdown-toggle="click" m-dropdown-persistent="1" onclick="read_notification('{!! route('admin.notification.read') !!}')" style="padding: 22px 10px 15px;color: #384ad7;">
                               <a class="m-menu__link" data-toggle="modal" data-target="#search_modal">
								<span class="m-nav__link-icon">
													<span class="m-nav__link-icon-wrapper"><i
                                                            class="flaticon-search"></i></span>
													<span id="notification_span"
                                                          class="m-nav__link-badge m-badge m-badge--danger  d-none">!</span>
												</span>
							</a>
							</li>
							
							
							
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
                                    <div class="m-dropdown__inner">{{--
                                        <div class="m-dropdown__header m--align-center">
                                            <span class="m-dropdown__header-title">9 New</span>
                                            <span class="m-dropdown__header-subtitle">User Notifications</span>
                                        </div>--}}
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">

                                                <div class="tab-pane active" id="topbar_notifications_notifications"
                                                     role="tabpanel">
                                                    <div class="m-scrollable" data-scrollable="true" data-height="250"
                                                         data-mobile-height="200">
                                                        <div class="m-list-timeline m-list-timeline--skin-light">
                                                            <div class="m-list-timeline__items "
                                                                 id="notification-items">
                                                                @foreach(auth()->user()->notifications->where('read_at',null)->pluck('data') as $notification)


                                                                    <div class="m-list-timeline__item">
                                                                        <span
                                                                            class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>

                                                                        <span


                                                                            class="m-list-timeline__text">
                                                                            <a
                                                                                {{--href="
@if($notification['type']=='charge')
                                                                                {!! route('charges.show',$notification['item_id']) !!}
                                                                            @else

                                                                            {!! route('tasks.show',$notification['item_id']) !!}

                                                                                "@endif--}}>{!! $notification['message']!!} </a></span>

                                                                    </div>

                                                                @endforeach
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
                                                        class="m-card-user__name m--font-weight-500">{!! Auth::user()->name !!}</span>


<span class="fas fa-star " @if(Auth::user()->rate()>=1)style="color:orange" @endif></span>
<span class="fas fa-star" @if(Auth::user()->rate()>=2 )style="color:orange" @endif></span>
<span class="fas fa-star" @if(Auth::user()->rate()>=3 )style="color:orange" @endif></span>
<span class="fas fa-star" @if(Auth::user()->rate()>=4 )style="color:orange" @endif></span>
<span class="fas fa-star" @if(Auth::user()->rate()>=5 )style="color:orange" @endif></span>

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
                                                        <a href="{{route('admin.users.edit.profile')}}"
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
                            {{-- <li id="m_quick_sidebar_toggle" class="m-nav__item">
                                 <a href="#" class="m-nav__link m-dropdown__toggle">
                                     <span class="m-nav__link-icon"><i class="flaticon-grid-menu"></i></span>
                                 </a>
                             </li>--}}
                        </ul>
                    </div>
                </div>

                <!-- END: Topbar -->
            </div>
        </div>
    </div>
</header>

<!-- END: Header -->
