@extends('distributor.layouts.app')
@section('title')
@endsection

@push('header')
<link href="{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}" rel="stylesheet" type="text/css" />
@endpush

{{--@section('breadcrumb') @php($breadcrumbs=['عرض الفاتورة'=>'/distributor',])--}}
{{--@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])--}}
{{--@endsection--}}

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    الفاتورة
                </h3>
            </div>
        </div>
    </div>
    @include('AccountingSystem.sell_points.bill_temp')

</div>
    @push('scripts')
    <script src="{!! asset('dashboard/assets/vendors/base/jquery-2.1.4.min.js') !!}"></script>
        <script>
        $(document).ready(function () {
            $("#print-all").on('click', function () {
                let t = document.getElementById("print_this").innerHTML;
                let style = `<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/vendors/base/bill-print.css') }}" >`;
                let win = window.open('', '');
                win.document.write(`${style}${t}`);
                win.document.close();
                setTimeout(() => {win.print()}, 100);
            });
        })
    </script>
        <script>
        $(document).ready(function () {
            $("#print-11cm").on('click', function () {
                let tt = document.getElementById("print_small").innerHTML;
                let style2 = `<link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/vendors/base/bill-print-11cm.css') }}" >`;
                let win1 = window.open('', '');
                win1.document.write(`${style2}${tt}`);
                win1.document.close();
                setTimeout(() => {win1.print()}, 100);
            });
        })
    </script>
    @endpush

    @endsection
