<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>  @yield('title')</title>

    <!-- Global stylesheets -->
@include('AccountingSystem.layouts.styles')
    <!-- /global stylesheets -->

    <!-- Core JS files -->
@include('AccountingSystem.layouts.scripts')
    @include('AccountingSystem.layouts.data-table')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')
    @yield('scripts')
</head>

<body>

<!-- Main navbar -->
@include('AccountingSystem.layouts.nav')
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
        @include('AccountingSystem.layouts.header')
            <!-- /page header -->


            <!-- Content area -->
            <div class="content">

            @yield('content')

                <!-- Footer -->
            @include('AccountingSystem.layouts.footer')
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