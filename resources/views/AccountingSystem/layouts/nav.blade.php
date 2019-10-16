<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="index.html"><img src="assets/images/logo_light.png" alt=""></a>

        <ul class="nav navbar-nav pull-right visible-xs-block">
            <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <ul class="nav navbar-nav">
            <li class="dropdown mega-menu mega-menu-wide active">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-menu7 position-left"></i> Menu <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-content">
                    <div class="dropdown-content-body">
                        <div class="row">
                            <div class="col-md-2">
                                <span class="menu-heading underlined">Form components</span>
                                <ul class="menu-list">
                                    <li><a href="form_inputs_basic.html">Basic inputs</a></li>
                                    <li><a href="form_checkboxes_radios.html">Checkboxes &amp; radios</a></li>
                                    <li><a href="form_input_groups.html">Input groups</a></li>
                                    <li><a href="form_controls_extended.html">Extended controls</a></li>
                                    <li><a href="form_floating_labels.html">Floating labels</a></li>
                                    <li><a href="form_select2.html">Selects</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <span class="menu-heading underlined">UI components</span>
                                <ul class="menu-list">
                                    <li><a href="components_modals.html">Modals</a></li>
                                    <li><a href="components_dropdowns.html">Dropdown menus <span class="badge badge-default">30+</span></a></li>
                                    <li><a href="components_popups.html">Tooltips and popovers</a></li>
                                    <li><a href="components_tabs.html">Tabs component</a></li>
                                    <li><a href="components_navs.html">Accordion and navs</a></li>
                                    <li><a href="components_notifications_pnotify.html">Notifications <span class="badge badge-danger">3</span></a></li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <span class="menu-heading underlined">Sidebars</span>
                                <ul class="menu-list">
                                    <li><a href="sidebar_default_collapse.html">Default sidebar</a></li>
                                    <li><a href="sidebar_mini_collapse.html">Mini sidebar</a></li>
                                    <li><a href="sidebar_dual.html">Dual sidebar</a></li>
                                    <li><a href="sidebar_double_collapse.html">Double sidebar</a></li>
                                    <li><a href="sidebar_detached_left.html">Detached sidebar</a></li>
                                    <li><a href="sidebar_components.html">Sidebar components</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <span class="menu-heading underlined">Navigation</span>
                                <ul class="menu-list">
                                    <li><a href="navigation_horizontal_click.html">Submenu on click</a></li>
                                    <li><a href="navigation_horizontal_hover.html">Submenu on hover</a></li>
                                    <li><a href="navigation_horizontal_elements.html">With custom elements</a></li>
                                    <li><a href="navigation_horizontal_tabs.html">Tabbed navigation</a></li>
                                    <li><a href="navigation_horizontal_disabled.html">Disabled navigation links</a></li>
                                    <li class="active"><a href="navigation_horizontal_mega.html">Horizontal mega menu</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <span class="menu-heading underlined">Navbars</span>
                                <ul class="menu-list">
                                    <li><a href="navbar_single.html">Single navbar</a></li>
                                    <li><a href="navbar_multiple_navbar_navbar.html">Multiple navbars</a></li>
                                    <li><a href="navbar_colors.html">Color options</a></li>
                                    <li><a href="navbar_sizes.html">Sizing options <span class="badge badge-info">14</span></a></li>
                                    <li><a href="navbar_hideable.html">Hide on scroll</a></li>
                                    <li><a href="navbar_components.html">Navbar components</a></li>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <span class="menu-heading underlined">Extensions</span>
                                <ul class="menu-list">
                                    <li><a href="extension_dnd.html">Drag &amp; drop <span class="label label-primary">HOT</span></a></li>
                                    <li><a href="extension_blockui.html">Block UI</a></li>
                                    <li><a href="uploader_plupload.html">File uploaders</a></li>
                                    <li><a href="extension_image_cropper.html">Image cropper</a></li>
                                    <li><a href="internationalization_switch_direct.html">Translation <span class="label label-success">New</span></a></li>
                                    <li><a href="extension_fullcalendar_views.html">Calendars</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة  عضويات الادارة
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.users.index')}}"><i class="icon-IE"></i> عرض العضويات</a></li>
                    <li><a href="{{route('accounting.users.create')}}"><i class="icon-chrome"></i> اضافة عضو جديد</a></li>

                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة الشركات
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.companies.index')}}"><i class="icon-IE"></i> عرض الشركات</a></li>
                    <li><a href="{{route('accounting.companies.create')}}"><i class="icon-chrome"></i> اضافة شركة جديدة</a></li>

                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة فروع الشركات
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.branches.index')}}"><i class="icon-IE"></i> عرض فروع الشركات</a></li>
                    <li><a href="{{route('accounting.branches.create')}}"><i class="icon-chrome"></i> اضافة فرع جديدة</a></li>
                    <li class="dropdown-submenu dropdown-submenu-left">
                    <a href="#"><i class="icon-firefox"></i> الورديات </a>
                    <ul class="dropdown-menu">
                    <li><a href="{{route('accounting.shifts.index')}}"><i class="icon-android"></i> عرض الوديات بجميع  الفروع</a></li>
                    <li class="dropdown-submenu dropdown-submenu-left">
                    <a href="{{route('accounting.shifts.create')}}"><i class="icon-apple2"></i> اضافة وردية جديده</a>
                    </li>
                    </ul>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة  المخازن
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.stores.index')}}"><i class="icon-IE"></i> عرض المخازن</a></li>
                    <li><a href="{{route('accounting.stores.create')}}"><i class="icon-chrome"></i> اضافة مخزن جديدة</a></li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة  تصنيفات  الاقسام
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{route('accounting.categories.index')}}"><i class="icon-IE"></i> عرض تصنيفات الاقسام</a></li>
                    <li><a href="{{route('accounting.categories.create')}}"><i class="icon-chrome"></i> اضافة تصنيف جديد</a></li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة البنود
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">

                    <li><a href="{{route('accounting.clauses.index')}}"><i class="icon-IE"></i> عرض البنود</a></li>
                    <li><a href="{{route('accounting.clauses.create')}}"><i class="icon-chrome"></i> اضافة بند جديد</a></li>


                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-tree5 position-left"></i>
                    إدارة المنتجات
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">

                    <li class="dropdown-submenu dropdown-submenu-left">
                        <a href="#"><i class="icon-firefox"></i> الاوجه </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('accounting.faces.index')}}"><i class="icon-android"></i> عرض  الاوجة</a></li>
                            <li class="dropdown-submenu dropdown-submenu-left">
                                <a href="{{route('accounting.faces.create')}}"><i class="icon-apple2"></i> اضافة وجة جديد</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu dropdown-submenu-left">
                        <a href="#"><i class="icon-firefox"></i> الاعمده </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('accounting.columns.index')}}"><i class="icon-android"></i> عرض الاعمده </a></li>
                            <li class="dropdown-submenu dropdown-submenu-left">
                                <a href="{{route('accounting.columns.create')}}"><i class="icon-apple2"></i> اضافة عمود جديده</a>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown-submenu dropdown-submenu-left">
                        <a href="#"><i class="icon-firefox"></i> الخلايا </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('accounting.cells.index')}}"><i class="icon-android"></i> عرض الخلايا   </a></li>
                            <li class="dropdown-submenu dropdown-submenu-left">
                                <a href="{{route('accounting.cells.create')}}"><i class="icon-apple2"></i> اضافة خلية جديد</a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{!! asset(Auth::user()->image )!!}" alt="">
                    <span>{!! Auth::user()->name !!}</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    {{--<li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>--}}
                    {{--<li><a href="#"><i class="icon-coins"></i> My balance</a></li>--}}
                    {{--<li><a href="#"><span class="badge badge-warning pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>--}}
                    <li><a href="#" onclick="event.preventDefault();

                                                     document.getElementById('logout-form').submit();"><i class="icon-switch2"></i> تسجيل خروج</a>
                        <form id="logout-form" action="{{ route('admin.logout') }}"
                              method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>