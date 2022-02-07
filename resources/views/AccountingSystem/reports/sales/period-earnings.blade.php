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
            @include('AccountingSystem.reports.sales._form')
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
                    <th> إجمالي تكلفة الاصناف المباعة كمشتريات </th>
                    <th> إجمالي المببيعات </th>
                    <th> إجمالي المببيعات بالضريبة </th>
                    <th> إجمالي الخصومات </th>
                    <th> إجمالي  الربح</th>
                    <th class="td-display-none"> عرض</th>
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
                        <td>{!!$sale['all_amounts_after_tax']?? 0!!}</td>
                        <td>{!!$sale['discounts']?? 0!!}</td>
                        <td>{!!($sale['all_amounts']-$sale['discounts'] - $sale['productPrice'])?? 0 !!}</td>
                        <td class="text-center td-display-none">
                            <a href="{{url('accounting.reports.daily')}}?date={{ $sale->date }}" data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

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
