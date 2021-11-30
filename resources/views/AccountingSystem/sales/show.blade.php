@extends('AccountingSystem.layouts.master')
@section('title', 'عرض الفاتوره' . ' ' . $sale->id)
@section('parent_title', 'إدارة المبيعات')

@section('action', URL::route('accounting.stores.index'))

@section('styles')
    <!-- <link href="{{ asset('_admin/dist/css/pages/print.css') }}" rel="stylesheet">-->


    <style>
        .login-page .card {
            width: 450px;
            margin: auto;
            min-height: 350px;
            border-radius: 5px;
            box-shadow: 0 15px 20px 10px rgba(3, 169, 243, .1)
        }

        .login-page .page-wrapper {
            padding-top: 50px
        }

        .em-link-wrap>a.waves-dark {
            width: 100px;
            background: #edf1f5;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100px;
            text-align: center;
            border: 2px solid transparent;
            border-radius: 10px;
            color: #333;
            transition: .4s all ease-in-out;
            font-size: 14px;
            word-break: break-word
        }

        .em-link-wrap>a.waves-dark:hover {
            background-color: #2ECC71;
            color: #fff
        }

        .em-link-wrap>a.waves-dark i {
            font-size: 20px;
            display: block;
            margin-bottom: 5px;
            color: #2ECC71;
            transition: .4s all ease-in-out
        }

        .em-link-wrap>a.waves-dark:hover i {
            color: #fff
        }

        #main-wrapper br {
            display: none
        }

        .all-em-links-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap
        }

        .em-link-wrap {
            margin-bottom: 15px
        }

        ul.dropdown-menu.custom-style-sub-menu {
            border-radius: 10px;
            text-align: right;
            padding: 10px 0;
            transition: .4s all ease-in-out;
            right: 0
        }

        ul.dropdown-menu.custom-style-sub-menu:hover {
            border-color: #2ECC71
        }

        ul.dropdown-menu.custom-style-sub-menu li a {
            color: #333;
            display: inline-block;
            padding: 5px 10px;
            transition: .4s all ease-in-out;
            width: 100%
        }

        ul.dropdown-menu.custom-style-sub-menu li a:hover {
            background: #2ECC71;
            color: #fff
        }

        .em-link-wrap {
            margin-top: 20px;
            width: 130px;
            text-align: center
        }

        #div-to-print {
            margin-top: 15px
        }

        .modal-dialog.animated.flipInY .modal-content {
            padding: 10px;
            border: 5px solid #2ECC71
        }

        .modal h3 {
            margin: 0
        }

        ul.new-modal-style-sub-menu {
            list-style-type: none
        }

        ul.new-modal-style-sub-menu li {
            text-align: right;
            margin-top: 15px;
            position: relative
        }

        ul.new-modal-style-sub-menu li:before {
            content: "";
            position: absolute;
            width: 15px;
            height: 15px;
            right: -25px;
            top: 12px;
            background: #2ECC71;
            border-radius: 50%;
            transition: .4s all ease-in-out
        }

        ul.new-modal-style-sub-menu li:hover:before {
            right: -15px
        }

        ul.new-modal-style-sub-menu li a {
            font-size: 20px;
            text-align: right;
            width: 100%;
            margin-bottom: 2px;
            background: #2ECC71;
            padding: 4px 15px;
            border-radius: 5px;
            color: #fff;
            transition: .4s all ease-in-out;
            text-align: center
        }

        ul.new-modal-style-sub-menu li a:hover {
            box-shadow: 0 0 15px rgba(40, 40, 40, .4)
        }

        .preloader {
            z-index: 99999999999999999999
        }

        .employee-style.footer,
        .employee-style.page-wrapper {
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-top: 0;
            margin-top: -10px;
            padding-bottom: 40px !important
        }

        .employee-style.page-wrapper .page-titles {
            margin: 0 -25px 5px -25px
        }

        .employee-style.page-wrapper .card-group {
            margin-bottom: 0
        }

        .adding-new-ser-btn {
            width: 100px;
            background: #2ECC71 !important;
            color: #fff;
            border-radius: 4px;
            float: left
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 0 !important;
            border-bottom: 1px solid #e9ecef !important;
            border-radius: 0 !important
        }

        input.form-control.form-control-line {
            text-align: right
        }

        button.form-control.form-control-line.sub.btn.btn-info.adding-new-ser-btn {
            border-radius: 4px !important;
            float: left
        }

        .adding-new-ser-btn-wrapper {
            width: 120px;
            float: left;
            margin-top: -65px
        }

        .row.r {
            position: relative;
            background: #eee;
            margin-bottom: 25px;
            padding: 10px 15px 0;
            border-radius: 10px
        }

        button.form-control.form-control-line.sub.btn.btn-info.adding-new-ser-btn:focus {
            color: #fff
        }

        span.pp,
        span.qq,
        span.ss {
            background: #2ECC71;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            text-align: center;
            margin-bottom: 10px
        }

        span.close.delete-this-row {
            position: absolute;
            left: 0;
            width: 40px;
            height: 40px;
            color: #fff;
            opacity: 1;
            background: red;
            border-radius: 50%;
            font-size: 18px;
            text-align: center;
            line-height: 40px;
            margin-left: 5px;
            transition: .4s all ease-in-out;
            bottom: 10px
        }

        span.close.delete-this-row:hover {
            background: #fff;
            color: red;
            box-shadow: 0 0 20px rgba(40, 40, 40, .4)
        }

        .row.r {
            position: relative
        }

        form label {
            font-weight: 700;
            color: #2ECC71
        }

        .one-bill-inpt {
            margin-bottom: 15px
        }

        .the-bill-logo img {
            width: 195px;
            height: 70px;
            object-fit: contain;
            padding-top: 5px
        }

        .the-bill-design .one-bill-inpt .bill-lbl {
            font-weight: 700;
            font-size: 13px
        }

        .the-bill-date,
        .the-bill-number {
            border-bottom: 1px solid;
            padding-bottom: 7px
        }

        .container-fluid.the-bill-design {
            padding: 10px 10px 45px 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding-bottom: 5px;
            margin: 0 auto;
            display: table;
            width: 8cm
        }



        .newest-chechk input[type=checkbox]:checked+label:after {
            content: '';
            position: absolute;
            right: 23px;
            top: 10px;
            background: #2ECC71;
            width: 2px;
            height: 2px;
            box-shadow: 2px 0 0 #2ECC71, 4px 0 0 #2ECC71, 4px -2px 0 #2ECC71, 4px -4px 0 #2ECC71, 4px -6px 0 #2ECC71, 4px -8px 0 #2ECC71;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
            transition: .4s all ease-in-out
        }

        .modal-content .table th,
        .table td {
            padding: 1rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            padding: 10px 5px
        }

        .modal-content .table tr td:last-child {
            padding: 0
        }

        .modal-content .table tr td:last-child a.btn {
            padding: 0;
            margin-top: 9px
        }

        .modal-content .table tr td:last-child a.btn:nth-child(2) {
            margin-right: 4px
        }

        .table td a.btn {
            padding: 10px 2.5px;
            display: inline-block;
            float: right
        }

        .table tr td:last-child a.btn {
            display: flex;
            justify-content: center;
            align-items: center
        }

        button.btn.btn-info.col-sm-3.col-xs-6.addin-ca-bt.wierd-another-btn {
            float: left;
        }

        .the-bill-numbere {
            font-size: 18px !important;
            display: block;
            width: 100%;
            text-align: center;
            padding-bottom: 0px;
            border-bottom: 0px !important;
            color: rgb(255, 255, 255);
            background: rgb(46, 204, 113);
            display: inline-block;
            border-radius: 5px;
            padding: 5px;
        }

        .btn-info {
            background-color: #2ECC71;
            border-color: #2ECC71;
        }

        .btn-info:focus,
        .btn-info.focus,
        .btn-info:hover,
        .btn-info:active:hover,
        .btn-info.active:hover,
        .open>.dropdown-toggle.btn-info:hover,
        .btn-info:active:focus,
        .btn-info.active:focus,
        .open>.dropdown-toggle.btn-info:focus,
        .btn-info:active.focus,
        .btn-info.active.focus,
        .open>.dropdown-toggle.btn-info.focus {
            background-color: #0aad4f;
            border-color: #0aad4f;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 10px 5px;
            line-height: 1.5384616;
            vertical-align: top;
            border-top: 1px solid #ddd !important;
        }

        .row.justify-content-center.width-100-flex {
            display: inline-block;
            justify-content: center;
            align-items: center;
            padding: 30px 0;
        }

        button.btn.btn-info.print.col-sm-6.v-lg-print-btn {
            width: auto !important;
            margin-right: 30px;
        }

        .the-bill-numbere span {
            display: inline-block
        }

        .a-new-table.tablesaw-sortable td i,
        .a-new-table.tablesaw-sortable th i {
            position: absolute;
            right: -10px;
            top: 12px;
            color: #2ECC71;
        }

        .a-new-table.tablesaw-sortable td,
        .a-new-table.tablesaw-sortable th {
            position: relative;
        }

        span.tablesaw-cell-content {
            position: relative;
        }

        table.bill-table-whole-wrapper td i,
        table.bill-table-whole-wrapper th i {
            position: relative;
            right: -6px;
            top: 2px;
            color: #2ECC71;
        }

        .a-new-table.tablesaw-sortable td:first-child,
        .a-new-table.tablesaw-sortable th:first-child {
            font-weight: 700;
            font-size: 13px
        }

        .a-new-table.tablesaw-sortable {
            margin-top: -25px
        }

        .a-new-table.tablesaw-sortable tr:nth-child(2n),
        .bill-table-whole-wrapper.tablesaw-sortable tr:nth-child(2n) {
            background: #fff;
        }

        .a-new-table.tablesaw-sortable td {
            border: 0px !important
        }

        .a-new-table.tablesaw-sortable th {
            border-top: 0px !important
        }

        ol.sml-ser-tits {
            padding-right: 20px;
        }

        .all-sub-services-unit-pri-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding-top: 27px;
        }

        span.sml-ser-uni-pr {
            margin-bottom: 5px;
        }

        .bill-table-tr-wrapper {
            background: #0aad4f !important;
            color: #fff;
        }

        .a-new-table.tablesaw-sortable>tbody>tr>td:first-child,
        .a-new-table.tablesaw-sortable>tbody>tr>th:first-child {
            position: relative;
            width: 135px;
            padding-left: 0
        }

        .a-new-table.tablesaw-sortable>tbody>tr>td:last-child,
        .a-new-table.tablesaw-sortable>tbody>tr>th:last-child {
            padding-left: 2px;
            padding-right: 2px
        }

        .a-new-table.tablesaw-sortable>tbody>tr>td:first-child:after,
        .a-new-table.tablesaw-sortable>tbody>tr>th:first-child:after {
            position: absolute;
            left: 4px;
            top: 2px;
            content: " : ";
            color: #000 !important;
            font-size: 20px;
        }

        .grrs-panel {
            font-size: 20px;
            margin-top: 10px;
            text-align: right;
            color: #2ECC71
        }








        @media (min-width:768px) {
            .v-customized-radio .custo-labl {
                height: 140px;
            }

            .form-group.the-sub-service-wrapper span.after-img-label {
                font-size: 11px;
            }

            .mini-sidebar .top-navbar .navbar-header {
                width: 215px
            }

            .col-sm-6.one-new-side-part {
                width: 50%;
                float: right;
                padding: 0
            }

            .col-sm-6.one-new-side-part.bo-left-1 {
                border-left: 1px solid #eee
            }

            .col-sm-6.one-new-side-part.bo-right-1 {
                border-right: 1px solid #eee
            }
        }



        .new-home-link {
            margin-top: 40px;
            text-align: center
        }

        .pos-relative {
            position: relative
        }

        .full-width {
            width: 100%;
        }

        .end-notice {
            text-align: center;
            margin-top: 15px
        }

        .end-notice div {
            font-size: 20px;
            font-weight: 700
        }

        .non-flex {
            display: inline !important
        }

        .non-flex .no-float {
            float: none !important
        }

        .halfe {
            width: auto !important
        }

        .new-group {
            width: 100% !important
        }



        @media (min-width :768px) {
            .form-group.the-sub-service-wrapper {
                width: 50%
            }
        }

        @media (max-width :768px) {
            .topbar .top-navbar .navbar-header .navbar-brand {
                width: 100px;
                height: 30px
            }
        }

        @media (min-width :576px) and (max-width :767px) {
            li.nav-item+li.nav-item a.nav-link.d-none {
                display: inline-block !important
            }

            .form-group.the-sub-service-wrapper {
                width: 33.333%
            }
        }

        @media (max-width :576px) {
            .form-group.the-sub-service-wrapper {
                width: 50%
            }

            .one-bill-inpt {
                width: 100%
            }

            .col-xs-4.the-big-bill {
                width: 100%
            }

            .login-page .card {
                max-width: 90%;
                width: 90%;
                margin-left: 5%
            }

            span.close.delete-this-row {
                bottom: unset;
                top: 0;
                left: -5px
            }
        }

        .end-notice div {
            font-size: 20px;
            font-weight: 700;
        }

        .the-bill-design .one-bill-inpt .bill-lbl {
            font-weight: 700;
            font-size: 13px;
        }

        .the-bill-logo img {
            width: 195px !important;
            height: 70px;
            object-fit: contain;
            padding-top: 5px;
        }

        .a-new-table td {
            border: 0px !important;
        }

        .a-new-table th {
            border: 0px !important;
        }

        .a-new-table {
            border: 0px !important;
        }

        h4.card-title {
            display: none;
        }

        h6.card-subtitle {
            display: none;
        }

        /**********************************************/
        .a-new-table>tbody>tr>td.car-path-div {
            text-align: center !important;
            padding: 5px;
            background: #2ECC71 !important;
            margin-top: 10px;
            color: #fff !important;
            border-radius: 5px;
            -webkit-print-color-adjust: exact !important;
            border-radius: 50%;
            width: max-content;
            min-width: 25px;
            height: 25px;
            padding: 0;
            display: flex;
            justify-content: center;
            padding: 0 5px !important;
        }

        .car-path-div {
            color: #fff !important;
        }

        .table-hover>tbody>tr:hover {
            background-color: inherit;
        }
        .end-notice div:last-child {
            margin-bottom: 25px
        }





        @media print {
            .a-new-table.tablesaw-sortable>tbody>tr>td:first-child:after,
            .a-new-table.tablesaw-sortable>tbody>tr>th:first-child:after {
                position: absolute;
                left: 4px;
                top: 2px;
                content: " : ";
                color: #000 !important;
                font-size: 20px;
            }

            .end-notice div:last-child {
                margin-bottom: 25px
            }
        }

        @media print {
            #all-services-table {
                position: fixed;
                width: 100%;
                height: 100%;
                right: 0;
                left: 0;
                top: 0;
                z-index: 9999999999
            }
        }
        @media print {
            thead:not(:first-child) {
                display: none !important
            }

            body thead:first-child {
                display: table-header-group !important;
                vertical-align: middle;
                border-color: inherit;
            }

            .bill-table-whole-wrapper>tr.bill-table-tr-wrapper.fixed-ta-hd {
                background: #2ECC71 !important;
                color: #fff !important;
            }

            .the-bill-numbere {
                font-size: 18px !important;
                display: block;
                width: 100%;
                text-align: center;
                padding-bottom: 0px;
                border-bottom: 0px !important;
                color: #fff !important;
                background: #2ECC71 !important;
            }

            .bill-table-tr-wrapper,
            .fixed-ta-hd,
            .fixed-ta-hd td {
                background: #002060 !important;
                color: #fff
            }

            .the-bill-numbere span {
                color: #fff !important;
            }

            body {
                margin: 0px auto;
                background-repeat: no-repeat;
                background-size: 100% 100%;
                -webkit-print-color-adjust: exact !important;
            }

            .container-fluid.the-bill-design {
                margin: 0 auto;
            }

            .bill-table-whole-wrapper>tbody:first-child>tr>th {
                background: #2ECC71 !important;
                color: #fff !important
            }


            table.bill-table-whole-wrapper {
                border: solid #000 !important;
                border-width: 1px 0 0 1px !important;
            }

            table.bill-table-whole-wrapper th,
            table.bill-table-whole-wrapper td {
                border: solid #000 !important;
                border-width: 0 1px 1px 0 !important;
            }
        }
        @media print {

            .card .card-subtitle,
            .card .card-title,
            .m-t-40.all-em-links-wrapper,
            .print,
            .row.page-titles,
            footer,.page-header,.footer {
                display: none
            }

            @page {
                size: auto;
                margin: 0
            }



        }
    </style>
    <!--<link href="{{ asset('_admin/assets/css/edit.css') }}" rel="stylesheet" type="text/css">-->
