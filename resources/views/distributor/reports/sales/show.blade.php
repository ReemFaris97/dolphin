@extends('distributor.layouts.app')
@section('title')
    عرض  التفاصيل
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
                                    عرض فاتورة عميل
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
                                <td>رقم الفاتوره</td>
                                <td>{{$bill->invoice_number}}</td>
                            </tr>
                            <tr>
                                <td>العميل</td>
                                <td>{!!optional(optional($bill->route_trip)->client)->name !!}</td>
                            </tr>
                            <tr>
                                <td>تاريخ الفاتوره</td>
                                <td>{{$bill->created_at}}</td>
                            </tr>
                            <tr>
                                <td> قيمةالفاتوره </td>
                                <td>{{$bill->cash }}</td>
                            </tr>
                            <tr>
                                <td>اسم المندوب </td>
                                <td> {{optional($bill->route_trip)->route->user->name ??''}}</td>
                            </tr>
                            <tr>
                                <td>حالة الزيارة</td>
                                <td>
                                    @if($bill->status=='accepted')
                                        <label class="btn btn-success"> تم القبول</label>
                                    @else
                                        <label class="btn btn-danger"> تم الرفض</label>

                                    @endif
                                </td>
                            </tr>
                            @if($bill->status=='refused')
                                <tr>
                                    <td> سبب الرفض</td>
                                    <td>


                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td>صورقبل الزيارة</td>
                                <td>
                                    @foreach($bill->images as $key => $image)
                                        <img src="{!!asset($image->image)!!}" height="100" width="100"/>
                                    @endforeach()
                                </td>
                            </tr>
                            <tr>
                                <td>صور بعد الزيارة</td>
                                <td>
                                    <img src="{!!asset($bill->image)!!}" height="100" width="100"/>
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
                            @foreach($bill->products as $value)
                                <tr>
                                    <td>{{ $value->product->name }}</td>
                                    <td>{{ $value->quantity }}</td>
                                    <td>{{ $value->quantity /($value->product->quantity_per_unit ??'1') }}</td>
                                    <td>{{ $value->price }}</td>
                                </tr>
                            @endforeach
                            <tbody>
                            <tfoot>
                            <tr>
                                <td>اجمالى عدد  الاصناف: </td>
                                <td>{{ $bill->products->count() }}</td>
                            </tr>
                            <tr>
                                <td>اجمالى الفاتوره  : </td>
                                <td>{{ $bill->cash}}</td>
                            </tr>
                            <tr>
                                <td>اجمالى الموجود  : </td>
                                <td>{{ $bill->products->sum('price')}}</td>
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
