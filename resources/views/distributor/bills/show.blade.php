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
                            <h3>شركة دولفين  للحلويات والمكسرات</h3>
                            <h3>Dolphin  Company for sweets and nuts</h3>
                            <div class="flexx">
{{--                                <h5>تجارة المواد الغذائية بالجملة</h5>--}}
{{--                                <h5>Wholesale foodstuff trading</h5>--}}
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
                                <p> {{optional($bill->route_trip)->route->user->name ??''}}</p>
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
                                    <p>الإجمالى (بدون ضريبة)</p>
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
                                <td>{{ $value->product->price * $value->quantity }}</td>
                                <td>{{ ($value->product->price * getsetting('general_taxs')/100)}}</td>
                                <td>{{getsetting('general_taxs')}}%</td>
                                <td>{{ $value->product->price }}</td>
                                <td>{{ $value->quantity }}</td>
                                <td>حبة</td>
                                <td>
                                    <p class="not_bold"></p>
                                </td>

{{--                                <td>{{ $value->product->store->name ??'' }}</td>--}}
                                <td>{{ $value->product->name }}</td>
                                <td>{!!$loop->iteration!!}</td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>{{ $bill->product_total()}}</th>
                                <th colspan="10">
                                    <p>total</p>
                                    <p>الإجمالى (بدون ضريبة)</p>
                                </th>
                            </tr>
                            <tr>
                                <th>{{($bill->product_total() *getsetting('general_taxs') /100)}}</th>
                                <th colspan="10">
                                    <p>vat (15%)</p>
                                    <p>قيمة القيمة المضافة</p>
                                </th>
                            </tr>
                            <tr>
                                <th>{{$bill->product_total()+($bill->product_total()*getsetting('general_taxs') /100)}}</th>
                                <th>
                                    <p>net amount</p>
                                    <p>اجمالى الفاتورة</p>
                                </th>
                                <th colspan="9">
                                    <div class="box1">
                                        <div class="flexx">
                                            <h4>المبلغ كتابة:</h4>
                                            <h4>S.R in words:</h4>
                                        </div>
                                        <p>{{ $bill->CashArabic($bill->product_total()+($bill->product_total()*getsetting('general_taxs')/100))[0] }}
                                            ريال
                                            {{ $bill->CashArabic($bill->product_total()+($bill->product_total()*getsetting('general_taxs')/100))[1] ??''}}
                                            @if($bill->CashArabic($bill->product_total()+($bill->product_total()*getsetting('general_taxs')/100))[1]!=0)
                                            هللة
                                                @endif
                                            لاغير
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
{{--                        <b class="hint code">4636</b>--}}
                    </div>
                </footer>
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
                let style = `<style>@font-face{font-family:ElMessiri-Regular;src:url(../fonts/ElMessiri-Regular.ttf)}@font-face{font-family:ElMessiri-Bold;src:url(../fonts/ElMessiri-Bold.ttf)}@font-face{font-family:ElMessiri-SemiBold;src:url(../fonts/ElMessiri-SemiBold.ttf)}#myDivToPrint .the_table thead tr th,#myDivToPrint b,#myDivToPrint button,#myDivToPrint footer .foot_bg h5,#myDivToPrint footer .hint.code,#myDivToPrint header .hd_inn .hd_txt h3{font-family:ElMessiri-Bold}#myDivToPrint .box1 p,#myDivToPrint .the_table tbody tr td{font-family:ElMessiri-SemiBold}#myDivToPrint,#myDivToPrint .the_table tbody tr td p.not_bold{font-family:ElMessiri-Regular!important}#myDivToPrint *{border:0;margin:0;padding:0;outline:0!important;-webkit-box-sizing:border-box;box-sizing:border-box}#myDivToPrint{padding:0!important;margin:0!important;font-style:normal;font-weight:300;font-size:14px;line-height:1.6;color:#212121;overflow-x:hidden!important;overflow-y:auto;direction:rtl!important}#myDivToPrint button{border:0;color:#fff}#myDivToPrint a{color:#212121}#myDivToPrint a:focus,#myDivToPrint a:hover{text-decoration:none;cursor:pointer}#myDivToPrint a,#myDivToPrint button{transition:all .4s ease-in-out;-o-transition:all .4s ease-in-out;-moz-transition:all .4s ease-in-out;-webkit-transition:all .4s ease-in-out;-ms-transition:all .4s ease-in-out}#myDivToPrint .all-sections{padding:50px 0}#myDivToPrint .h2-after{font-size:26px;text-align:center;margin:0 auto 25px auto;text-transform:capitalize}#myDivToPrint .no-padding{padding:0!important}#myDivToPrint .no-margin{margin:0!important}#myDivToPrint .no-border{border:0!important}#myDivToPrint h1,#myDivToPrint h2,#myDivToPrint h3,#myDivToPrint h4,#myDivToPrint h5,#myDivToPrint h6{font-weight:500;line-height:1.1}#myDivToPrint h1,#myDivToPrint h2,#myDivToPrint h3{margin-top:20px;margin-bottom:10px}#myDivToPrint h3{font-size:24px}#myDivToPrint h4{font-size:18px}#myDivToPrint h5{font-size:14px}#myDivToPrint p{margin:0 0 10px}#print-all{color:#fff;font-size:19px;padding:5px 25px;outline:0;border-width:1px;border-style:solid;-o-border-image:initial;border-image:initial;border-radius:4px;-webkit-transition:all .5s ease 0s;-o-transition:all .5s ease 0s;transition:all .5s ease 0s;background-color:#29567a;margin:20px auto;display:table;cursor:pointer}#print-all:focus,#print-all:hover{background-color:#3d7cae}#myDivToPrint .flexx{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:justify;-ms-flex-pack:justify;justify-content:space-between;-webkit-box-align:center;-ms-flex-align:center;align-items:center}#myDivToPrint header{background-color:#3d7cae;position:relative;color:#fff;padding:6px;margin-bottom:20px}#myDivToPrint header .hd_inn{border:2px solid #f2f2f2}#myDivToPrint header .hd_inn .hd_txt{max-width:calc(100% - 220px);padding:20px 40px;width:-webkit-max-content;width:-moz-max-content;width:max-content}#myDivToPrint header .hd_inn .hd_txt h3{margin-top:0;text-transform:uppercase;font-size:23px}#myDivToPrint header .hd_inn .hd_txt h3:last-child{letter-spacing:1px}#myDivToPrint header .hd_inn .hd_txt .flexx h5{margin-bottom:0}#myDivToPrint header .hd_inn .logo{overflow:hidden;width:200px;height:200px;position:absolute;left:40px;top:calc(50% - 100px);border-radius:50%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;padding:10px;background-color:#fff}#myDivToPrint header .hd_inn .logo img{max-width:80%;max-height:80%;-o-object-fit:contain;object-fit:contain}#myDivToPrint .row{display:-webkit-box;display:-ms-flexbox;display:flex;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:0;margin-left:0;position:relative;margin-bottom:10px}#myDivToPrint .row .col{-ms-flex-preferred-size:0;flex-basis:0;-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;max-width:100%}#myDivToPrint .row .col .box1{margin:0 3px}#myDivToPrint .row>.box1{width:100%}#myDivToPrint header+.row>.col>.box1{height:100%}#myDivToPrint .box1{border:1px solid #212121;text-align:center;padding:10px 5px;border-radius:14px}#myDivToPrint .box1 .flexx{-webkit-box-align:baseline;-ms-flex-align:baseline;align-items:baseline}#myDivToPrint .box1 .flexx .box1{border:0;border-radius:0}#myDivToPrint .box1 .flexx .box1 .flexx h4:first-child{margin-left:14px}#myDivToPrint .box1 .flexx h4{text-transform:capitalize;margin-top:0}#myDivToPrint .box1 p{margin:0;min-height:26px;font-size:16px}#myDivToPrint .bg_logo{background-image:url(../../demo/demo12/media/img/logo/logo-black.png);background-position:center;background-size:contain;background-repeat:no-repeat;margin:20px auto}#myDivToPrint .the_table{border-collapse:collapse;width:100%;position:relative;background-color:rgba(255,255,255,.7)}#myDivToPrint .the_table>tbody>tr>td,#myDivToPrint .the_table>tbody>tr>th,#myDivToPrint .the_table>tfoot>tr>td,#myDivToPrint .the_table>tfoot>tr>th,#myDivToPrint .the_table>thead>tr>td,#myDivToPrint .the_table>thead>tr>th{border:1px solid #71726c;padding:10px}#myDivToPrint .the_table>tr:nth-child(odd){background-color:#f2f2f2}#myDivToPrint .the_table tfoot{position:static!important;page-break-before:always!important;page-break-after:always!important}#myDivToPrint .the_table tfoot,#myDivToPrint .the_table thead{display:table-row-group}#myDivToPrint .the_table thead tr th{text-align:center!important;background-color:#c3c3c3;-webkit-print-color-adjust:exact;-webkit-box-shadow:inset 0 0 0 1000px #c3c3c3;box-shadow:inset 0 0 0 1000px #c3c3c3}#myDivToPrint .the_table tfoot tr th p,#myDivToPrint .the_table thead tr th p{margin-bottom:4px;text-transform:capitalize}#myDivToPrint .the_table tfoot tr th p:last-child,#myDivToPrint .the_table tfoot tr th p:only-child,#myDivToPrint .the_table thead tr th p:last-child,#myDivToPrint .the_table thead tr th p:only-child{margin:0}#myDivToPrint .the_table tbody tr td{text-align:center!important}#myDivToPrint .the_table tbody tr td p{margin:0}#myDivToPrint .hint{color:red}#myDivToPrint footer .row .col{display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-flex:1;-ms-flex:1 1 0px;flex:1 1 0}#myDivToPrint footer .row .col .box1{-webkit-box-flex:1;-ms-flex:1 1 auto;flex:1 1 auto;-webkit-box-align:center;-ms-flex-align:center;align-items:center}#myDivToPrint footer .row .col:first-child .box1{-webkit-box-flex:1;-ms-flex:1 0 47%;flex:1 0 47%;margin-bottom:10px}#myDivToPrint footer .row .col:first-child .box1:last-child{margin:0}#myDivToPrint footer .foot_bg{margin:20px auto;background-color:#c3c3c3;border:1px solid #212121;text-align:center;padding:18px 5px;-webkit-box-align:baseline;-ms-flex-align:baseline;align-items:baseline}#myDivToPrint footer .foot_bg>div{min-width:20%}#myDivToPrint footer .foot_bg h5{text-transform:capitalize;margin-top:0}#myDivToPrint footer .foot_bg h5:last-child{margin-bottom:0}#myDivToPrint footer .hint.code{font-size:20px;text-align:left;width:100%}@media (min-width:992px){.m-body .m-content{display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;width:100%;-ms-flex-wrap:wrap;flex-wrap:wrap;width:calc(100vw - 300px)}}@media screen and (max-width:767px){#myDivToPrint header .hd_inn{-webkit-box-orient:vertical;-webkit-box-direction:reverse;-ms-flex-direction:column-reverse;flex-direction:column-reverse}#myDivToPrint header .hd_inn .hd_txt{max-width:100%}#myDivToPrint header .hd_inn .logo{position:static;margin:-20px auto 0 auto;width:120px;height:120px}#myDivToPrint .box1 .flexx{-ms-flex-wrap:wrap;flex-wrap:wrap}#myDivToPrint .the_table{overflow-x:auto;display:block}.m-portlet .m-portlet__body{padding:2px 8px}#myDivToPrint header .hd_inn .hd_txt h3{font-size:13px}#myDivToPrint header .hd_inn .logo{margin:-23px auto 0 auto;width:65px;height:65px}#myDivToPrint header .hd_inn .hd_txt{padding:12px 40px}#myDivToPrint .box1 .flexx h4{font-size:13px}#myDivToPrint .box1 p{font-size:12px;min-height:16px}#myDivToPrint .row{margin-bottom:8px}#myDivToPrint .box1{padding:5px 5px}#myDivToPrint .the_table>tbody>tr>td,#myDivToPrint .the_table>tbody>tr>th,#myDivToPrint .the_table>tfoot>tr>td,#myDivToPrint .the_table>tfoot>tr>th,#myDivToPrint .the_table>thead>tr>td,#myDivToPrint .the_table>thead>tr>th{padding:5px 7px}#myDivToPrint footer .foot_bg h5{font-size:12px}#print-all{margin:5px auto 10px auto;font-size:13px;font-weight:700;padding:3px 20px}h3.m-portlet__head-text{margin:5px;font-size:14px}#myDivToPrint header{margin-bottom:10px}#myDivToPrint .the_table thead tr th{min-width:120px;font-size:12px}#myDivToPrint .box1 .flexx .box1 .flexx h4:first-child{font-size:13px;font-weight:700}#myDivToPrint tfoot th{font-size:12px}#myDivToPrint .the_table tbody tr td{font-size:12px}}@media print{body,html{direction:rtl;height:100%;margin:0!important;padding:0!important;overflow-y:auto}#print-all,.hide-print{display:none}section.content{margin:0;width:100%}.show-print{display:block}td.show-print,th.show-print{display:table-cell}@page{margin:0 auto;overflow-y:auto;width:100%;height:100%;page-break-after:always}body{width:100%;height:auto;page-break-after:always;padding-bottom:2px;background:0 0}#myDivToPrint,body{font-size:11px;overflow-y:visible;page-break-after:always;display:table!important}#myDivToPrint{border:1px solid #000!important;margin:0 auto!important;padding:6px 2px 2px 2px;background:0 0;display:table!important;width:100%;height:100%;page-break-after:always;width:100%;margin:0 auto 50px auto;margin-top:0!important}.the_table thead tr th{background-color:#c3c3c3;-webkit-print-color-adjust:exact;-webkit-box-shadow:inset 0 0 0 1000px #c3c3c3;box-shadow:inset 0 0 0 1000px #c3c3c3}body{padding-bottom:24px!important;margin:24px auto!important}}</style>`;
                let win = window.open('', '');
                win.document.write(`${style}${t}`);
                win.document.close();
                win.print();

            });
        })
    </script>
    
    
    @endpush
    @endsection