<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>طباعة الفاتورة</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/assets/vendors/base/bill-print.css') }}">
</head>
<body>
<div class="m-portlet__body">
    <button type="button" id="print-all">طباعة</button>
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
                                    <h3>مؤسسة دلفن التجارية</h3>
                                    <h3>Dolphin Trading Corporation</h3>
                                    <div class="flexx">
                                    </div>
                                </div>
                                <div class="logo">
                                    <img
                                        src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}"
                                        alt="logo">
                                </div>
                            </div>
                        </header>
                        <!---- columns -->
                        <div class="row">
                            <div class="col">
                                <div class="box1">
                                    <div class="flexx">
                                        <h4>التاريخ</h4>
                                        <p>{{$sale->date}}</p>
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
                                        <p>{{$sale->bill_num}} </p>
                                        <h4>invoice no.</h4>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!---->
                        <div class="row">
                            <div class="box1">
                                <div class="flexx">
                              {{--      <div class="box1 third">
                                        <div class="flexx">
                                            <h4>كود العميل</h4>
                                            <p>{!!optional(optional($sale->route_trip)->client)->code !!}</p>
                                            <h4>cust. code</h4>
                                        </div>

                                    </div>--}}
                                    <div class="box1 third">
                                        <div class="flexx">
                                            <h4>اسم العميل</h4>
                                            <p>{{@$sale->client->name }}</p>
                                            <h4>cust. name</h4>
                                        </div>

                                    </div>
                                    <div class="box1 third">
                                        <div class="flexx ">
                                            <h4>الرقم الضريبى للعميل</h4>
                                            <p>{{@$sale->client->tax_number }}</p>
                                            <h4>Cust. vat No.</h4>
                                        </div>

                                    </div>
                                </div>
                                <div class="flexx">
                                    <div class="box1  third-quater">
                                        <div class="flexx">
                                            <h4>العنوان</h4>
                                            <p>{{@$sale->client->address}}</p>
                                            <h4>address</h4>
                                        </div>


                                    </div>
                                    <div class="box1 quater">
                                        <div class="flexx">
                                            <h4>هاتف</h4>
                                            <p>{{@$sale->client->phone}}</p>
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
                                            <h4>مدخل الفاتوره</h4>
                                            <p>{{@$sale->user->name}} </p>
                                            <h4>Representative Name</h4>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--- table---->
                        <div class="bg_logo">
                            <table dir="ltr" class="the_table">
                                <thead>
                                <tr>
                                    <th class="col9">
                                        <p>الإجمالى <br> (بدون ضريبة)</p>
                                        <p></p>
                                    </th>
                                    <th>
                                        <p>ضريبة <br> القيمة المضافة</p>
                                        <p>vat</p>
                                    </th>
                                    <th>
                                        <p>السعر بدون ضريبة<br> القيمة المضافة</p>
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
                                @foreach($sale->items as $value)
                                    <tr>
                                        <td>{{ (double)$value->price * $value->quantity -($value->price * $value->quantity)*($value->tax)/100}}</td>
                                        <td>

                                            {{ (double)($value->price * $value->quantity)-($value->price * $value->quantity)*(100-$value->tax)/100 }}
                                        </td>
                                        <td>{{ $value->price }}</td>
                                        <td>{{ $value->quantity }}</td>
                                        <td> {{$value->unit?$value->unit->name:$value->product->main_unit}}
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
                    </div>
                    <div class="row">
                        <table class="the_table">
                            <tfoot>
                            @php($tax_percent=(float)(getsetting('general_taxs')) )
                            @php($tax_amount= $sale->amount -($sale->amount *(100-$tax_percent)/100))
                            @php($total=$sale->amount )
                            <tr>
                                <th>{{(float) $sale->product_total()-$tax_amount}}</th>
                                <th colspan="4">
                                    <div class="flexx">
                                        <p>total</p>
                                        <p>الإجمالى (بدون ضريبة)</p>
                                    </div>

                                </th>
                                <th style="width: 95px;" rowspan="3">

                                    {!! QrCode::size(100)->generate(
                                 url('/api/distributor/bills/print_bill/' .  encrypt($sale->id))
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
                                <th>{{$sale->product_total()}}</th>
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
                                        <p>{{ $sale->CashArabic($sale->amount)[0] }}
                                            ريال
                                            {{ $sale->CashArabic($sale->amount)[1] ??''}}
                                            @if(($sale->amount-(int)$sale->amount)!=0)
                                                و
                                            {{$sale->CashArabic($sale->amount-(int)$sale->amount)}}
                                                هللة

                                            @endif
                                            لاغير
                                        </p>
                                    </div>
                                </th>

                            </tr>
                            </tfoot>
                        </table>

                        <div class="col-3 box1 flexx" style="width:25%">
                            <p style="text-align:center;">المدفوع كاش</p>
                            <p style="text-align:center;">{{round($sale->cash,2)}}</p>
                        </div>
                        <div class="col-3 box1 flexx" style="width:25%">
                            <p style="text-align:center;">المدفوع شبكة</p>
                            <p style="text-align:center;">{{round($sale->visa,2)}}</p>
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


                    <!--- footer -->
                    <footer>

                        <div class="row">
                            <div class="flexx foot_bg">
                                <div>
                                    <h5>المملكة العربية السعودية - القصيم - بريدة - شارع الصباخ
                                    </h5>
                                    <div class="sp-arrownd">
                                        <h5>الهاتف</h5>
                                        <h5>0163231301</h5>
                                    </div>
                                    {{--    <div class="sp-arrownd">
                                            <h5>الفاكس</h5>
                                            <h5>0163231301</h5>
                                        </div>--}}
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
</div>

<script src="{!! asset('dashboard/assets/vendors/base/jquery-2.1.4.min.js') !!}"></script>
<script>
    $(document).ready(function () {
        $("#print-all").on('click', function () {
            window.print();

            // let t = document.getElementById("print_this").innerHTML;
            // let style = ``;
            // let win = window.open('', '');
            // win.document.write(`${style}${t}`);
            // win.document.close();
            // setTimeout(() => {win.print()}, 100);
        });
        // window.print();

    })
</script>

</body>
</html>
