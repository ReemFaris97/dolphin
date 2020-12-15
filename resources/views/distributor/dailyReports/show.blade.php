@extends('distributor.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['عرض الملخص اليومى'=>'/distributor',$report->id ])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                  عرض الملخص اليومى
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item"></li>

                </ul>
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
                                <td>اسم المندوب </td>
                                <td>{{$report->user->name}}</td>
                            </tr>
                            <tr>
                                <td>تاريخ الاضافة</td>
                                <td>{{$report->created_at}}</td>
                            </tr>
                            <tr>
                                <td> المبالغ النقدية </td>
                                <td>{{$report->cash }}</td>
                            </tr>


                            <tr>
                                <td>  المصروفات </td>
                                <td>{{$report->expenses }}</td>
                            </tr>

                            <tr>
                                <td>  اسم المستودع </td>
                                <td>{{$report->store->name ??'' }}</td>
                            </tr>
                            <tr>
                            <td>صور الملخص</td>
                            <td>
                                <img src="{!!asset($report->image)!!}" height="100" width="100"/>
                            </td>
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
                                @foreach($report->products as $value)
                                <tr>
                                <td>{{ $value->product->name }}</td>
                                    <td>
                                        @if($value->product->quantity_per_unit !=0)
                                    @if(($value->quantity/$value->product->quantity_per_unit) >=0)
                                     {{ $value->quantity/ $value->product->quantity_per_unit }}
                                        @else
                                      {{ $value->quantity }}
                                    @endif
                                            @endif
                                    </td>
                                <td></td>
                                <td>{{ $value->price }}</td>
                                </tr>
                                @endforeach
                        <tbody>
                    </table>

        </div>
    </div>


@endsection


@section('scripts')
@endsection
