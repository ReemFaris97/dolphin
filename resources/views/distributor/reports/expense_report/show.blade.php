@extends('distributor.layouts.app')
@section('title')
عرض  بيانات المصروف
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
                           عرض المصروف
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
                            <td>رقم سند المصروف</td>
                            <td>{{$expense->sanad_No}}</td>
                        </tr>
                        <tr>
                            <td>اسم المندوب</td>
                            <td>{{$expense->distributor->name}}</td>
                        </tr>
                        <tr>
                            <td>تاريخ المصروف</td>
                            <td>{{$expense->created_at}}</td>
                        </tr>
                        <tr>
                            <td> قيمة المصروف </td>
                            <td>{{$expense->amount }}</td>
                        </tr>
                        @if($expense->reader_number != Null)
                        <tr>
                            <td> اسم العداد</td>
                            <td>
                                {{$expense->name }}
                            </td>
                        </tr>

                        <tr>
                            <td> قراءة  العداد</td>
                            <td>
                                {{$expense->reader_number }}
                            </td>
                        </tr>

                            <tr>
                            <td>صور قراءةالعداد</td>
                            <td>
                                <img src="{!!asset($expense->reader_image )!!}" height="100" width="100"/>
                            </td>
                            </tr>
                        @endif
                        <tr>
                            <td> ملاحظة المصروف </td>
                            <td>{{$expense->notes }}</td>
                        </tr>
                        <tr>
                            <td>صورة فاتورة المصروف
                            </td>
                            <td>
                                <img src="{!!asset($expense->image )!!}" height="100" width="100"/>
                            </td>
                            </tr>




                        </tbody>
                    </table>


        </div>


            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

@endsection
