@extends('AccountingSystem.layouts.master')
@section('title','تقرير مرتجعات مبيعات خلال يوم')
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
            <h5 class="panel-title">تقرير مرتجعات مبيعات خلال يوم</h5>
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
                            <form action="" method="post" accept-charset="utf-8">
                                @csrf
                            <div class="form-group col-sm-3">
                                <label> الشركة </label>
                                {!! Form::select("company_id",companies(), request('company_id'),['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الفرع </label>
                                {{-- {!! Form::select("branch_id",[],request('branch_id'),['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الفرع','data-live-search'=>'true','id'=>'branch_id'])!!} --}}
                                <select name="branch_id" data-live-search="true" class="selectpicker form-control inline-control" id="branch_id">
{{--                                    @if(request()->has('branch_id') && request('branch_id') != null)--}}
{{--                                        @php $branch = \App\Models\AccountingSystem\AccountingBranch::find(request('branch_id')); @endphp--}}
{{--                                        <option value="{{ $branch->id }}" selected="">{{ $branch->name }}</option>--}}
{{--                                    @else--}}
{{--                                        <option value="" selected="" disabled="">اختر الفرع</option>--}}
{{--                                    @endif--}}
                                    <option value="" selected="" disabled="">اختر الفرع</option>
                                    @foreach(branches() as $index=>$branch)
                                        <option
                                            value="{{ $index }}" {{$index == request('branch_id') ? 'selected':''}}>{{ $branch }}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="form-group col-sm-3">
                                    <label> المستودع </label>
{{--                                    {!! Form::select("store_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر المستودع','data-live-search'=>'true','id'=>'store_id'])!!}--}}
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


                                <div class="form-group col-sm-3">
                                    <label> القائم بالعملية </label>
                                    {!! Form::select('user_id',\App\Models\User::where('is_saler',1)->pluck('name','id'),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختار الكاشير']) !!}
                                </div>


                                <div class="form-group col-sm-3">
                                    <label> الوردية </label>
                                    <select name="shift_id" data-live-search="true" class="selectpicker form-control inline-control" id="shift_id">
{{--                                        @if(request()->has('shift_id') && request('shift_id') != null)--}}
{{--                                            @php $shift = \App\Models\AccountingSystem\AccountingBranchShift::find(request('shift_id')); @endphp--}}
{{--                                            <option value="{{ $shift->id }}" selected="">{{ $shift->name }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="" selected="" disabled="">اختر الوردية</option>--}}
{{--                                        @endif--}}
                                        <option value="" selected="" disabled="">اختر الوردية</option>
                                        @foreach(shifts() as $index=>$shift)
                                            <option value="{{$index}}">{{$shift}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label> الجلسة </label>
                                    <select name="session_id" data-live-search="true" class="selectpicker form-control inline-control" id="session_id">
{{--                                        @if(request()->has('session_id') && request('session_id') != null)--}}
{{--                                            @php $safe = \App\Models\AccountingSystem\AccountingSession::find(request('session_id')); @endphp--}}
{{--                                            <option value="{{ $safe->id }}" selected="">{{ $safe->code }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="" selected="" disabled="">اختر الجلسة</option>--}}
{{--                                        @endif--}}
                                        <option value="" selected="" disabled="">اختر الجلسة</option>
                                        @foreach(\App\Models\AccountingSystem\AccountingSession::all() as $session)
                                            <option
                                                value="{{$session->id}}" {{$session->id ==request('session_id')?'selected':''}}>{{$session->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            {{--<div class="form-group col-sm-3">--}}
                                {{--<label> الخزينة </label>--}}
                                {{--<select name="safe_id" data-live-search="true" class="selectpicker form-control inline-control" id="safe_id">--}}
                                    {{--@if(request()->has('safe_id') && request('safe_id') != null)--}}
                                        {{--@php $safe = \App\Models\AccountingSystem\AccountingSafe::find(request('safe_id')); @endphp--}}
                                        {{--<option value="{{ $safe->id }}" selected="">{{ $safe->name }}</option>--}}
                                    {{--@else--}}
                                        {{--<option value="" selected="" disabled="">اختر الخزينة</option>--}}
                                    {{--@endif--}}
                                {{--</select>--}}
                            {{--</div>--}}
                                <div class="form-group col-sm-3">
                                    <label> القسم </label>
                                    {{--{!! Form::select("category_id",productCategories(),request('category_id'),['class'=>'selectpicker form-control js-example-basic-single category_id','id'=>'category_id','placeholder'=>' اختر اسم القسم ','data-live-search'=>'true'])!!}--}}
                                    <select name="category_id" data-live-search="true" class="selectpicker form-control inline-control" id="category_id">
{{--                                        @if(request()->has('category_id') && request('category_id') != null)--}}
{{--                                            @php $category = \App\Models\AccountingSystem\AccountingProductCategory::find(request('category_id')); @endphp--}}
{{--                                            <option value="{{ $category->id }}" selected="">{{ $category->name }}</option>--}}
{{--                                        @else--}}
{{--                                            <option value="" selected="" disabled="">اختر القسم</option>--}}
{{--                                        @endif--}}
                                        <option value="" selected="" disabled="">اختر القسم</option>
                                        @foreach(productCategories() as $index=>$category)
                                            <option
                                                value="{{$index}}" {{$index == request('category_id') ? 'selected':''}}>{{$category}}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group col-sm-3">
                                <label> الصنف </label>
                                <select name="product_id" data-live-search="true" class="selectpicker form-control inline-control" id="product_id">
                                    @if(request()->has('product_id') && request('product_id') != null)
                                        @php $product = \App\Models\AccountingSystem\AccountingProduct::find(request('product_id')); @endphp
                                        <option value="{{ $product->id }}" selected="">{{ $product->name }}</option>
                                    @else
                                        <option value="" selected="" disabled="">اختر الصنف</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="from"> التاريخ </label>
                                {!! Form::date("date",request('date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'date'])!!}
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
            <th> رقم وكود الفاتورة </th>
            <th> العميل </th>
            <th> اسم القائم بالعملية </th>
            {{-- <th> الإجمالي </th> --}}
            <th> إجمالي سعر البيع </th>
            <th> الخصم </th>
            {{--<th> المدفوع </th>--}}
            {{--<th> المتبقي </th>--}}
            <th> لإجمالي بعد الخصم والضريبة </th>

            <th class="text-center td-display-none">العمليات</th>
        </tr>
        </thead>
        <tbody>

        @foreach($sales as $row)

            <tr>
                <td>{!!$loop->iteration!!}</td>
                <td>{!! $row->bill_num !!}</td>
                <td>{!! $row->client()->exists() ? $row->client->name : '-' !!}</td>
                <td>{!! $row->user()->exists() ? $row->user->name : '-' !!}</td>
                <td>{!! $row->amount?? 0 !!}</td>
                <td>{!! $row->discount?? 0 !!}</td>
                {{--<td>{!! $row->payed !!}</td>--}}
                {{--<td>{!! $row->total - $row->payed !!}</td>--}}

                <td>{!! $row->total?? 0 !!}</td>

                <td class="text-center td-display-none">
                    <a href="{{route('accounting.sales.show',$row->id)}}" target="_blank" data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                </td>
            </tr>

        @endforeach



        </tbody>
  {{--      <tfoot>
        <tr>
            <td>المجموع</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{$sales->sum('total')}}</td>
            <td></td>
            <td></td>
            <td>عدد الفواتير:{{$sales->count()}}</td>

        </tr>
        </tfoot>--}}
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
