@extends('AccountingSystem.layouts.master')
@section('title', 'تقرير حركة صنف')
@section('parent_title', 'التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
    <style>
        .filter {
            margin-bottom: 30px;
        }

    </style>
@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير حركة صنف</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <section class="filter">
                <div class="yurSections">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['method'=>'get']) !!}
                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select('company_id', companies(), null, ['class' => 'selectpicker form-control inline-control', 'placeholder' => 'اختر الشركة', 'data-live-search' => 'true', 'id' => 'company_id']) !!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                <select name="branch_id" data-live-search="true"
                                    class="selectpicker form-control inline-control" id="branch_id">
                                    <option value="" selected="" disabled="">اختر الفرع</option>
                                    @foreach (branches() as $index => $branch)
                                        <option value="{{ $index }}"
                                            {{ $index == request('branch_id') ? 'selected' : '' }}>{{ $branch }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label> المستودع </label>
                                <select name="store_id" data-live-search="true" id="store_id"
                                    class="selectpicker form-control inline-control">
                                    <option selected disabled>اختر المستودع</option>
                                    @foreach (allstores() as $store)
                                        <option value="{{ $index }}"
                                            {{ $index == request('store_id') ? 'selected' : '' }}>{{ $store }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الصنف </label>
                                {!! Form::select('product_id', [], null, ['class' => 'selectID2 form-control inline-control', 'placeholder' => 'اختر الصنف', 'data-live-search' => 'true']) !!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> نوع الحركة </label>
                                {!! Form::select('type', ['purchases' => 'مشتريات', 'sales' => 'مبيعات', 'damaged' => 'تالف', 'expired' => 'منتهى الصلاحيه'], null, ['class' => 'selectpicker form-control inline-control', 'placeholder' => 'اختر  نوع  الحركة']) !!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> من </label>
                                {!! Form::date('from', null, ['class' => 'form-control', 'placeholder' => 'من', 'id' => 'example-date']) !!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الى </label>
                                {!! Form::date('to', null, ['class' => 'form-control', 'placeholder' => 'الى', 'id' => 'example-date']) !!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> </label>
                                <input type="submit" value="بحث" class="btn btn-success col-sm-3">
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>
            {{-- التفاصيل (تاريخ اليوم – الكمية – السعر - نوع الحركة – بيان الحركة – الرصيد بعد العملية – الشركة – الفرع – المستودع - المستخدم – وقت العملية). --}}

            <div id="print-window">

                <table class="table datatable-button-init-basic">
                  <thead>
                         <tr>
                            <th>#</th>
                            <th> تاريخ اليوم </th>
                            <th> الكمية </th>
                            <th> السعر </th>
                            <th> نوع الحركة </th>
                            <th>بيان الحركة</th>
                            {{-- <th> الرصيد بعد العمليه</th> --}}
                            {{-- <th>الشركة  </th> --}}
                            <th> الفرع</th>
                            <th> المستودع</th>
                            <th> المستخدم</th>
                            <th>تاريخ العمليه</th>
                        </tr>
                    </thead>
                    <tbody>



                                @php($p_quantities = 0)
                                @php($p_price = 0)
                                @foreach ($purchases as $row)
                                    @php($p_quantities += $row->quantity)
                                    @php($p_price += $row->price)
                                    <tr>
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>{!! \Carbon\Carbon::now() !!}</td>
                                        <td>{!! $row->quantity ?? 0 !!}</td>
                                        <td>{!! $row->price ?? 0 !!}</td>
                                        <td>مشتريات</td>
                                        <td>
                                            <a href="{{ route('accounting.purchases.show', $row->purchase_id) }}">
                                                {{ $row->purchase_id }}</a>
                                        </td>
                                        <?php
                                        $store_product = \App\Models\AccountingSystem\AccountingProductStore::where('product_id', $row->product?->id)
                                            ->where('store_id', $row?->purchase?->store_id)
                                            ->first();
                                        ?>
                                        {{-- <td>{!! $store_product->quantity ?? 0 !!}</td> --}}
                                        <td>{!! $row->purchase?->branch?->name !!}</td>
                                        <td>{!! $row->purchase?->store?->ar_name !!}</td>
                                        <td>{!! $row->purchase?->user?->name !!}</td>
                                        <td>{!! $row->created_at !!}</td>
                                    </tr>
                                @endforeach
                                @php($s_quantities = 0)
                                @php($s_price = 0)
                                @foreach ($sales as $row)
                                    @php($s_quantities += $row->quantity)
                                    @php($s_price += $row->price)
                                    <tr style="background-color: #e5ffd7;">
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>{!! \Carbon\Carbon::now() !!}</td>
                                        <td>{!! $row->quantity ?? 0 !!}</td>
                                        <td>{!! $row->price ?? 0 !!}</td>
                                        <td>مبيعات</td>
                                        <td><a
                                                href="{{ route('accounting.sales.show', $row->sale_id) }}">{{ $row->sale_id }}</a>
                                        </td>

                                        <?php
                                        $store_product = \App\Models\AccountingSystem\AccountingProductStore::where('product_id', $row->product?->id)
                                            ->where('store_id', $row->sale?->store_id)
                                            ->first(); ?>
                                        {{-- <td>{!! $store_product ? $store_product->quantity : 0 !!}</td> --}}
                                        <td>{!! $row?->sale?->branch?->name !!}</td>
                                        <td>{!! $row?->sale?->store?->ar_name !!}</td>
                                        <td>{!! $row?->sale?->user?->name !!}</td>
                                        <td>{!! $row->created_at !!}</td>
                                    </tr>
                                @endforeach


                                @php($d_quantities = 0)
                                @php($d_price = 0)
                                @foreach ($damages as $row)
                                    @php($d_quantities += $row->quantity)
                                    @php($d_price += $row->price)
                                    <tr  style="background-color: #ffd7d7;">
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>{!! \Carbon\Carbon::now() !!}</td>
                                        <td>{!! $row->quantity ?? 0 !!}</td>
                                        <td>{!! $row->price ?? 0 !!}</td>
                                        <td>توالف</td>
                                        <td>--</td>
                                        <?php
                                        $store_product = \App\Models\AccountingSystem\AccountingProductStore::where('product_id', $row?->product?->id)
                                            ->where('store_id', $row?->damage?->store_id)
                                            ->first(); ?>

                                        {{-- <td>{!! $store_product ? $store_product->quantity : 0 !!}</td> --}}
                                        <td>{!! $row->damage?->branch?->name !!}</td>
                                        <td>{!! $row->damage?->store?->ar_name !!}</td>
                                        <td>{!! $row->damage?->user?->name !!}</td>
                                        <td>{!! $row->created_at !!}</td>
                                    </tr>

                                @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">الاجمالى </td>
                            <td>{{ $p_quantities-$s_quantities -$d_quantities }}</td>
                            {{-- <td>{{ $p_price-$s_price-$d_price }}</td> --}}
                            <td colspan="3"></td>

                            <td colspan="4"></td>
                        </tr>
                    </tfoot>

                </table>
<div>
<table class="table table-border table-responsive">
<thead>
<tr>
<th>
البيان
</th>
<th>
العدد
</th>
<th>
اجمالى المبالغ
</th>
<th>
اجمالى الكميات
</th>
</tr>


</thead>

<tbody>
<tr>
<td>
اجمالى المشتريات
</td>
<td>
{{$purchases->count()}}
</td>
<td>
{{$p_price}}
</td>
<td>
{{$p_quantities}}
</td>
</tr>
<tr>
        <td>
             اجمالى المبيعات
        </td>
    <td>
    {{$sales->count()}}
    </td>
    <td>
{{$s_price}}
</td>
<td>
{{$s_quantities}}
</td>
</tr>
</tbody>
</table>

</div>
            </div>
        </div>
        <div class="row print-wrapper">
            <button class="btn btn-success" id="print-all">طباعة</button>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('admin/assets/js/get_product_from_store_form_company.js') }}"></script>
    <script>
        $('.selectID2').select2({
            ajax: {
                delay: 250,
                url: "/accounting/productsAjex/" + store_id,
                data: function(params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                },


                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    /*
                            *     var productBarCode = selectedProduct.data('bar-code');
                    var productPrice = Number(selectedProduct.data('price'));
                    var priceHasTax = selectedProduct.data('price-has-tax');
                    var totalTaxes = selectedProduct.data('total-taxes');
                    var mainUnit = selectedProduct.data('main-unit');
                    var productUnits = selectedProduct.data('subunits');*/
                    results = data.data.data;
                    return {
                        results: results,
                        pagination: {
                            more: data.has_more
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a repository',
            minimumInputLength: 1,
            // templateResult: formatRepo,
            // templateSelection: formatRepoSelection,
            delay: 250
        });
    </script>
@stop
