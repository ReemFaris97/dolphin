@extends('distributor.layouts.app')
@section('title')
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['عرض  بيانات العميل'=>'/distributor',$client->id ])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                  عرض بيانات العميل {!!$client->name!!}
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
                                <td> كود العميل </td>
                                <td>{{$client->name}}</td>
                            </tr>
                            <tr>
                                <td> اسم العميل</td>
                                <td>{{$client->name}}</td>
                            </tr>
                            <tr>
                                <td> جوال العميل </td>
                                <td>{{$client->phone }}</td>
                            </tr>

                            <tr>
                                <td>  البريد الإلكتروني
                                </td>
                                <td>{{$client->email }}</td>
                            </tr>

                            <tr>
                                <td>
                                    تاريخ ووقت الإضافة
                                </td>
                                <td>{{$client->created_at }}</td>
                            </tr>

                            <tr>
                                <td>
                                    الحالة

                                </td>
                                <td>{{$client->is_active?'مفعل':'غير مفعل' }}</td>
                            </tr>
                            <tr>
                                <td>
                                    اسم المسار

                                </td>
                                <td>{{$client->route->name }}</td>
                            </tr>
                            <tr>
                                <td>
                                    اسم المندوب

                                </td>
                                <td>{{$client->user->name }}</td>
                            </tr>
                        </tbody>
                    </table>

        </div>
    </div>


@endsection


@section('scripts')
@endsection
