@extends('AccountingSystem.layouts.master')
@section('title','تقرير النواقص')
@section('parent_title','التقارير ')
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
            <h5 class="panel-title">تقرير النواقص</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.deficiency-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}

                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select("company_id",companies(),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                {!! Form::select("branch_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الفرع','data-live-search'=>'true','id'=>'branch_id'])!!}
                            </div>

                            <div class="form-group col-sm-3">
                                <label> المخزن </label>
                                {!! Form::select("store_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر المخزن','data-live-search'=>'true','id'=>'store_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الصنف </label>
                                {!! Form::select("product_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الصنف','data-live-search'=>'true','id'=>'product_id'])!!}
                            </div>

                            <div class="form-group col-sm-4">
                                <label>  </label>
                                <input type="submit" value="بحث" class="btn btn-success">
                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>
            {{---         التفاصيل (اسم الصنف – الوحدة - الكمية الحالية – الحد الأدنى – سعر الشراء).--}}
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>

                    <th> اسم الصنف </th>
                    <th>  الوحده </th>
                    <th> الكمية الحاليه  </th>
                    <th> الحد الأدنى </th>
                    <th> سعر الشراء</th>

                </tr>
                </thead>
                <tbody>
                @isset($deficiencies)
                    @foreach($deficiencies as $row)

                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! $row->name!!}</td>
                            <td>{!! $row->main_unit!!}</td>
                            <td>{!! $quantites[$row->id] !!}</td>
                            <td>{!! $row->min_quantity!!}</td>
                            <td>{!! $row->purchasing_price!!}</td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>



        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
