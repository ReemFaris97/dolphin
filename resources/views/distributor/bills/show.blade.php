{{--@extends('distributor.layouts.app')--}}
{{--@section('title')--}}
{{--@endsection--}}

{{--@section('header')--}}
{{--@endsection--}}

{{--@section('breadcrumb') @php($breadcrumbs=['عرض الفاتورة'=>'/distributor',$bill->id])--}}
{{--@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])--}}
{{--@endsection--}}

{{--@section('content')--}}
{{-- <div class="m-portlet m-portlet--mobile">--}}
{{-- <div class="m-portlet__head">--}}
{{-- <div class="m-portlet__head-caption">--}}
{{-- <div class="m-portlet__head-title">--}}
{{-- <h3 class="m-portlet__head-text">--}}
{{-- --}}{{-- {{$user->name}} --}}
{{-- </h3>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="m-portlet__head-tools">--}}
{{-- <ul class="m-portlet__nav">--}}

{{-- <li class="m-portlet__nav-item"></li>--}}

{{-- </ul>--}}
{{-- </div>--}}
{{-- </div>--}}
{{-- <div class="m-portlet__body">--}}


{{-- <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">--}}
{{-- <thead>--}}
{{-- <tr>--}}
{{-- <th> المعلومه</th>--}}
{{-- <th> القيمه</th>--}}
{{-- </tr>--}}
{{-- </thead>--}}
{{-- <tbody>--}}
{{-- <tr>--}}
{{-- <td>رقم الفاتوره</td>--}}
{{-- <td>{{$bill->invoice_number}}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td>العميل</td>--}}
{{-- <td>{!!optional(optional($bill->route_trip)->client)->name  !!}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td>تاريخ الفاتوره</td>--}}
{{-- <td>{{$bill->created_at}}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td> قيمةالفاتوره </td>--}}
{{-- <td>{{$bill->cash }}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td>اسم المندوب </td>--}}
{{-- <td>{!! optional($bill->route_trip)->route->user->name !!}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td>حالة الزيارة</td>--}}
{{-- <td>--}}
{{-- @if(optional(optional($bill->inventory)->type=='accept'))--}}
{{-- <label class="btn btn-success"> تم القبول</label>--}}
{{-- @else--}}
{{-- <label class="btn btn-danger"> تم الرفض</label>--}}

{{-- @endif--}}
{{-- </td>--}}
{{-- </tr>--}}
{{-- @if(optional($bill->inventory)->type=='refuse')--}}
{{-- <tr>--}}
{{-- <td> سبب الرفض</td>--}}
{{-- <td>--}}

{{-- {{optional($bill->inventory)->refuse_reason}}--}}
{{-- </td>--}}
{{-- </tr>--}}
{{-- @endif--}}

{{-- <tr>--}}

{{-- <td>صورقبل الزيارة</td>--}}
{{-- <td>--}}
{{-- @isset($bill->inventory->images )--}}
{{-- @foreach($bill->inventory->images as $key => $image)--}}
{{-- <img src="{!!asset($image->image)!!}" height="100" width="100"/>--}}
{{-- @endforeach()--}}
{{-- @endisset--}}
{{-- </td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td>صور بعد الزيارة</td>--}}
{{-- <td>--}}
{{-- @foreach($bill->images as $key => $image)--}}
{{-- <img src="{!!asset($image->image)!!}" height="100" width="100"/>--}}
{{-- @endforeach()--}}
{{-- </td>--}}
{{-- </tr>--}}
{{-- </tr>--}}


{{-- </tbody>--}}
{{-- </table>--}}


{{-- <table class="table  dataTable table-responsive-sm table-bordered  table-hover ">--}}
{{-- <thead>--}}
{{-- <tr>--}}
{{-- <th>اسم الصنف </th>--}}
{{-- <th>   الكمية بالحبة</th>--}}
{{-- <th>   الكمية بالعلبة</th>--}}
{{-- <th> السعر</th>--}}
{{-- </tr>--}}
{{-- </thead>--}}
{{-- <tbody>--}}
{{-- @foreach($bill->products as $value)--}}
{{-- <tr>--}}
{{-- <td>{{ $value->product->name }}</td>--}}
{{-- <td>{{ $value->quantity }}</td>--}}
{{-- <td>--}}
{{-- @if($value->product->quantity_per_unit != 0)--}}
{{-- {{  $value->quantity / $value->product->quantity_per_unit }}--}}
{{-- @else--}}
{{-- {{    $value->quantity / 1 }}--}}
{{-- @endif--}}
{{-- </td>--}}
{{-- <td>{{ $value->price }}</td>--}}
{{-- </tr>--}}
{{-- @endforeach--}}
{{-- <tr>--}}
{{-- <td  colspan="2">اجمالى عدد  الاصناف: </td>--}}
{{-- <td  colspan="2">{{ $bill->products->count() }}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td  colspan="2">اجمالى الفاتوره  : </td>--}}
{{-- <td  colspan="2">{{ $bill->cash}}</td>--}}
{{-- </tr>--}}
{{-- <tr>--}}
{{-- <td  colspan="2">اجمالى الموجود  : </td>--}}
{{-- <td  colspan="2" >{{ $bill->products->sum('price')}}</td>--}}
{{-- </tr>--}}
{{-- <tbody>--}}
{{-- </table>--}}
{{-- </div>--}}
{{-- </div>--}}

{{--@endsection--}}
{{--@section('scripts')--}}
{{--@endsection--}}
@extends('distributor.layouts.app')
@section('title')
@endsection

@push('header')
<link href="{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}" rel="stylesheet" type="text/css" />
@endpush

@section('breadcrumb') @php($breadcrumbs=['عرض الفاتورة'=>'/distributor',])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

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
    <div class="m-portlet__body">
        <button type="button" id="print-all">طباعة</button>
        <!--------- start content ---------->
        <div id="print_this">
            <div id="myDivToPrint">
                <!--- header -->
                <header>
                    <div class="hd_inn">
                        <div class="hd_txt">
                            <h3>شركة دولفين العالمية للحلويات والمكسرات</h3>
                            <h3>Dolphin International Company for sweets and nuts</h3>
                            <div class="flexx">
                                <h5>تجارة المواد الغذائية بالجملة</h5>
                                <h5>Wholesale foodstuff trading</h5>
                            </div>
                        </div>
                        <div class="logo">
                            <img src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}" alt="logo">
                        </div>
                    </div>
                </header>
                <!---- columns -->
                <div class="row">
                    <div class="col">
                        <div class="box1">
                            <div class="flexx">
                                <h4>التاريخ</h4>
                                <h4>date</h4>
                            </div>
                            <p>{{$bill->created_at}}</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="box1">
                            <div class="flexx">
                                <h4>نوع الفاتورة</h4>
                                <h4>invoice type</h4>
                            </div>
                            <p>فاتورة نقدية</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="box1">
                            <div class="flexx">
                                <h4>رقم الفاتورة</h4>
                                <h4>invoice no.</h4>
                            </div>
                            <p>{{$bill->invoice_number}} </p>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row">
                    <div class="box1">
                        <div class="flexx">
                            <div class="box1">
                                <div class="flexx">
                                    <h4>كود العميل</h4>
                                    <h4>cust. code</h4>
                                </div>
                                <p>{!!optional(optional($bill->route_trip)->client)->code !!}</p>
                            </div>
                            <div class="box1">
                                <div class="flexx">
                                    <h4>اسم العميل</h4>
                                    <h4>cust. name</h4>
                                </div>
                                <p>{!!optional(optional($bill->route_trip)->client)->name !!}</p>
                            </div>
                            <div class="box1">
                                <div class="flexx">
                                    <h4>الرقم الضريبى للعميل</h4>
                                    <h4>cust. vat no.</h4>
                                </div>
                                <p>{!!optional(optional($bill->route_trip)->client)->tax_number !!}</p>
                            </div>
                        </div>
                        <div class="flexx">
                            <div class="box1">
                                <div class="flexx">
                                    <h4>العنوان</h4>
                                    <h4>address</h4>
                                </div>
                                <p>{!!optional(optional($bill->route_trip)->client)->address !!}</p>

                            </div>
                            <div class="box1">
                                <div class="flexx">
                                    <h4>هاتف</h4>
                                    <h4>phone</h4>
                                </div>
                                <p>{!!optional(optional($bill->route_trip)->client)->phone !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row">
                    <div class="box1">
                        <div class="flexx">
                            <div class="box1">
                                <div class="flexx">
                                    <h4>جوال المندوب</h4>
                                    <h4>Representative no.</h4>
                                </div>
                                <p>{!! optional($bill->route_trip)->route->user->phone ??''!!}</p>
                            </div>
                            <!-- <div class="box1">
                                @if($bill->store->has_car==1)
                                <div class="flexx">
                                    <h4>رقم الشاحنة</h4>
                                    <h4> {{$bill->store->car->plate_number ??''}}</h4>
                                </div>
                                @endif
                                <p></p>
                            </div> -->
                            <div class="box1">
                                <div class="flexx">
                                    <h4>اسم المندوب</h4>
                                    <h4>Representative Name</h4>
                                </div>
                                <p>محمد أحمد</p>
                            </div>
                            <!-- <div class="box1">
                                    <div class="flexx">
                                        <h4>نقطة الشحن</h4>
                                        <h4>{{$bill->store->name }}</h4>
                                    </div>
                                    <p>القصيم</p>
                                </div> -->
                        </div>
                    </div>
                </div>
                <!--- table---->
                <div class="bg_logo">
                    <table class="the_table">
                        <thead>
                            <tr>
                                <th>
                                    <p>الإجمالى</p>
                                    <p></p>
                                </th>
                                <th>
                                    <p>ضريبة القيمة المضافة</p>
                                    <p>vat</p>
                                </th>
                                <th>
                                    <p>نسبة ضريبة القيمة المضافة</p>
                                    <p>vat%</p>
                                </th>
                                <th>
                                    <p>السعر بدون ضريبة القيمة المضافة</p>
                                    <p>price without vat</p>
                                </th>
                                <th>
                                    <p>الكمية</p>
                                    <p>qty</p>
                                </th>
                                <th>
                                    <p>الوحدة</p>
                                    <p>unit</p>
                                </th>
                                <th>
                                    <p>بيان الصنف</p>
                                    <p>product description</p>
                                </th>
                                <th>
                                    <p>المسلسل</p>
                                    <p>No.</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bill->products as $value)
                            <tr>
                                <td>{{ $value->product->price +($value->product->price * getsetting('general_taxs')/100)}}</td>
                                <td>{{ ($value->product->price * getsetting('general_taxs')/100)}}</td>
                                <td>{{getsetting('general_taxs')}}%</td>
                                <td>{{ $value->product->price }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>حبة</td>
                                <td>
                                    <p class="not_bold"></p>
                                </td>
                                <!-- <td>{{ $value->product->bar_code }}</td> -->
                                <td>{{ $value->product->store->name ??'' }}</td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ $bill->cash}}</th>
                                <th colspan="10">
                                    <p>total</p>
                                    <p>المجموع</p>
                                </th>
                            </tr>
                            <tr>
                                <th>{{getsetting('general_taxs')}}%</th>
                                <th colspan="10">
                                    <p>vat</p>
                                    <p>ضريبة القيمة المضافة</p>
                                </th>
                            </tr>
                            <tr>
                                <th>{{$bill->cash+($bill->cash*getsetting('general_taxs') /100)}}</th>
                                <th>
                                    <p>net amount</p>
                                    <p>مبلغ الفاتورة</p>
                                </th>
                                <th colspan="9">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>المبلغ كتابة:</h4>
                                            <h4>S.R in words:</h4>
                                        </div>
                                        <p>{{ $bill->CashArabic($bill->cash+($bill->cash*getsetting('general_taxs')/100))[0] }}
                                            ريال و
                                            {{ $bill->CashArabic($bill->cash+($bill->cash*getsetting('general_taxs')/100))[1] }}
                                            هللة لاغير
                                        </p>
                                    </div>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--- footer -->
                <footer>
                    <div class="row">
                        <div class="col">
                            <div class="box1">
                                <div class="flexx">
                                    <h4>توقيع السائق</h4>
                                    <h4>driver signature</h4>
                                </div>
                                <p></p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="box1">
                                <div class="flexx">
                                    <h4>إسم المستلم</h4>
                                    <h4>receiver name</h4>
                                </div>
                                <p> </p>
                                <div class="flexx">
                                    <h4>إسم توقيع</h4>
                                    <h4>signature</h4>
                                </div>
                                <p> </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="flexx foot_bg">
                            <div>
                                <h5>المملكة العربية السعودية - القصيم - بريدة - شارع المياه
                                </h5>
                                <h5>الهاتف</h5>
                                <h5>0163231301</h5>
                                <h5>الفاكس</h5>
                                <h5>0163231301</h5>
                            </div>
                            <div>
                                <h5>الرقم الضريبى vat no.</h5>
                                <h5>111111111111111111111</h5>
                                <h5>سجل تجارى c.r</h5>
                                <h5>222222222222222222222</h5>
                            </div>
                            <div>
                                <h5> Kingdom of Saudi Arabia - Al-Qassim - Buraidah - Al-Miyah Street</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <b class="hint code">4636</b>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="{!! asset('dashboard/assets/vendors/base/jquery-2.1.4.min.js') !!}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('print-all').addEventListener('click', () => {
                var mywindow = window.open('', 'PRINT');
                mywindow.document.write('<html><head><title>الفاتورة</title>');
                mywindow.document.write("<link href=\"{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}\" rel=\"icon\"><link href=\"{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}\" rel=\"stylesheet\">")
                mywindow.document.write('</head><body >');
                mywindow.document.write(document.getElementById('print_this').innerHTML);
                mywindow.document.write('</body></html>');
                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/
                setTimeout(function() {
                    mywindow.print();
                    mywindow.document.close();
                })
                return true;
            });
        })
    </script>
    @endpush
    @endsection