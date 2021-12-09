<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>{{$bill->client_name}}</title>
    <link rel="icon" href="img/logo.png">
    {{--    <link rel="stylesheet" href={!! asset('dashboard/assets/css/main.css') !!}>--}}
    <link href="{!! asset('dashboard/assets/vendors/base/bill-print.css') !!}" rel="stylesheet" type="text/css" />
    <link href="{!! asset('dashboard/assets/vendors/base/bill-print-11cm.css') !!}" rel="stylesheet" type="text/css"/>

    <style>
        * {
            font-family: 'Swiss 721 Medium Italic' !important;
             font-size:25px;

        }

        table, tr, td, th, tbody, thead, tfoot {
            page-break-inside: avoid !important;
        }
    </style>
</head>

<body style="page-break-inside: avoid !important;">
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
        @php($tax=getsetting('general_taxs'))
        @php($tax_percent=(float)(getsetting('general_taxs')) /100)
        @php($tax_amount=$bill->product_total()- round($bill->product_total() * 100/ (100+$tax),2))
        @php($total=$bill->product_total() )

        <div id="print_small" style="display: block !important;">
            <div id="myDivToPrintsmall" style="display: block !important;">
                <div style="display:flex; justify-content:space-between; padding: 10px 20px 0;">
                    <h3 style="margin: auto 0;">مصنع إبراهيم سليمان العثيم للتعبئة و التغليف</h3>
                    <div class="logo">
                        <img src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}"
                             alt="logo">
                    </div>
                </div>

                <table>
                    <tbody>
                    <tr>
                        <td> <p style="margin: 0px 20px">العنوان</p></td>
                        <td colspan="3"> <p style="margin: 0px 20px">المملكة العربية السعودية - القصيم - المدينة الصناعية الثانية بالقصيم</p></td>
                    </tr>
                    <tr>

                        <td> <p style="margin: 0px 20px">الهاتف</p></td>
                        <td> <p style="margin: 0px 20px">0163231301</p></td>
                    </tr>
                    <tr>

                        <td> <p style="margin: 0px 20px">الفاكس</p></td>
                        <td> <p style="margin: 0px 20px">0163231301</p></td>
                    </tr>
                    <tr>

                        <td> <p style="margin: 0px 20px">الرقم الضريبى</p></td>
                        <td> <p style="margin: 0px 20px">300420708200003</p></td>
                    </tr>
                    <tr>

                        <td> <p style="margin: 0px 20px">سجل تجارى</p></td>
                        <td> <p style="margin: 0px 20px">1131021506</p></td>
                    </tr>
                    </tbody>
                </table>
                <p>........................................................................................................</p>
                <table>
                    <tbody>
                    <tr>
                        <td> <p style="margin: 0px 20px">التاريخ</p></td>
                        <td> <p style="margin: 0px 20px">{{$bill->created_at}}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">نوع الفاتورة</p></td>
                        <td> <p style="margin: 0px 20px">فاتورة نقدية</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">رقم الفاتورة</p></td>
                        <td> <p style="margin: 0px 20px">{{$bill->invoice_number}}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">كود العميل</p></td>
                        <td> <p style="margin: 0px 20px">{{optional(optional($bill->route_trip)->client)->code}}</p></td>
                    </tr>

                    <tr>
                        <td> <p style="margin: 0px 20px">اسم العميل</p></td>
                        <td> <p style="margin: 0px 20px">{{optional(optional($bill->route_trip)->client)->name}}</p></td>
                    </tr>


                    <tr>
                        <td> <p style="margin: 0px 20px">الرقم الضريبي للعميل</p></td>
                        <td> <p style="margin: 0px 20px">{{optional(optional($bill->route_trip)->client)->tax_number}}</p></td>
                    </tr>

                    <tr>
                        <td> <p style="margin: 0px 20px">العنوان</p></td>
                        <td> <p style="margin: 0px 20px">{{optional(optional($bill->route_trip)->client)->address}}</p></td>
                    </tr>

                    <tr>
                        <td> <p style="margin: 0px 20px">هاتف</p></td>
                        <td> <p style="margin: 0px 20px">{{optional(optional($bill->route_trip)->client)->phone}}</p></td>
                    </tr>

                    <tr>
                        <td> <p style="margin: 0px 20px">جوال المندوب</p></td>
                        <td> <p style="margin: 0px 20px">{{optional($bill->route_trip)->route->user->phone ??''}}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">اسم المندوب</p></td>
                        <td> <p style="margin: 0px 20px">{{optional($bill->route_trip)->route->user->name ??''}}</p></td>
                    </tr>

                    </tbody>
                </table>

                <div style="page-break-after: always"></div>
                <p>
                    ........................................................................................................</p>
                <table>
                    <thead>
                    <tr>
                        <th><p style="margin: 0px 15px">م</p></th>
                        <th><p style="margin: 0px 15px">اسم الصنف</p></th>
                        <th><p style="margin: 0px 15px">الوحدة</p></th>
                        <th><p style="margin: 0px 15px">الكمية</p></th>
                        <th><p style="margin: 0px 15px">السعر</p></th>
                        <th><p style="margin: 0px 15px">ضريبة</p></th>
                        <th><p style="margin: 0px 15px">المبلغ</p></th>
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
                            <td>{{ round($value->price,3) }}</td>
                            <td>{{round( ($value->price - ($value->price * 100 / ((int)$tax+100))),3)}}</td>
                            <td>{{ round($value->price * $value->quantity,3) }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p>
                    ........................................................................................................</p>
                <table>
                    <tbody>
                    <tr>
                        <td> <p style="margin: 0px 20px">الإجمالى (بدون ضريبة)</p></td>
                        <td> <p style="margin: 0px 20px">{{round( $bill->product_total() * 100/(100+$tax),3)}}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">قيمة القيمة المضافة</p></td>
                        <td> <p style="margin: 0px 20px">{{$tax_amount}}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">اجمالى الفاتورة</p></td>
                        <td> <p style="margin: 0px 20px">{{ $bill->product_total() }}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">المبلغ كتابة</p></td>
                        <td> <p style="margin: 0px 20px">{{\Alkoumi\LaravelArabicTafqeet\Tafqeet::inArabic($total)}}</p></td>
                    </tr>

                    <tr>
                        <td> <p style="margin: 0px 20px">المدفوع كاش</p></td>
                        <td> <p style="margin: 0px 20px">{{round($bill->cash,2)}}</p></td>
                    </tr>
                    <tr>
                        <td> <p style="margin: 0px 20px">المدفوع شبكة</p></td>
                        <td> <p style="margin: 0px 20px">{{round($bill->visa,2)}}</p></td>
                    </tr>

                    </tbody>
                </table>


                <div>

                    {!! QrCode::size(350)->generate(
                                \Salla\ZATCA\GenerateQrCode::fromArray([
                             new Salla\ZATCA\Tags\Seller('مؤسسة دلفن التجارية'), // seller name
                             new Salla\ZATCA\Tags\TaxNumber('300420708200003'), // seller tax number
                             new Salla\ZATCA\Tags\InvoiceDate($bill->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                             new Salla\ZATCA\Tags\InvoiceTotalAmount($total), // invoice total amount
                             new Salla\ZATCA\Tags\InvoiceTaxAmount($tax_amount) // invoice tax amount
                         ])->toBase64()); !!}
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
