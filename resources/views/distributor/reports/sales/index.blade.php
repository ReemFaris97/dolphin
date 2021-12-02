@extends('distributor.layouts.app')
@section('title')  تقريرالمبيعات
@endsection



@section('content')


    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head belong-to-aform">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    تقرير المبيعات</h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                @include('distributor.reports.sales._form')
                <!--begin::Table-->
                    <div class="m-content">
                        <div class="m-portlet  m-portlet--unair">
                            <div class="m-portlet__body  m-portlet__body--no-padding">
                                <div class="row m-row--no-padding m-row--col-separator-xl">
                                    <div class="col-md-12 col-lg-6 col-xl-4">
                                        <a href="#">
                                            <!--begin::New Feedbacks-->
                                            <div class="m-widget24">
                                                <div class="m-widget24__item">
                                                    <h4 class="m-widget24__title">
                                                        عدد الزيارات
                                                    </h4><br>
                                                    <span class="m-widget24__desc">
                                            </span>
                                                    <span class="m-widget24__stats m--font-info">
                                                {{$trips->count()}}
                                            </span>
                                                    <div class="m--space-10"></div>
                                                    <div class="progress m-progress--sm">
                                                        <div class="progress-bar m--bg-info" role="progressbar"
                                                             style="width: {{0}}%;" aria-valuenow="50" aria-valuemin="0"
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
                                    <div class="col-md-12 col-lg-6 col-xl-4">
                                        <a href="#">
                                            <!--begin::New Orders-->
                                            <div class="m-widget24">
                                                <div class="m-widget24__item">
                                                    <h4 class="m-widget24__title">
                                                        اجمالى مرات الرفض
                                                    </h4><br>
                                                    <span class="m-widget24__desc">
                                            </span>
                                                    <span class="m-widget24__stats m--font-danger">
                                                {{$trips->where('type','refuse')->count()}}
                                            </span>
                                                    <div class="m--space-10"></div>
                                                    <div class="progress m-progress--sm">
                                                        <div class="progress-bar m--bg-danger" role="progressbar"
                                                             style="width: {{0}}%;" aria-valuenow="50" aria-valuemin="0"
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
                                    <div class="col-md-12 col-lg-6 col-xl-4">
                                        <a href="#">
                                            <!--begin::New Users-->
                                            <div class="m-widget24">
                                                <div class="m-widget24__item">
                                                    <h4 class="m-widget24__title">
                                                        اجمالى المبيعات
                                                    </h4><br>
                                                    <span class="m-widget24__desc">
                                            </span>
                                                    <span class="m-widget24__stats m--font-success">
                                           {{number_format($total_price,2)}}
                                            </span>
                                                    <div class="m--space-10"></div>
                                                    <div class="progress m-progress--sm">
                                                        <div class="progress-bar m--bg-success" role="progressbar"
                                                             style="width: {{0}}%;" aria-valuenow="50" aria-valuemin="0"
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
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div>
                                  <div id="chart_div" style="width: 500px; height: 400px;"></div>
                                    <div id="chart_div_2" style="width: 500px; height: 400px;"></div>
                    </div> --}}
                    <div class="text-center">
                        <button type="button" class="btn btn-success" id="print-all">طباعة</button>
                    </div>
                    <div id="print_this">
                        @include('distributor.reports.sales._table')
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <h3>أسباب الرفض</h3>
                        <table class="table table-striped table-bordered table-responsive ">
                            <thead>
                            <tr>
                                <th>السبب</th>
                                <th> العدد </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($refuse_reasons as $index => $reason)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{$reason->count()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{!! asset('dashboard/assets/vendors/base/jquery-2.1.4.min.js') !!}"></script>
    <script>
    

        $(document).ready(function() {
        $("#print-all").on('click', function() {
            let t = document.getElementById("print_this").innerHTML;
           
            let style = `<style>table.table.table-striped.table-bordered.edit-th-50.table-responsive{width:100%;direction:rtl}table.table.table-striped.table-bordered.edit-th-50 td{padding:10px}table.table.table-striped.table-bordered.edit-th-50 th{padding:15px 10px}</style>`;
            let win = window.open('', '');
            win.document.write(`<html>
        <head>
        <title>الفاتورة</title>
        <link rel="stylesheet" href="{{asset('admin/css/bootstrap-rtl.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/print-bill.css')}}">
        ${style}
        <head>
        <body>${t}</body></html>`);
            win.document.close();
            win.print();

        });
    })

</script>

    </script>
@endpush
@push('scripts')
    {{--     <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">

            var statistics =<?php echo json_encode($data); ?>;
            var count =<?php echo json_encode($day_count); ?>;
            google.charts.load('current', {'packages':['corechart','bar']});
             google.charts.setOnLoadCallback(drawVisualization);
            google.charts.setOnLoadCallback(drawVisualizationSales);

            function drawVisualization() {
                // Some raw data (not necessarily accurate)
                var xx=[
                    ['تاريخ اليوم', 'اجمالى الزيارات', 'اجمالى الزيارات المستلمة', 'اجمالى الزيارات المرفوضة'],
                ];

                Object.values(statistics).forEach(function (item) {
                    xx.push([parseFloat(item.day),parseFloat(item.total_trips),parseFloat(item.accepted_trips),parseFloat(item.refused_trips)]);
                });
                var data = google.visualization.arrayToDataTable(xx);

                var options = {
                    title : 'اجمالى اليومية',
                    vAxis: {title: 'Cups'},
                    hAxis: {title: 'الايام'},
                    seriesType: 'bars',
                    series: {count: {type: 'line'}}
                };

                var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }


            function drawVisualizationSales() {
                var sales=[
                    ['تاريخ اليوم', 'اجمالى المبيعات',],
                ];
                Object.values(statistics).forEach(function (item) {

                    sales.push([parseFloat(item.day),parseFloat(item.trips_cash)]);
                });
                // console.log(sales);
                var dataSales = google.visualization.arrayToDataTable(
                    sales
                );

                var optionsBar = {
                    title : 'اجمالى اليومية',
                            vAxis: {title: 'Cups'},
                            hAxis: {title: 'الايام'},
                            seriesType: 'bars',
                            series: {count: {type: 'line'}}

            };
                var bar = new google.visualization.ComboChart(document.getElementById('chart_div_2'));
                bar.draw(dataSales, optionsBar);
            }
        </script> --}}
@endpush
