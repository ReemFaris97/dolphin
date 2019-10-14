<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  @yield('title')</title>

    <!-- Global stylesheets -->

@include('admin.layouts.styles')


    <!-- /global stylesheets -->

    <!-- Core JS files -->
@include('admin.layouts.scripts')

    <!-- /core JS files -->

    <!-- Theme JS files -->

    <!-- /theme JS files -->

</head>

<body>

<!-- Main navbar -->
@include('admin.layouts.nav')
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
        @include('admin.layouts.header')
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">




            @yield('content')

                <!-- Mega menu component -->

                <!-- /mega menu component -->





                <!-- Footer -->
            @include('admin.layout.footer')
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>