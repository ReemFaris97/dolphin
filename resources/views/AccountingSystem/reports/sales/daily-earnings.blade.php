@extends('AccountingSystem.layouts.master')
@section('title','تقرير  الارباح اليومية')
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
            <h5 class="panel-title">تقرير الارباح خلال يوم</h5>
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
                                <label> القائم بالعملية </label>
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
        

            <table class="table">
                <thead>
                <tr>
                    <th> التاريخ </th>
                    <th> إجمالي تكلفة المنتجات المباعة كمشتريات </th>
                    <th> إجمالي المببيعات </th>
                    <th> إجمالي الخصومات </th>
                    <th> إجمالي  الربح</th>
                </tr>
                </thead>
                <tbody>
                        @foreach($sales as  $sale)
                    <tr>
                        <td>{!!$sale['date']!!}</td>
                        <td>{!!$purchase_cost!!}</td>
                        <td>{!!$sale['all_amounts']!!}</td>
                        <td>{!!$sale['discounts']!!}</td>
                        <td>{!!$sale['all_amounts']-$sale['discounts']-$purchase_cost!!}</td>
                    </tr>
                        @endforeach

                </tbody>
            </table>

            <div class="clearfix"></div>
            {{--(رقم وكود الفاتورة- العميل- اسم الكاشير – الإجمالي – إجمالي سعر الشراء – إجمالي سعر البيع – الخصم - الضريبة - الربح).--}}

            {{--<table class="table datatable-button-init-basic">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th> كود الفاتورة </th>--}}
                    {{--<th>  العميل </th>--}}
                    {{--<th> اسم الكاشير </th>--}}
                    {{--<th> الاجمالى </th>--}}
                    {{--<th> إجمالي  سعر الشراء</th>--}}
                    {{--<th> إجمالي الخصم </th>--}}
                    {{--<th> إجمالي  الضريبه </th>--}}
                    {{--<th> إجمالي  الربح </th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                {{--@foreach($sales_bills as  $sale)--}}
                    {{--<tr>--}}
                        {{--<td><a href="{{route('accounting.sales.show',['id'=>$sale->id])}}">{!! $sale ->id!!} </a></td>--}}
                        {{--<td>{!!$sale ->client->name!!}</td>--}}
                        {{--<td>{!!$sale ->user->name!!}</td>--}}
                        {{--<td>{!!$sale->item_cost!!}</td>--}}
                        {{--<td>{!!$sale ->amount !!}</td>--}}
                        {{--<td>{!!$sale ->discount !!}</td>--}}
                        {{--<td>{!!$sale ->totalTaxs !!}</td>--}}
                        {{--<td>{!!$sale ->total -$sale->item_cost  !!}</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        </div>

    </div>


@endsection

@section('scripts')

    <script>
        $(function() {
            $(document).on('change', '#company_id', function () {
                let branchSelect = $('#branch_id');
                $.ajax({
                    url: `{{ url('accounting/ajax/branches') }}/${$(this).val()}`,
                    type: "get",
                    success (data) {
                        //console.log(data)
                        branchSelect.empty();
                        branchSelect.append('<option value="">اختر الفرع</option>');
                        data.forEach( branch => {
                            branchSelect.append(`
                                <option value="${branch.id}">${branch.name}</option>
                            `);
                        });
                        branchSelect.selectpicker('refresh');
                    },
                    error (error) {
                        console.log(error)
                    }
                })
            })

            $(document).on('change', '#branch_id', function () {
                let userSelect = $('#user_id');
                let cases = $('#safe_id');
                $.ajax({
                    url: `{{ url('accounting/ajax/users-by-branches') }}/${$(this).val()}`,
                    type: "get",
                    success (data) {
                        // console.log(data)
                        userSelect.empty();
                        cases.empty();
                        userSelect.append('<option value="">القائم بالعملية</option>');
                        cases.append('<option value="">الخزينة</option>');
                        data.users.forEach( user => {
                            userSelect.append(`
                                <option value="${user.id}">${user.name}</option>
                            `);
                        });
                        data.safes.forEach( safe => {
                            cases.append(`
                                <option value="${safe.id}">${safe.name}</option>
                            `);
                        });
                        userSelect.selectpicker('refresh');
                        cases.selectpicker('refresh');
                    },
                    error (error) {
                        console.log(error)
                    }
                })
            })

            $(document).on('change', '#category_id', function () {
                let productSelect = $('#product_id');
                $.ajax({
                    url: `{{ url('accounting/ajax/products') }}/${$(this).val()}`,
                    type: "get",
                    success (data) {
                        //console.log(data)
                        productSelect.empty();
                        productSelect.append('<option value="">الصنف</option>');
                        data.forEach( product => {
                            productSelect.append(`
                                <option value="${product.id}">${product.name}</option>
                            `);
                        });
                        productSelect.selectpicker('refresh');
                    },
                    error (error) {
                        console.log(error)
                    }
                })
            })


        })
    </script>
    @include('AccountingSystem.reports.sales.script')

@stop