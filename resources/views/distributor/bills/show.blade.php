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
        <button type="button" id="print-11cm"> 11 CM طباعة</button>
        <!--------- start content ---------->
        <div id="print_this">
            <div id="myDivToPrint">
            <div class="logo-bg">
                <div class="bill-container">
                <div>
                    <!--- header -->
                <header>
                    <div class="hd_inn">
                        <div class="hd_txt">
                            <h3>مصنع إبراهيم سليمان العثيم للتعبئة و التغليف</h3>
                            <h3>Ibrahim Sulaiman Al-Othaim Factory for Filling and Packaging</h3>
                            <div class="flexx">
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
                                <p>{{$bill->created_at}}</p>
                                <h4>date</h4>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="box1">
                            <div class="flexx">
                                <h4>نوع الفاتورة</h4>
                                <p>فاتورة نقدية</p>
                                <h4>invoice type</h4>
                            </div>

                        </div>
                    </div>
                    <div class="col">
                        <div class="box1">
                            <div class="flexx">
                                <h4>رقم الفاتورة</h4>
                                <p>{{$bill->invoice_number}} </p>
                                <h4>invoice no.</h4>
                            </div>

                        </div>
                    </div>
                </div>
                <!---->
                <div class="row">
                    <div class="box1">
                        <div class="flexx">
                            <div class="box1 third">
                                <div class="flexx">
                                    <h4>كود العميل</h4>
                                    <p>{!!optional(optional($bill->route_trip)->client)->code !!}</p>
                                    <h4>cust. code</h4>
                                </div>

                            </div>
                            <div class="box1 third">
                                <div class="flexx">
                                    <h4>اسم العميل</h4>
                                    <p>{!!optional(optional($bill->route_trip)->client)->name !!}</p>
                                    <h4>cust. name</h4>
                                </div>

                            </div>
                            <div class="box1 third">
                                <div class="flexx ">
                                    <h4>الرقم الضريبى للعميل</h4>
                                    <p>{!!optional(optional($bill->route_trip)->client)->tax_number !!}</p>
                                    <h4>Cust. vat No.</h4>
                                </div>

                            </div>
                        </div>
                        <div class="flexx">
                            <div class="box1  third-quater">
                                <div class="flexx">
                                    <h4>العنوان</h4>
                                    <p>{!!optional(optional($bill->route_trip)->client)->address !!}</p>
                                    <h4>address</h4>
                                </div>


                            </div>
                            <div class="box1 quater">
                                <div class="flexx">
                                    <h4>هاتف</h4>
                                    <p>{!!optional(optional($bill->route_trip)->client)->phone !!}</p>
                                    <h4>phone</h4>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!---->
                <div class="row">
                    <div class="box1">
                        <div class="flexx">
                            <div class="box1 half">
                                <div class="flexx">
                                    <h4>جوال المندوب</h4>
                                    <p>{!! optional($bill->route_trip)->route->user->phone ??''!!}</p>
                                    <h4>Representative no.</h4>
                                </div>

                            </div>

                            <div class="box1 half">
                                <div class="flexx">
                                    <h4>اسم المندوب</h4>
                                    <p> {{optional($bill->route_trip)->route->user->name ??''}}</p>
                                    <h4>Representative Name</h4>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!--- table---->
                <div class="bg_logo">
                    <table class="the_table">
                        <thead>
                            <tr>
                                <th class="col9">
                                    <p>الإجمالى  <br> (بدون ضريبة)</p>
                                    <p></p>
                                </th>
                                <th>
                                    <p>ضريبة <br>  القيمة المضافة</p>
                                    <p>vat</p>
                                </th>
                                <th>
                                    <p>نسبة ضريبة<br> القيمة المضافة</p>
                                    <p>vat%</p>
                                </th>
                                <th>
                                    <p>السعر بدون ضريبة<br>  القيمة المضافة</p>
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
                                    <p>إسم الصنف</p>
                                    <p>product Name</p>
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
                                <td>{{ $value->price * $value->quantity }}</td>
                                <td>

                                    {{ ($value->price * ((float) getsetting('general_taxs')??0)/100)}}
                                </td>
                                <td>{{(float) getsetting('general_taxs')}}%</td>
                                <td>{{ $value->price }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>    @if($bill->is_packages)
                                    كرتونة
                                            @else
                  حبة     
                                                        @endif      
                                </td>


                                <td class="product-name">{{ $value->product->name }}</td>
                                <td>{!!$loop->iteration!!}</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>

                </div>
                    <div>
                    <table class="the_table">
                    <tfoot>
                        @php($tax_percent=(float)(getsetting('general_taxs')) /100)
                        @php($tax_amount= round($bill->product_total() * $tax_percent,2))
                        @php($total=$bill->product_total() + $tax_amount)
                            <tr>
                                <th>{{(float) $bill->product_total()}}</th>
                                <th colspan="4">
                                    <div class="flexx">
                                        <p>total</p>
                                        <p>الإجمالى (بدون ضريبة)</p>
                                    </div>

                                </th>
                                <th style="width: 95px;" rowspan="3">

                                    {!! QrCode::size(100)->generate(
                                 url('/api/distributor/bills/print_bill/' .  encrypt($bill->id))
                                        ); !!}
                             </th>

                            </tr>

                            <tr>
                                <th>{{$tax_amount}}</th>
                                <th colspan="4">
                                    <div class="flexx">
                                        <p>قيمة القيمة المضافة</p>
                                        <p>vat (15%)</p>
                                    </div>

                                </th>
                            </tr>
                            <tr>
                                <th>{{$total}}</th>
                                <th >
                                    <p>net amount</p>
                                    <p>اجمالى الفاتورة</p>
                                </th>

                                <th >
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>المبلغ كتابة:</h4>
                                            <h4>S.R in words:</h4>
                                        </div>
                                        <p>{{ $bill->CashArabic($total)[0] }}
                                            ريال
                                            {{ $bill->CashArabic($total)[1] ??''}}
                                            @if($bill->CashArabic($total)[1]!=0)
                                            هللة
                                                @endif
                                            لاغير
                                        </p>
                                    </div>
                                </th>

                            </tr>
                        </tfoot>
                    </div>
                    </table>
                <!--- footer -->
                <footer>
                    <div class="row">
                        <div class="col-3 box1 flexx" style="width:25%">
                                    <p style="text-align:center;">المدفوع كاش</p>
                                    <p style="text-align:center;">{{round($bill->cash,2)}}</p>
                        </div>
                        <div class="col-3 box1 flexx" style="width:25%">
                                    <p style="text-align:center;">المدفوع شبكة</p>
                                    <p style="text-align:center;">{{round($bill->visa,2)}}</p>
                        </div>
                        <div class="col">
                            <div class="box1 flexx">
                                    <div>
                                        <h4>توقيع المستلم</h4>
                                        <h4>signature</h4>
                                    </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="flexx foot_bg">
                            <div>
                                <h5>المملكة العربية السعودية - القصيم - المدينة الصناعية الثانية بالقصيم
                                </h5>
                                <div class="sp-arrownd">
                                    <h5>الهاتف</h5>
                                    <h5>0163231301</h5>
                                </div>
                                <div class="sp-arrownd">
                                    <h5>الفاكس</h5>
                                    <h5>0163231301</h5>
                                </div>
                            </div>
                            <div>
                                <h5>الرقم الضريبى vat no.</h5>
                                <h5>300420708200003</h5>
                                <h5>سجل تجارى c.r</h5>
                                <h5>1131021506</h5>
                            </div>
                            <div>
                                <h5> Kingdom of Saudi Arabia - Al-Qassim - Qassim Second Industrial City</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    </div>
                </footer>
                </div>
            </div>
            </div>
        </div>
        <div id="print_small">
        <div id="myDivToPrintsmall">
            <div style="display:flex; justify-content:space-between; padding: 10px 20px 0;">
                <h3 style="margin: auto 0;">مصنع إبراهيم سليمان العثيم للتعبئة و التغليف</h3>
                <div class="logo">
                    <img src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}" alt="logo">
                </div>
            </div>
            <div class="details-container">
                <p>التاريخ</p>
                <p>{{$bill->created_at}}</p>
            </div>
            <div class="details-container">
                <p>نوع الفاتورة</p>
                <p>فاتورة نقدية</p>
            </div>
            <div class="details-container">
                <p>رقم الفاتورة</p>
                <p>{{$bill->invoice_number}}</p>
            </div>
            <div class="details-container">
                <p>كود العميل</p>
                <p>{!!optional(optional($bill->route_trip)->client)->code !!}</p>
            </div>
            <div class="details-container">
                <p>اسم العميل</p>
                <p>{!!optional(optional($bill->route_trip)->client)->name !!}</p>
            </div>
            <div class="details-container">
                <p>الرقم الضريبي للعميل</p>
                <p>{!!optional(optional($bill->route_trip)->client)->tax_number !!}</p>
            </div>
            <div class="details-container">
                <p>العنوان</p>
                <p>{!!optional(optional($bill->route_trip)->client)->address !!}</p>
            </div>
            <div class="details-container">
                <p>هاتف</p>
                <p>{!!optional(optional($bill->route_trip)->client)->phone !!}</p>
            </div>
            <div class="details-container">
                <p>جوال المندوب</p>
                <p>{!! optional($bill->route_trip)->route->user->phone ??''!!}</p>
            </div>
            <div class="details-container">
                <p>اسم المندوب</p>
                <p>{{optional($bill->route_trip)->route->user->name ??''}}</p>
            </div>
            <p>........................................................................................................</p>
            <table>
                <thead>
                    <tr>
                        <th>م</th>
                        <th>اسم الصنف</th>
                        <th>الوحدة</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th>ضريبة</th>
                        <th>المبلغ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bill->products as $value)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td class="product-name">{{ $value->product->name }}</td>
                        <td>@if($bill->is_packages)
                                كرتونة
                            @else
                                حبة     
                            @endif      
                        </td>
                        <td>{{ $value->quantity }}</td>
                        <td>125.125</td>
                        {{-- <td>{{ $value->price * $value->quantity }}</td> --}}
                        <td>125.125</td>
                        {{-- <td>{{ ($value->price * ((float) getsetting('general_taxs')??0)/100)}}</td> --}}
                        <td>125.125</td>
                        {{-- <td>{{ $value->price }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <p></p>
            <p></p>
        </div>
        </div>
    </div>
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
