@extends('AccountingSystem.layouts.master')
@section('title','تقرير  الارباح  مده زمنية')
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
            <h5 class="panel-title">تقرير الارباح خلال مده زمنية</h5>
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
                                    @if(request()->has('branch_id') && request('branch_id') != null)
                                        @php $branch = \App\Models\AccountingSystem\AccountingBranch::find(request('branch_id')); @endphp
                                        <option value="{{ $branch->id }}" selected="">{{ $branch->name }}</option>
                                    @else
                                        <option value="" selected="" disabled="">اختر الفرع</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-sm-3">
                                <label> الكاشير </label>
                                <select name="user_id" data-live-search="true" class="selectpicker form-control inline-control" id="user_id">
                                    @if(request()->has('user_id') && request('user_id') != null)
                                        @php $user = \App\User::find(request('user_id')); @endphp
                                        <option value="{{ $user->id }}" selected="">{{ $user->name }}</option>
                                    @else
                                        <option value="" selected="" disabled="">القائم بالعملية</option>
                                    @endif
                                </select>
                            </div>


                                <div class="form-group col-sm-3">
                                    <label> الوردية </label>
                                    <select name="shift_id" data-live-search="true" class="selectpicker form-control inline-control" id="shift_id">
                                        @if(request()->has('shift_id') && request('shift_id') != null)
                                            @php $shift = \App\Models\AccountingSystem\AccountingBranchShift::find(request('shift_id')); @endphp
                                            <option value="{{ $shift->id }}" selected="">{{ $shift->name }}</option>
                                        @else
                                            <option value="" selected="" disabled="">اختر الوردية</option>
                                        @endif
                                    </select>
                                </div>


                                <div class="form-group col-sm-3">
                                    <label> الجلسة </label>
                                    <select name="session_id" data-live-search="true" class="selectpicker form-control inline-control" id="session_id">
                                        @if(request()->has('session_id') && request('session_id') != null)
                                            @php $session = \App\Models\AccountingSystem\AccountingSession::find(request('session_id')); @endphp
                                            <option value="{{ $session->id }}" selected="">{{ $session->code }}</option>
                                        @else
                                            <option value="" selected="" disabled="">اختر الجلسة</option>
                                        @endif
                                    </select>
                                </div>
                            <div class="form-group col-sm-3">
                                <label> القسم </label>
                                {!! Form::select("category_id",productCategories(),request('category_id'),['class'=>'selectpicker form-control js-example-basic-single category_id','id'=>'category_id','placeholder'=>' اختر اسم القسم ','data-live-search'=>'true'])!!}
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
                                <label for="from"> من </label>
                                {!! Form::date("from",request('date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'date'])!!}
                            </div>
                                <div class="form-group col-sm-3">
                                    <label for="from"> الى </label>
                                    {!! Form::date("to",request('date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'date'])!!}
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

                <tr class="normal-bgc">
                    @if(isset($requests['company_id']))
                        <td class="company-imgg-td" colspan="8">
                            @php $company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id'])@endphp
                            <span><img src="{!!getimg($company->image)!!}" style="width:100px; height:100px"> </span>
                            <span>{{$company->name}}</span>
                        </td>
                    @endif

                </tr>

                <tr  class="normal-bgc">
                    @if(isset($requests['branch_id']))
                        @php $branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']) @endphp
                        <td class="footTdLbl" colspan="2">الفرع : <span>{{$branch->name}}</span></td>
                    @endif

                    {{--@if(isset($requests['user_id']))--}}
                        {{--@php $user=\App\User::find($requests['user_id']) @endphp--}}
                        {{--<td class="footTdLbl" colspan="2">القائم بالعمليه : <span>{{$user->name}}</span></td>--}}
                    {{--@endif--}}

                    {{--@if(isset($requests['session_id']))--}}
                        {{--@php $session=\App\Models\AccountingSystem\AccountingSession::find($requests['session_id']) @endphp--}}
                        {{--<td class="footTdLbl" colspan="2">كود الجلسه : <span>{{$session->code}}</span></td>--}}
                    {{--@endif--}}

                    @if(isset($requests['product_id']))
                        @php $product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']) @endphp
                        <td class="footTdLbl" colspan="2">الصنف : <span>{{$product->name}}</span></td>
                    @endif

                    @if(isset($requests['date']))
                        <td class="footTdLbl" colspan="2"> يوم:<span>{{$requests['date']}}</span></td>
                    @endif

                </tr>
                <tr>
                    <th> التاريخ </th>
                    <th> إجمالي تكلفة المنتجات المباعة كمشتريات </th>
                    <th> إجمالي المببيعات </th>
                    <th> إجمالي الخصومات </th>
                    <th> إجمالي  الربح</th>
                    <th> عرض</th>
                </tr>
                </thead>
                <tbody>
                @php $purchases_products=0; $sales_total=0; $discounts=0; $all_total=0; @endphp

                @foreach($sales as $sale)
                    @php
                        $purchases_products+=$sale['productPrice'];
                        $discounts+=$sale['discounts'];
                        $sales_total+=$sale['all_amounts'];
                        $all_total+=$sale['all_amounts']-$sale['discounts'] - $sale['productPrice'];
                    @endphp
                    <tr>
                        <td>{!!$sale['date']!!}</td>
                        <td>{!!$sale['productPrice']?? 0 !!}</td>
                        <td>{!!$sale['all_amounts']?? 0!!}</td>
                        <td>{!!$sale['discounts']?? 0!!}</td>
                        <td>{!!($sale['all_amounts']-$sale['discounts'] - $sale['productPrice'])?? 0 !!}</td>
                        <td class="text-center">
                            <a href="{{route('accounting.reports.sale_details')}}?date={{ $sale->date }}" data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                        </td>
                    </tr>
                        @endforeach

                </tbody>
                <tfoot>
                <tr>
                    <td>المجموع</td>

                    <td>{{$purchases_products}}</td>
                    <td>{{$sales_total}}</td>
                    <td>{{$discounts}}</td>
                    <td>{{$all_total}}  </td>
                    <td></td>
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

{{--    <script>--}}
{{--        $(function() {--}}
{{--            $(document).on('change', '#company_id', function () {--}}
{{--                let branchSelect = $('#branch_id');--}}
{{--                $.ajax({--}}
{{--                    url: `{{ url('accounting/ajax/branches') }}/${$(this).val()}`,--}}
{{--                    type: "get",--}}
{{--                    success (data) {--}}
{{--                        //console.log(data)--}}
{{--                        branchSelect.empty();--}}
{{--                        branchSelect.append('<option value="">اختر الفرع</option>');--}}
{{--                        data.forEach( branch => {--}}
{{--                            branchSelect.append(`--}}
{{--                                <option value="${branch.id}">${branch.name}</option>--}}
{{--                            `);--}}
{{--                        });--}}
{{--                        branchSelect.selectpicker('refresh');--}}
{{--                    },--}}
{{--                    error (error) {--}}
{{--                        console.log(error)--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}

{{--            $(document).on('change', '#branch_id', function () {--}}
{{--                let userSelect = $('#user_id');--}}
{{--                let cases = $('#safe_id');--}}
{{--                $.ajax({--}}
{{--                    url: `{{ url('accounting/ajax/users-by-branches') }}/${$(this).val()}`,--}}
{{--                    type: "get",--}}
{{--                    success (data) {--}}
{{--                        // console.log(data)--}}
{{--                        userSelect.empty();--}}
{{--                        cases.empty();--}}
{{--                        userSelect.append('<option value="">القائم بالعملية</option>');--}}
{{--                        cases.append('<option value="">الخزينة</option>');--}}
{{--                        data.users.forEach( user => {--}}
{{--                            userSelect.append(`--}}
{{--                                <option value="${user.id}">${user.name}</option>--}}
{{--                            `);--}}
{{--                        });--}}
{{--                        data.safes.forEach( safe => {--}}
{{--                            cases.append(`--}}
{{--                                <option value="${safe.id}">${safe.name}</option>--}}
{{--                            `);--}}
{{--                        });--}}
{{--                        userSelect.selectpicker('refresh');--}}
{{--                        cases.selectpicker('refresh');--}}
{{--                    },--}}
{{--                    error (error) {--}}
{{--                        console.log(error)--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}

{{--            $(document).on('change', '#category_id', function () {--}}
{{--                let productSelect = $('#product_id');--}}
{{--                $.ajax({--}}
{{--                    url: `{{ url('accounting/ajax/products') }}/${$(this).val()}`,--}}
{{--                    type: "get",--}}
{{--                    success (data) {--}}
{{--                        //console.log(data)--}}
{{--                        productSelect.empty();--}}
{{--                        productSelect.append('<option value="">الصنف</option>');--}}
{{--                        data.forEach( product => {--}}
{{--                            productSelect.append(`--}}
{{--                                <option value="${product.id}">${product.name}</option>--}}
{{--                            `);--}}
{{--                        });--}}
{{--                        productSelect.selectpicker('refresh');--}}
{{--                    },--}}
{{--                    error (error) {--}}
{{--                        console.log(error)--}}
{{--                    }--}}
{{--                })--}}
{{--            })--}}


{{--        })--}}
{{--    </script>--}}

    @include('AccountingSystem.reports.sales.script')

@stop
