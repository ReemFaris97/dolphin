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
                            {!!Form::open( ['route' => 'accounting.reports.deficiency-products' ,'class'=>'form phone_validate', 'method' => 'post','files' => true]) !!}

                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select("company_id",companies(),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                <select name="branch_id" data-live-search="true"
                                        class="selectpicker form-control inline-control" id="branch_id">
                                    <option value="" selected="" disabled="">اختر الفرع</option>
                                    @foreach(branches() as $index=>$branch)
                                        <option
                                            value="{{ $index }}" {{$index == request('branch_id') ? 'selected':''}}>{{ $branch }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group col-sm-3">
                                <label> المستودع </label>
                                <select name="store_id" data-live-search="true" id="store_id"
                                        class="selectpicker form-control inline-control">
                                    <option selected disabled>اختر المستودع</option>
                                    @foreach(allstores() as $store)
                                        <option
                                            value="{{$index}}"
                                            {{$index == request('store_id')?'selected':''}}>{{$store}}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="form-group col-sm-3">--}}
                                {{--<label> الصنف </label>--}}
                                {{--{!! Form::select("product_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الصنف','data-live-search'=>'true','id'=>'product_id'])!!}--}}
                            {{--</div>--}}

                            <div class="form-group col-sm-4">
                                <label>  </label>
                                <input type="submit" value="بحث" class="btn btn-success">
                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
            </section>

            {{--<div class="form-group col-md-12 pull-left">--}}
                {{--<label class="label label-info">  الشركة    : </label>--}}
                {{--<center>--}}
                    {{--@if(isset($requests['company_id']))--}}
                        {{--@php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))--}}
                        {{--<span><img src="{!!getimg($company->image)!!}" style="width:100px; height:100px"> </span>--}}
                    {{--@endif--}}
                {{--</center>--}}
            {{--</div>--}}
            {{--@if(isset($requests['company_id']))--}}
            {{--<div class="form-group col-md-2 pull-left">--}}
                {{--<label class="label label-info">  الشركة    : </label>--}}
                {{--@php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))--}}
                    {{--<span>{{$company->name}}</span>--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--@if(isset($requests['branch_id']))--}}
            {{--<div class="form-group col-md-2 pull-left">--}}
                {{--<label class="label label-info">  الفرع   : </label>--}}
                    {{--@php($branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']))--}}
                    {{--<span>{{$branch->name}}</span>--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--@if(isset($requests['store_id']))--}}
            {{--<div class="form-group col-md-2 pull-left">--}}
                {{--<label class="label label-info"> المستودع: </label>--}}
                    {{--@php($store=\App\Models\AccountingSystem\AccountingStore::find($requests['store_id']))--}}
                    {{--<span>{{$store->ar_name}}</span>--}}
            {{--</div>--}}
            {{--@endif--}}
            {{--@if(isset($requests['product_id']))--}}
            {{--<div class="form-group col-md-2 pull-left">--}}
                {{--<label class="label label-info"> الصنف: </label>--}}
                    {{--@php($product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']))--}}
                    {{--<span>{{$product->name}}</span>--}}
            {{--</div>--}}
            {{--@endif--}}

            {{--<div class="form-group col-md-2 pull-left">--}}
                {{--<label class="label label-info"> من: </label>--}}
                {{--@if(isset($requests['from']))--}}
                    {{--<span>{{$requests['from']}}</span>--}}
                {{--@endif--}}
            {{--</div>--}}
            {{--<div class="form-group col-md-2 pull-left">--}}
                {{--<label class="label label-info"> الى: </label>--}}
                {{--@if(isset($requests['to']))--}}
                    {{--<span>{{$requests['to']}}</span>--}}
                {{--@endif--}}
            {{--</div>--}}
            {{---         التفاصيل (اسم الصنف – الوحدة - الكمية الحالية – الحد الأدنى – سعر الشراء).--}}


            <div id="print-window">
            <table class="table datatable-button-init-basic">

                <thead>
                <tr class="normal-bgc">
                    @if(isset($requests['company_id']))
                        <td class="company-imgg-td" colspan="8">
                            @php($company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id']))
                            <span><img src="{!!getimg($company->image)!!}" style="width:100px; height:100px"> </span>
                            <span>{{$company->name}}</span>
                        </td>
                    @endif

                </tr>
                <tr  class="normal-bgc">
                    @if(isset($requests['branch_id']))
                        @php($branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']))
                        <td class="footTdLbl" colspan="2">الفرع : <span>{{$branch->name}}</span></td>
                    @endif

                    @if(isset($requests['store_id']))
                        @php($store=\App\Models\AccountingSystem\AccountingStore::find($requests['store_id']))
                        <td class="footTdLbl" colspan="2">المستودع : <span>{{$store->ar_name}}</span></td>
                    @endif

                    @if(isset($requests['product_id']))
                        @php($product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']))
                        <td class="footTdLbl" colspan="2">الصنف : <span>{{$product->name}}</span></td>
                    @endif

                    @if(isset($requests['from']))
                        <td class="footTdLbl" colspan="2">من<span>{{$requests['from']}}</span></td>
                    @endif

                    @if(isset($requests['to']))
                        <td class="footTdLbl" colspan="2">إلى<span>{{$requests['to']}}</span></td>
                    @endif

                </tr>
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
<div class="row print-wrapper">
        	<button class="btn btn-success" id="print-all">طباعة</button>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('admin/assets/js/get_product_from_store_form_company.js')}}"></script>
@stop
