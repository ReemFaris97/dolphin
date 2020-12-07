@extends('distributor.layouts.app')
@section('title')
عرض  بيانات المسار
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
                           عرض المسار
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">


                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                        <thead>
                        <tr>
                            <th> المعلومه</th>
                            <th> القيمه</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>  كود تسليم المسار</td>
                            <td>{{$route->received_code}}</td>
                        </tr>
                        <tr>
                            <td>اسم المندوب</td>
                            <td>{{$route->user->name}}</td>
                        </tr>
                        <tr>
                            <td>   تاريخ بدء المسار</td>
                            <td>{{$route->created_at}}</td>
                        </tr>
                        <tr>
                            <td>   تاريخ انهاء المسار</td>
                            <td>{{$route->updated_at}}</td>
                        </tr>
                        <tr>
                            <td> عدد عملاء المسار </td>
                            <td>{{$route->clients() }}</td>
                        </tr>

                        <tr>
                            <td>عدد الزيارات المقبولة </td>
                            <td>{{$route->accepted_trips() }}</td>
                        </tr>

                        <tr>
                            <td>عدد الزيارات المرفوضة </td>
                            <td>{{$route->refused_trips() }}</td>
                        </tr>

                        <tr>
                            <td>  المصروفات </td>
                            <td>{{$route->trips_reports()->sum('expenses') }}</td>
                        </tr>

                        <tr>
                            <td>  المبيعات </td>
                            <td>{{$route->trips_reports()->sum('route_trip_reports.cash') }}</td>
                        </tr>
                        <tr>
                            <td> ( المبيعات-المصروفات) الصافى </td>
                            <td>{{$route->trips_reports()->sum('route_trip_reports.cash')-$route->trips_reports()->sum('expenses') }}</td>
                        </tr>
                        </tbody>
                    </table>

                    <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">
                        <thead>
                            <tr>
                            <th>اسم الصنف </th>
                            <th>   الكمية بالحبة</th>
                            <th>   الكمية بالعلبة</th>

                            <th> السعر</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($route->trips->products)
                                @foreach($route->trips_reports->products as $value)
                                <tr>
                                <td>{{ $value->product->name }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>{{ $value->quantity /$value->product->quantity_per_unit }}</td>
                                <td>{{ $value->price }}</td>
                                </tr>
                                @endforeach --}}
                        <tbody>
                            <tfoot>
                                <tr>
                                <td>اجمالى عدد  الاصناف: </td>
                                <td></td>
                                </tr>
                                <tr>
                                    <td>اجمالى الفاتوره  : </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>اجمالى الموجود  : </td>
                                    <td></td>
                                 </tr>

                            </tfoot>
                    </table>

        </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
