<div class="page-header page-header-default">
<!--
    <div class="page-header-content">
        <div class="page-title">
            <h4>   <a href="{{Session::get('_previous')['url']}}" ><i class="icon-arrow-right6 position-left"></i></a> <span class="text-semibold"> </span> </h4>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
        </div>
    </div>
-->

    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{route("accounting.home")}}"><i class="icon-home2 position-left"></i> الرئيسية</a></li>
            <li><a href="@yield('action')"> @yield('parent_title')</a></li>
            <li class="active">@yield('title') </li>
        </ul>

<!--
        <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear position-left"></i>
                    Settings
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
            </li>
        </ul>
-->
    </div>
</div>
