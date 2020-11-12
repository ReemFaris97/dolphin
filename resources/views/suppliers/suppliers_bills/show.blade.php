@extends('suppliers.layouts.app')
@section('title')تفاصيل الفاتورة
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['مرتجع'=>'/suppliers-bills','تفاصيل'=>'/suppliers-bills/show/'.$bill->id])
@includeWhen(isset($breadcrumbs),'suppliers.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
    {{--    <div class="m-section__content">--}}
    {{--        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">--}}
    {{--            <div class="m-demo__preview  m-demo__preview--btn">--}}
    {{--                @if(auth()->user()->hasPermissionTo('insert_numbers')&optional(optional($clause->logs->last())->created_at)->toDateString()!=date('Y-m-d'))--}}
    {{--                    <a href="{{route('admin.clauses.getAddLog',$clause->id)}}" style="color: #FFF;" type="button" class="btn btn-primary">تحديث حالة</a>--}}
    {{--                @endif--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-portlet__body">

                <div class="col-xs-4">
                    <h5>إسم المستخدم</h5>
                    <h3>{{$bill->user->name}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>إسم المورد</h5>
                    <h3>{{$bill->supplier->name}}</h3>
                </div>
                <div class="col-xs-4">
                    <h5>رقم الفاتورة</h5>
                    <h3>{{$bill->bill_number}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>تاريخ الفاتورة</h5>
                    <h3>{{$bill->date}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>المبلغ المدفوع</h5>
                    <h3>
                        {{$bill->amount_paid}}
                    </h3>
                </div>

                <div class="col-xs-4">
                    <h5>المبلغ المتبقي</h5>
                    <h3>
                        {{$bill->amount_rest}}
                    </h3>
                </div>

                    <div class="col-xs-4">
                    <h5>قيمة الضريبة</h5>
                    <h3>
                        {{$bill->vat}}
                    </h3>
                </div>

                <div class="col-xs-4">
                    <h5>إجمالي الفاتورة</h5>
                    <h3>{{$bill->total()}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>نوع السداد</h5>
                    <h3>
                        @switch($bill->payment_method)
                            @case('cash') كاش @break
                            @case('bank_transfer') تحويل بنكي @break
                            @case('check') شيك @break
                        @endswitch
                    </h3>
                </div>

                @if($bill->payment_method == 'bank_transfer')
                    <div class="col-xs-4">
                        <h5>تاريخ التحويل</h5>
                        <h3>
                            {{$bill->transfer_date}}
                        </h3>
                    </div>

                    <div class="col-xs-4">
                        <h5>رقم التحويل</h5>
                        <h3>
                            {{$bill->transfer_number}}
                        </h3>
                    </div>

                @endif

                @if($bill->payment_method == 'check')
                    <div class="col-xs-4">
                        <h5>إسم البنك</h5>
                        <h3>
                            {{$bill->bank_name}}
                        </h3>
                    </div>

                    <div class="col-xs-4">
                        <h5>رقم الشيك</h5>
                        <h3>
                            {{$bill->check_number}}
                        </h3>
                    </div>

                    <div class="col-xs-4">
                        <h5>تاريخ الشيك</h5>
                        <h3>
                            {{$bill->check_date}}
                        </h3>
                    </div>

                @endif

            </div>
        </div>
    </div>
    {{--*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*--}}
    <div class="m-portlet__head-tools">
        <h3>اصناف الفاتورة</h3>
    </div>

    <table class="table table-striped- table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th>#</th>
            <th>المنتج</th>
            <th>الكمية</th>
            <th>السعر</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bill->products as $product)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$product->product->name}}</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->price}}</td>
            </tr>
        @endforeach

        </tbody>

    </table>


    {{--    /*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/*/--}}


@endsection


@section('scripts')
@endsection
