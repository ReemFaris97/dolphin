@extends('AccountingSystem.layouts.master')
@section('title', 'عرض الاصناف')
@section('parent_title', 'إدارة الاصناف')
@section('action', URL::route('accounting.products.index'))
@section('styles')
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض بيانات المنتج {!! $product->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="custom-tabs">

            <div class="all-customed-singl-sections">
                <div class="row customed-singl-section">
                    <h3>بيانات المكان</h3>
                    <div class="form-group col-md-3 pull-left" id="store_id">
                        <label> اسم المستودع </label>
                        {!! optional($product->store)->ar_name !!}

                    </div>
                    <div class="form-group col-md-3 pull-left" id="store_id">
                        <label> اسم الشركة التابع لها المستودع </label>
                        {!! optional($product->store)->model->name ?? '' !!}

                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> اسم الخلية </label>

                        {!! optional($product->cell_product)->name !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> اسم العمود </label>

                        {!! optional(optional($product->cell_product)->column)->name !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> اسم الوجه </label>

                        {!! optional(optional(optional($product->cell_product)->column)->face)->name !!}
                    </div>
                </div>

                <div class="row customed-singl-section">
                    <h3>بيانات المنتج</h3>
                    <div class="form-group col-md-3 pull-left">
                        <label>اسم المنتج </label>
                        {!! $product->name ?? '' !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> اسم التصنيف </label>
                        {!! optional($product->category)->ar_name !!}
                    </div>
                    <div class="form-group col-md-6 pull-left">
                        <label>وصف المنتج </label>
                        {!! $product->description !!}
                    </div>
                </div>
                <div class="row customed-singl-section">
                    <h3>بيانات البيع</h3>
                    <div class="form-group col-md-3 pull-left">
                        <label>التفعيل </label>
                        @if ($product->is_active == '1')
                            مفعل
                        @else
                            غير مغعل
                        @endif
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label>الباركود </label>
                       @foreach($product->bar_code as $barcode)
                           {!! $barcode !!}
@if( ! $loop->last) - @endif
                           @endforeach
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label>سعر البيع </label>
                        {!! $product->selling_price !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label>سعر الشراء </label>
                        {!! $product->purchasing_price !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label>الحد الادنى من الكمية </label>
                        {!! $product->min_quantity !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> الحد الاقصى من الكمية </label>
                        {!! $product->max_quantity !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> الكمية </label>
                        {!! $product->quantity !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label>الوحده الاساسية </label>
                        {!! $product->main_unit !!}
                    </div>
                    <!--units table-->
                    <table id="unitstable" class="table datatable-button-init-basic all">
                        <thead>
                            <tr>
                                <th> اسم الوحدة </th>
                                <th> الباركود</th>
                                <th>النسبة من الوحدة الاساسية</th>
                                <th> سعر البيع </th>
                                <th> سعر الشراء </th>
                                <th> الكميه </th>
                            </tr>
                        </thead>
                        <tbody class="add-taxs">
                            @foreach ($units as $unit)
                                <tr>
                                    <td>{!! $unit->name !!}</td>
                                    <td>{!! $unit->bar_code !!}</td>
                                    <td>{!! $unit->main_unit_present !!}</td>
                                    <td>{!! $unit->selling_price !!}</td>
                                    <td>{!! $unit->purchasing_price !!}</td>
                                    <td>{!! $unit->quantity !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row customed-singl-section">
                    <h3>مواصفات أخرى (إختياري)</h3>
                    <div class="form-group col-md-3 pull-left">
                        <label> الحجم </label>
                        {!! $product->size !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> اللون </label>
                        {!! $product->color !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> الارتفاع </label>
                        {!! $product->height !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">

                        <label> العرض </label>
                        {!! $product->width !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> تاريخ الانتهاء </label>
                        {!! $product->expired_at !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label> مدة التنبيه </label>
                        {!! $product->alert_duration !!}
                    </div>
                    <div class="form-group col-md-3 pull-left">
                        <label>عدد أيام فترة الركود</label>
                        {!! $product->num_days_recession !!}
                    </div>
                </div>
                <div class="row customed-singl-section">
                    <h3>العروض والخصومات</h3>
                    <!--discounts table-->
                    <table id="discountTable" class="table datatable-button-init-basic all">
                        <thead>
                            <tr>
                                <th> نوع الخصم</th>
                                <th> النسبة</th>
                            </tr>
                        </thead>
                        <tbody class="add-discounts">
                            @foreach ($discounts as $discount)
                                <tr>
                                    @if ($discount->discount_type == 'quantity')
                                        <td><label>كميه</label> </td>
                                    @elseif($discount->discount_type=="percent")
                                        <td><label>نسبة</label> </td>
                                    @endif
                                    <td>{!! $discount->percent !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- end table-->
                </div>
                <div class="row customed-singl-section">
                    <h3>الضريبه المضافة</h3>
                    <!--taxs table-->
                    <table id="taxsTable" class="table datatable-button-init-basic all">
                        <thead>
                            <tr>
                                <th> اسم الشريحة</th>
                                <th> النسبة</th>
                            </tr>
                        </thead>
                        <tbody class="add-taxs">
                            @foreach ($taxs as $tax)
                                <tr>
                                    <td>{!! @$tax->Taxband->name !!}</td>
                                    <td>{!! @$tax->Taxband->percent !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center col-md-12 m--margin-bottom-5">
                    <div class="text-center" style="margin-bottom:30px">
                        <a href="{{ route('accounting.products.edit', $product->id) }}" data-toggle="tooltip"
                            data-original-title="تعديل" class="btn btn-success"> تعديل المنتج </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
