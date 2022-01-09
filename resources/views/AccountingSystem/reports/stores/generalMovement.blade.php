@extends('AccountingSystem.layouts.master')
@section('title', 'تقرير اجمالى تحركات اصناف')
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
            <h5 class="panel-title">تقرير اجمالى تحركات اصناف</h5>
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
                           {{Form::open(['method'=>"get"])}}
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
                            <th> المنتج </th>
                            <th> اجمالى  فواتير المبيعات </th>
                            <th> اجمالى كمية المبيعات </th>
                            <th> اجمالى فواتير المشتريات </th>
                            <th>اجمالى كمية المشتريات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php($total_items_count=0)
                        @php($total_items_quantity=0)
                        @php($total_purchase_count=0)
                        @php($total_purchase_quantity=0)
                                @foreach ($accounting_products as $product)
                                    <tr>
                                        <td>{!! $loop->iteration !!}</td>
                                        <td>{!! $product->name !!}</td>
                                        
                                        <td>
                                        {!! $product->items->count() !!}
                                        @php($total_items_count+=$product->items->count()  )
                                        </td>
                                        <td>
                                        {!! $product->items->sum('quantity') !!}</td>
                                           @php($total_items_quantity+=$product->items->sum('quantity')  )
                                        <td>
                                        {!! $product->purchase->count() !!}
                                           @php($total_purchase_count+=$product->purchase->count()  )
                                        
                                        </td>
                                        <td>
                                        {!! $product->purchase->sum('quantity') !!}
                                                                   
                                         @php($total_purchase_quantity+=$product->purchase->sum('quantity')  )
                                        </td>
                                      </tr>
                                    
                                @endforeach
                        
                    </tbody>
                    
                    <tfooter >
                                    <tr style="background-color: #f5f5f5;">
                                        <td>---</td>
                                        <td>الاجمالى</td>
                                        
                                        <td>
                                        {!! $total_items_count !!}
                                        </td>
                                        <td>
                                        {!! $total_items_quantity !!}</td>
                                        <td>
                                        {!! $total_purchase_count!!}
                                        
                                        </td>
                                        <td>
                                        {!! $total_purchase_quantity !!}
                                                                  
                                        </td>
                    
                                    </tr>

                    </tfooter>
                </table>
       
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
