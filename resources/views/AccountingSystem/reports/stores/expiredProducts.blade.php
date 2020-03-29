@extends('AccountingSystem.layouts.master')
@section('title','تقرير  اصناف  قاربت  على الانتهاء')
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
            <h5 class="panel-title">تقرير اصناف  قاربت  على الانتهاء</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.expiration-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}

                            @if (count($errors) > 0)
                                {{--@php popup('error',$errors->all()) @endphp--}}
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
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
                            <div class="form-group col-sm-4">
                                <label>  </label>
                                <input type="submit" value="بحث" class="btn btn-success">
                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
                {{--(اسم الصنف – الوحدة – الكمية الحالية - الكمية الحالية التي قاربت على الانتهاء– تاريخ الانتهاء – المدة المتبقية على الانتهاء)--}}
            </section>
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف </th>
                    <th>  الوحدة </th>
                    <th>  كمية الحالية  اللى  قاربت  على  الانتهاء </th>

                    <th> المده  المتبقيه على الانتهاء   </th>
                </tr>
                </thead>
                <tbody>
                    @isset($expire_products)
                @foreach($expire_products as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>

                        <td>{!! $row->main_unit!!}</td>
                        <td>{!! $quantites[$row->id]!!}</td>
                            @php($expire=new \Carbon\Carbon($row->expired_at))
                        <td>{!! $expire->diff(\Carbon\Carbon::now())->days !!}</td>

                    </tr>

                @endforeach
                        @endisset
                </tbody>
            </table>
            {{--@if($expire_products != [])--}}
                {{--{{ $expire_products->appends(\Illuminate\Support\Facades\Input::except('page'))->links() }}--}}
            {{--@endif--}}
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