@endsection

@section('content')





    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row printer">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body ">
                    <h4 class="card-title">الفاتوره</h4>
                    <div class="container-fluid the-bill-design too-be-topped" id="div-to-print">
                        <div class="one-bill-inpt the-bill-logo text-center the-bill-number"
                            style="border-bottom:4px solid #333;padding-bottom: 0;margin-bottom: 15px">
                            <img src="{{ asset('dashboard/assets/app/media/img/logos/20191031163554-شعار رمانة.png') }}">
                        </div>
                        <div class="one-bill-inpt the-bill-company text-center"
                            style="display:block;width:100%;text-align: center!important;margin-bottom: 0px">
                            <span class="bill-lbl">{!! getsetting('higher_data') !!}</span>

                        </div>
                        <div class="one-bill-inpt the-bill-address"
                            style="display:block;width:100%;text-align: center!important;margin-bottom: 5px">
                            <i class="ti-location-pin"></i>
                            {{-- <span class="bill-lbl">  {!! optional($sale->branch)->ar_name !!}</span> --}}
                        </div>

                        <div class="one-bill-inpt the-bill-date"
                            style="direction: ltr;border-bottom: 0px;display:inline-block;width:50%;text-align: center!important;margin-bottom: 0px;padding-bottom:0px;margin-top: 0px;float:right">
                            <span class="bill-lbl"><?php echo $sale->date; ?></span>
                            <i class="ti-calendar" style="float: none;"></i>
                        </div>

                        <div class="one-bill-inpt the-cust-name"
                            style="border-bottom: 0px;display:block;width:100%;margin-bottom: 0px;padding-bottom: 0px;border-bottom:1px solid #333!important">
                            <i class="ti-user"></i>
                            <span class="bill-lbl" style="float:right;text-align:right;">مدخل الفاتوره : </span>
                            <span style="margin-right:5px;text-align:left;"> {!! optional($sale->user)->name !!}</span>
                        </div>
                        <div class="one-bill-inpt the-bill-numbere the-bill-number">
                            <span>رقم الفاتوره</span>
                            {!! $sale->counter_sale !!}
                        </div>




                        <div class="flex-col">
                            <table class="tablesaw a-new-table table-hover table table-bordered" data-tablesaw-mode="stack"
                                data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap
                                data-tablesaw-mode-switch>
                                <tbody>
                                    @if (getsetting('daily_number_sales') == 1)
                                        <tr>
                                            <td data-tablesaw-sortable-col data-tablesaw-priority="6" colspan="3"><i
                                                    class="ti-mobile"></i>رقم الفاتوره اليومى </td>
                                            <td> {!! $sale->daily_number !!}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th data-tablesaw-sortable-col data-tablesaw-priority="6" colspan="3"><i
                                                class="ti-user"></i>اسم العميل </th>
                                        <td> {!! optional($sale->client)->name !!}</td>
                                    </tr>
                                    {{-- <tr>
										<td data-tablesaw-sortable-col data-tablesaw-priority="6" colspan="3"><i class="ti-video-clapper"></i> اسم الفرع </td>
										<td> {!! optional($sale->branch)->name !!}</td>
									</tr>
									<tr>
										<th data-tablesaw-sortable-col data-tablesaw-priority="6" colspan="3"><i class="ti-user"></i>اسم المستودع</th>
										<td>  {!! optional($sale->store)->ar_name !!}</td>
									</tr> --}}

                                    {{-- <tr> --}}
                                    {{-- <th data-tablesaw-sortable-col data-tablesaw-priority="6" colspan="3"><i class="ti-bar-chart-alt"></i> طريقة الدفع </th> --}}
                                    {{-- <td> --}}
                                    {{-- @if ($sale->payment == 'cash') --}}

                                    {{-- نقدى --}}
                                    {{-- @elseif( $sale->payment=='agel') --}}
                                    {{-- اجل --}}
                                    {{-- @endif --}}
                                    {{-- </td> --}}
                                    {{-- </tr> --}}


                                </tbody>
                            </table>


                            <div class="flex-col mar-top-15">
                                <table class="tablesaw bill-table-whole-wrapper table-bordered table-hover table"
                                    data-tablesaw-mode="stack" data-tablesaw-sortable data-tablesaw-sortable-switch
                                    data-tablesaw-minimap data-tablesaw-mode-switch>
                                    <tr class="bill-table-tr-wrapper fixed-ta-hd">
                                        <th scope="col" data-tablesaw-sortable-col data-tablesaw-sortable-default-col
                                            data-tablesaw-priority="persist">م</th>
                                        <th scope="col" class="fixed-ta-hd" data-tablesaw-sortable-col
                                            data-tablesaw-priority="persist">المنتج</th>
                                        <th scope="col" class="fixed-ta-hd" data-tablesaw-sortable-col
                                            data-tablesaw-priority="persist">الكمية</th>
                                        <th scope="col" class="fixed-ta-hd" data-tablesaw-sortable-col
                                            data-tablesaw-priority="persist">السعر</th>
                                        <th scope="col" class="fixed-ta-hd" data-tablesaw-sortable-col
                                            data-tablesaw-priority="persist">إجمالي السعر</th>
                                    </tr>

                                    <tbody>
                                        @foreach ($product_items as $row)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{!! optional($row->product)->name !!}</td>
                                                <td>{{ $row->quantity }}</td>
                                                <td>{!! $row->price !!}</td>
                                                <td>{!! $row->price * $row->quantity !!}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"><i
                                                    class="ti-money"></i>الإجمالي</td>
                                            <td colspan="3"><span class="tot-money">{!! $sale->amount ?? 0 !!}</span></td>
                                        </tr>

                                        <tr>
                                            <td colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"><i
                                                    class="ti-minus"></i>الخصم</td>
                                            <td colspan="3">{!! $sale->discount ?? 0 !!}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"> <i
                                                    class="ti-plus"></i> قيمة الضريبه</td>
                                            <td colspan="3"> {{number_format($sale->totalTaxs,2) ?? 0}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"><i
                                                    class="ti-money"></i> المطلوب سداده</td>
                                            <td colspan="3">{!! $sale->total ?? 0 !!}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"><i
                                                    class="ti-bag"></i> طريقة الدفع</td>
                                            <td colspan="3">
                                                @if ($sale->payment == 'cash')
                                                    نقدى
                                                @elseif( $sale->payment=='agel')
                                                    اجل
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"><i
                                                    class="ti-money"></i>المدفوع</td>
                                            <td colspan="3">{!! $sale->payed ?? 0 !!}</td>
                                        </tr>

                                        <tr>
                                            <th colspan="2" data-tablesaw-sortable-col data-tablesaw-priority="6"><i
                                                    class="ti-export"></i>المتبقي</th>
                                            <td colspan="3">{!! $sale->total - $sale->payed ?? 0 !!}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <span class="bill-lbl">{!! getsetting('lower_data') !!}</span>

                            <div class="end-notice">
{{--                            <img style="width:30%"--}}
{{--                                 src="{{ asset('dashboard/assets/app/media/img/websiteQRCode_noFrame.png') }}">--}}

                                    {{QrCode::size(100)->generate(route('showInvoice',$sale->uuid))}}
                            </div>

                            <div class="end-notice">
                                <div>شكراً لكم</div>
                                <div>Thank you </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center width-100-flex">
            <button class="btn btn-info print col-sm-6 v-lg-print-btn" style="font-size: 26px;">طباعه</button>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    </div>
@endsection
@section('scripts')
    <script>
            $(".print").click(function() {
                window.print();
            })
    </script>

@stop








<!--=================================================================================================================================-->
