<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href={!! asset('dashboard/assets/css/main.css') !!}>
    <link href="{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}" rel="stylesheet" type="text/css" />

</head>

<body>
<div class="container">
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
                                <h3>مصنع إبراهيم العثيم للتعبئة والتغليف</h3>
                                <h3>Ibrahim Al-othiem for Packaging</h3>
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
<!--
                                <div class="box1">
                                    <div class="flexx">
                                        <h4>كود العميل</h4>
                                        <h4>cust. code</h4>
                                    </div>
                                    <p>{!!optional(optional($bill->route_trip)->client)->code !!}</p>
                                </div>
-->
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
<!--
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
-->
                        </div>
                    </div>
                <!---->
                <div class="row">
                    <div class="box1">
                        <div class="flexx">
                           
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
                             <div class="box1">
                                <div class="flexx">
                                    <h4>جوال المندوب</h4>
                                    <h4>Representative no.</h4>
                                </div>
                                <p>{!! optional($bill->route_trip)->route->user->phone ??''!!}</p>
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
<!--
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
-->
                    <div class="row">
                        <div class="flexx foot_bg">
                            <div>
                                <h5>المملكة العربية السعودية - القصيم - بريدة - المدينة الصناعية الثانية
                                </h5>
                                <h5>الهاتف</h5>
                                <h5>92009814</h5>
                                <h5>الفاكس</h5>
                                <h5>0163231301</h5>
                            </div>
                            <div>
                                <h5>الإدارة </h5>
                                <h5>0553030957 - 0553030269</h5>
                                <h5>الرقم الضريبى vat no.</h5>
                                <h5>300420708200003</h5>
                                <h5>سجل تجارى c.r</h5>
                                <h5>1131021506</h5>
                            </div>
<!--
                            <div>
                                <h5> Kingdom of Saudi Arabia - Al-Qassim - Buraidah - 2nd Industrial City</h5>
                            </div>
-->
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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('print-all').addEventListener('click', () => {
                    var mywindow = window.open('', 'PRINT');
                    mywindow.document.write('<html>');
                    mywindow.document.write("<link href=\"{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}\" rel=\"icon\"><link href=\"{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}\" rel=\"stylesheet\">")
                    mywindow.document.write('<body >');
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

</body>

</html>
