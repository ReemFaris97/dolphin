@extends('AccountingSystem.layouts.master')
@section('title','تقرير  الاصناف  الراكده')
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
            <h5 class="panel-title">تقرير الاصناف  الراكدة</h5>
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
                            {!!Form::open( ['route' => 'accounting.reports.stagnant-products' ,'class'=>'form phone_validate', 'method' => 'GET','files' => true]) !!}

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
                                <label></label>
                                <input type="submit" value="بحث" class="btn btn-success">
                            </div>

                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
                {{--التفاصيل (اسم الصنف – الوحدة - الكمية الحالية – الحد الأدنى – تاريخ آخر عملية بيع).--}}
            </section>

            <div class="form-group col-md-12 pull-left">
                {{--<label class="label label-info">  الشركة    : </label>--}}
                <center>
                    @if(isset($requests['company_id']))
                        @php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))
                        <span><img src="{!!getimg($company->image)!!}" style="width:100px; height:100px"> </span>
                    @endif
                </center>
            </div>
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info">  الشركة    : </label>
                @if(isset($requests['company_id']))
                    @php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))
                    <span>{{$company->name}}</span>
                @endif
            </div>
            @if(isset($requests['branch_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info">  الفرع   : </label>
                    @php($branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']))
                    <span>{{$branch->name}}</span>
            </div>
            @endif
            @if(isset($requests['store_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> المخزن: </label>
                    @php($store=\App\Models\AccountingSystem\AccountingStore::find($requests['store_id']))
                    <span>{{$store->ar_name}}</span>
            </div>
            @endif
            @if(isset($requests['product_id']))
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> الصنف: </label>
                    @php($product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']))
                    <span>{{$product->name}}</span>
            </div>
            @endif
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> من: </label>
                @if(isset($requests['from']))
                    <span>{{$requests['from']}}</span>
                @endif
            </div>
            <div class="form-group col-md-2 pull-left">
                <label class="label label-info"> الى: </label>
                @if(isset($requests['to']))
                    <span>{{$requests['to']}}</span>
                @endif
            </div>
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف </th>
                    <th>  الوحدة </th>
                    <th>  كمية الحالية</th>
                    <th> الحد الادنى  </th>
                    <th> تاريخ اخر عملية بيع  </th>
                </tr>
                </thead>
                <tbody>
                    @isset($stagnant_sales)
                @foreach($stagnant_sales as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>
                        <td>{!! $row->product->main_unit!!}</td>

                        <td>{!!  ($quantites[$row->product->id]) !!}</td>


                        <td>{!! $row->product->min_quantity!!}</td>

                        <td>{!! $row->created_at !!}</td>

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
