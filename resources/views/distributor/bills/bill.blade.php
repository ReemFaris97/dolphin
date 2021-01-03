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
                        <h3>شركة دلفن العالمية للتجازة المحدودة</h3>
                        <h3>Aljameel International Trading co.,ltd</h3>
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
                        <p>7/12/2020</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box1">
                        <div class="flexx">
                            <h4>فاتورة نوع</h4>
                            <h4>invoice type</h4>
                        </div>
                        <p>اجله</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box1">
                        <div class="flexx">
                            <h4>رقم</h4>
                            <h4>invoice no.</h4>
                        </div>
                        <p>Wm 7465</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box1">
                        <div class="flexx">
                            <h4>مدة السداد</h4>
                        </div>
                        <p>تستحق بتاريخ 7/12/2020</p>
                    </div>
                </div>
                <div class="col">
                    <div class="box1">
                        <div class="flexx">
                            <h4>أمر شراء العميل</h4>
                            <h4>Cust.P.O</h4>
                        </div>
                        <p></p>
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
                            <p>84764</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>اسم العميل</h4>
                                <h4>cust. name</h4>
                            </div>
                            <p>مصنع إبراهيم سليمان العثيم للتنمية والتكليف - دلفن</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>الرقم الضريبى للعميل</h4>
                                <h4>cust. vat no.</h4>
                            </div>
                            <p>1235635765</p>
                        </div>
                    </div>
                    <div class="flexx">
                        <div class="box1">
                            <div class="flexx">
                                <h4>العنوان</h4>
                                <h4>address</h4>
                            </div>
                            <p>المدينة الصناعية الثانية - بريدة</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>هاتف</h4>
                                <h4>phone</h4>
                            </div>
                            <p>9648474</p>
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
                                <h4>كود البائع</h4>
                                <h4>salesman code</h4>
                            </div>
                            <p>84764</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>رقم السائق</h4>
                                <h4>Deliver no.</h4>
                            </div>
                            <p>973574</p>
                            <div class="flexx">
                                <h4>رقم الشاحنة</h4>
                                <h4>Truck Id</h4>
                            </div>
                            <p>356s</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>نقطة الشحن</h4>
                                <h4>landing site</h4>
                            </div>
                            <p>القصيم</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>sales order</h4>
                                <h4>so-o87464</h4>
                            </div>
                            <div class="flexx">
                                <h4>delivery note</h4>
                                <h4>ملاحظاااتى هنا</h4>
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
                            <th>
                                <p>الإجمالى</p>
                                <p>total</p>
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
                                <p>كود الصنف</p>
                                <p>item code</p>
                            </th>
                            <th>
                                <p>كود المستودع</p>
                                <p>w.house code</p>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>96.00</td>
                            <td>14.40</td>
                            <td>15%</td>
                            <td>48.00</td>
                            <td>2.00</td>
                            <td>bag</td>
                            <td>
                                <p class="not_bold">إنشاء وزن 25 كجم</p>
                            </td>
                            <td>str-8356</td>
                            <td>n</td>
                        </tr>
                        <tr>
                            <td>96.00</td>
                            <td>14.40</td>
                            <td>15%</td>
                            <td>48.00</td>
                            <td>2.00</td>
                            <td>bag</td>
                            <td>
                                <p class="not_bold">إنشاء وزن 25 كجم</p>
                            </td>
                            <td>str-8356</td>
                            <td>n</td>
                        </tr>
                        <tr>
                            <td>96.00</td>
                            <td>14.40</td>
                            <td>15%</td>
                            <td>48.00</td>
                            <td>2.00</td>
                            <td>bag</td>
                            <td>
                                <p class="not_bold">إنشاء وزن 25 كجم</p>
                            </td>
                            <td>str-8356</td>
                            <td>n</td>
                        </tr>
                        <tr>
                            <td>96.00</td>
                            <td>14.40</td>
                            <td>15%</td>
                            <td>48.00</td>
                            <td>2.00</td>
                            <td>bag</td>
                            <td>
                                <p class="not_bold">إنشاء وزن 25 كجم</p>
                            </td>
                            <td>str-8356</td>
                            <td>n</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>176.00</th>
                            <th>
                                <p>total</p>
                                <p>المجموع</p>
                            </th>
                            <th colspan="9" rowspan="2">
                                <div class="box1">
                                    <p class="hint">
                                        أقر أنا الموقع على هذه الفاتورة إننى استلمت كافة البضائع المدونة بها بحالة سليمة
                                        وإنى سأقةم بسداد قيمتها وفى حالة عدم السداد تعتبر هذه الفاتورة بمثابة كمبيالة
                                        يحق للشركة المطالبة بقيمتها لدى محاكم التنفيذ
                                    </p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>-</th>
                            <th>
                                <p>discount</p>
                                <p>الخصم</p>
                            </th>
                        </tr>
                        <tr>
                            <th>26.40</th>
                            <th>
                                <p>vat</p>
                                <p>ضريبة القيمة المضافة</p>
                            </th>
                            <th colspan="9">
                                <div class="box1">
                                    <p class="hint">
                                        سياسة الاستبدال والاسترجاع , يتم الاستبدال والاسترجاع فى غضون خمسة عشر يوما من
                                        تاريخ الفاتورة بنفس الحالة المستلمة
                                    </p>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th>202.40</th>
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
                                    <p>فقط مائتان واثنان ريالان وأربعون هالة لا غير</p>
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
                                <h4>إدارة المبيعات</h4>
                                <h4>logistics dept.</h4>
                            </div>
                            <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>توقيع السائق</h4>
                                <h4>driver signature</h4>
                            </div>
                            <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز</p>
                        </div>
                        <div class="box1">
                            <div class="flexx">
                                <h4>الوزن الإجمالى</h4>
                                <h4>total weight</h4>
                            </div>
                            <p>KGM - 75</p>
                        </div>
                    </div>
                    <div class="col">
                        <div class="box1">
                            <div class="flexx">
                                <h4>إسم المستلم</h4>
                                <h4>receiver name</h4>
                            </div>
                            <p>reem faris</p>
                            <div class="flexx">
                                <h4>إسم توقيع</h4>
                                <h4>signature</h4>
                            </div>
                            <p>reem faris</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="flexx foot_bg">
                        <div>
                            <h5>المملكة العربية السعودية - الرقم الموحد 4563222</h5>
                            <h5>جدة - حى بترومين - شارع الحراج - بجوار دوار النجوم - هناك حقيقة مثبتة منذ زمن طويل وهي
                                أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز</h5>
                        </div>
                        <div>
                            <h5>الرقم الضريبى vat no.</h5>
                            <h5>435653</h5>
                            <h5>سجل تجارى c.r</h5>
                            <h5>445673</h5>
                        </div>
                        <div>
                            <h5> The Kingdom of Saudi Arabia - the standard number 4563222 </h5>
                            <h5> Jeddah - Petromin district - Al-Haraj Street - next to Al Nujoom Roundabout - There is
                                a long-established fact that the readable content of a page will distract the reader
                                from focusing </h5>
                        </div>
                    </div>
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
