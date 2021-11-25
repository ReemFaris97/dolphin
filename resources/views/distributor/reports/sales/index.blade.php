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
                                                {{$dataAll['total_trips']}}
                                            </span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar m--bg-info" role="progressbar" style="width: {{$dataAll['total_trips']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                {{$dataAll['total_trips']}}
                                            </span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar m--bg-danger" role="progressbar" style="width: {{$dataAll['refused_trips']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                           {{$dataAll['trips_cash']}}
                                            </span>
                                        <div class="m--space-10"></div>
                                        <div class="progress m-progress--sm">
                                            <div class="progress-bar m--bg-success" role="progressbar" style="width: {{$dataAll['trips_cash']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
<div>
              <div id="chart_div" style="width: 500px; height: 400px;"></div>
                <div id="chart_div_2" style="width: 500px; height: 400px;"></div>
</div>
                @include('distributor.reports.sales._table')

            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
    </script>
@endpush
