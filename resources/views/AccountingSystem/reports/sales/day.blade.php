@extends('AccountingSystem.layouts.master')
@section('title', 'تقرير المبيعات خلال يوم')
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
            <h5 class="panel-title">تقرير المبيعات خلال يوم</h5>
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
                                @csrf
                                <div class="form-group col-sm-3">
                                    <label> الشركة </label>
                                    {!! Form::select('company_id', companies(), request('company_id'), ['class' => 'selectpicker form-control inline-control', 'placeholder' => 'اختر الشركة', 'data-live-search' => 'true', 'id' => 'company_id']) !!}
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
                                    <label> القائم بالعملية </label>
                                    {!! Form::select('user_id', \App\Models\User::where('is_saler', 1)->pluck('name', 'id'), null, ['class' => 'selectpicker form-control inline-control', 'placeholder' => 'اختار الكاشير']) !!}

                                </div>


                                <div class="form-group col-sm-3">
                                    <label> القسم </label>

                                    <select name="category_id" data-live-search="true"
                                        class="selectpicker form-control inline-control" id="category_id">

                                        <option value="" selected="" disabled="">اختر القسم</option>
                                        @foreach (productCategories() as $index => $category)
                                            <option value="{{ $index }}"
                                                {{ $index == request('category_id') ? 'selected' : '' }}>
                                                {{ $category }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label> الصنف </label>
                                    <select name="product_id" data-live-search="true"
                                        class="selectpicker form-control inline-control" id="product_id">
                                        @if (request()->has('product_id') && request('product_id') != null)
                                            @php $product = \App\Models\AccountingSystem\AccountingProduct::find(request('product_id')); @endphp
                                            <option value="{{ $product->id }}" selected="">{{ $product->name }}
                                            </option>
                                        @else
                                            <option value="" selected="" disabled="">اختر الصنف</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label for="from"> التاريخ </label>
                                    {!! Form::date('date', request('date'), ['class' => 'inlinedatepicker form-control inline-control', 'placeholder' => ' الفترة من ', 'id' => 'date']) !!}
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
                            <th>#</th>
                            <th> التاريخ</th>
                            <th> إجمالي المبيعات</th>
                            <th> إجمالي الخصومات</th>
                            <th> إجمالي الضريبة</th>
                            <th> إجمالي بعد الخصومات والضريبة</th>
                            <th> العمليات</th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $all_amounts = 0;
                            $discounts = 0;
                            $total_tax = 0;
                            $all_total = 0;
                        @endphp
                        @foreach ($sales as $row)
                            @php
                                $all_amounts += $row->all_amounts;
                                $discounts += $row->discounts;
                                $total_tax += $row->total_tax;
                                $all_total += $row->all_total;
                            @endphp

                            <tr>
                                <td>{!! $loop->iteration !!}</td>
                                <td>{!! $row->created_at->locale('ar')->toDayDateTimeString() !!}</td>
                                <td>{!! $row->all_amounts ?? 0 !!}</td>
                                <td>{!! $row->discounts ?? 0 !!}</td>
                                <td>{!! $row->total_tax ?? 0 !!}</td>
                                <td>{!! $row->all_total ?? 0 !!}</td>
                                <td><a href="{{ route('accounting.sales.show', $row->id) }}" data-toggle="tooltip"
                                        target="_blank" data-original-title="عرض الفاتورة"> <i class="icon-eye text-inverse"
                                            style="margin-left: 10px"></i> </a> </td>
                            </tr>

                        @endforeach


                    </tbody>
                    <tfoot>
                        <tr>
                            <td>المجموع</td>
                            <td></td>
                            <td>{{ $all_amounts }}</td>
                            <td>{{ $discounts }}</td>
                            <td>{{ $total_tax }}</td>
                            <td>{{ $all_total }} </td>
                            <td>عدد الفواتير:{{ $sales->count() }}</td>
                            <th> العمليات</th>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="row print-wrapper">
            <button class="btn btn-success" id="print-all">طباعة</button>
        </div>
    </div>


@endsection

@section('scripts')

    @include('AccountingSystem.reports.sales.script')
@stop
