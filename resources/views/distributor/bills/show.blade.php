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
    <div id="print_small" style="display: block !important;">
        <div id="myDivToPrintsmall" style="display: block !important;">
            <div style="display:flex; justify-content:space-between; padding: 10px 20px 0;">
                <h3 style="margin: auto 0;">مصنع إبراهيم سليمان العثيم للتعبئة و التغليف</h3>
                <div class="logo">
                    <img src="{!! asset('dashboard/assets/demo/demo12/media/img/logo/logo-black.png')!!}" alt="logo">
                </div>
            </div>
            <div class="details-container" style="margin-top:10px;">
                <p>العنوان</p>
                <p>المملكة العربية السعودية - القصيم - المدينة الصناعية الثانية بالقصيم</p>
            </div>
            <div class="details-container">
                <p>الهاتف</p>
                <p>0163231301</p>
            </div>
            <div class="details-container">
                <p>الفاكس</p>
                <p>0163231301</p>
            </div>
            <div class="details-container">
                <p>الرقم الضريبى</p>
                <p>300420708200003</p>
            </div>
            <div class="details-container">
                <p>سجل تجارى</p>
                <p>1131021506</p>
            </div>
            <p>
                ........................................................................................................</p>
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
            <p>
                ........................................................................................................</p>
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
                        <td>{{ round($value->price * $value->quantity,3) }}</td>
                        <td>{{round( ($value->price * ((float) getsetting('general_taxs')??0)/100),3)}}</td>

                        <td>{{ round($value->price,3) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <p>
                ........................................................................................................</p>
            <div class="details-container">
                <p>الإجمالى (بدون ضريبة)</p>
                <p>{{(float) $bill->product_total()}}</p>
            </div>
            <div class="details-container">
                <p>قيمة القيمة المضافة</p>
                <p>{{$tax_amount}}</p>
            </div>
            <div class="details-container">
                <p>اجمالى الفاتورة</p>
                <p>{{$total}}</p>
            </div>
            <div class="details-container">
                <p>المبلغ كتابة</p>
                <p>
                    {{\Alkoumi\LaravelArabicTafqeet\Tafqeet::inArabic($total)}}
                </p>
            </div>
            <div class="details-container">
                <p>المدفوع كاش</p>
                <p>{{round($bill->cash,2)}}</p>
            </div>
            <div class="details-container">
                <p>المدفوع شبكة</p>
                <p>{{round($bill->visa,2)}}</p>
            </div>
            <div style="margin-top:20px">
                {!! QrCode::size(250)->generate(
                                 url('/api/distributor/bills/print_bill/' .  encrypt($bill->id))
                                        ); !!}
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
