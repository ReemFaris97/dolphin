@extends('AccountingSystem.layouts.master')
@section('title','تقرير  المبيعات معدل  ')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}
@section('styles')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <style>
        .filter {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير المبيعات معدل</h5>
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
                            <form action="" method="get" accept-charset="utf-8">
                                <div class="form-group col-sm-3">
                                    <label> التصنيفات </label>
                                    {!! Form::select('category_id',\App\Models\AccountingSystem\AccountingProductCategory::pluck('ar_name','id'),null,
['class'=>'form-control inline-control','id'=>'categories','placeholder'=>'اختر']) !!}
                                </div>

                                <div class="form-group col-sm-3">
                                    <label> المنتجات </label>
                                    <select class="form-control selectpicker inline-control"
                                            name="product_id" id="products">
                                        @if(request('product_id'))
                                            <option value="{{request('product_id')}}">
                                                {{\App\Models\AccountingSystem\AccountingProduct::whereId(request('product_id'))->first()->name}}
                                            </option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="from">الفترة من </label>
                                    {!! Form::date("from",request('from'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="to">الفترة الى </label>
                                    {!! Form::date("to",request('to'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة الى ',"id"=>'to'])!!}
                                </div>

                                <div class="form-group col-sm-12">
                                    <button type="submit" class="btn btn-success btn-block">بحث</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
            <div id="print-window">

                <table class="table datatable-button-init-basic">
                    <thead>
                    <tr>
                        <th> المنتج</th>
                        <th>الوحدة</th>
                        <th> الكمية</th>
                        <th> السعر</th>
                        <th>الاجمالى</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        <tr>
                            <td>{{@$sale->product->name}}</td>
                            <td>{{$sale->unit->name ?? $sale->product->main_unit}}</td>
                            <td>{{$sale->quantity}}</td>
                            <td>{{$sale->price}}</td>
                            <td>{{$sale->total}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>{{$sales->sum('quantity')}}</td>
                        <td>{{$sales->sum('price')}}</td>
                        <td>{{$sales->sum('total')}}</td>

                    </tr>
                    </tfoot>
                </table>
{{--                {{$dataTable->table([], true)}}--}}

            </div>
        </div>
    </div>
        @endsection
        @section('scripts')
{{--            {{$dataTable->scripts()}}--}}

            <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
                    integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
                    crossorigin="anonymous" referrerpolicy="no-referrer">
            </script>

            <script>
                $('#products').select2({
                    ajax: {
                        delay: 250,
                        url: "/accounting/products-by-ajax",
                        data: function (params) {
                            return {
                                search: params.term,
                                page: params.page || 1
                            };
                        },
                        processResults: function (data, params) {
                            params.page = params.page || 1;
                            results = _.toArray(data.data.data);
                            return {
                                results: results,
                                pagination: {
                                    more: data.has_more
                                }
                            };
                        },
                        cache: true
                    },
                    placeholder: 'ابحث عن المنتجات',
                    minimumInputLength: 1,
                });


            </script>

@stop
