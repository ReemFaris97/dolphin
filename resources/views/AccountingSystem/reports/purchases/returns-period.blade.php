@extends('AccountingSystem.layouts.master')
@section('title','تقرير مرتجعات مشتريات خلال فترة')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
<style>
    /*<link href="{{--asset('admin/assets/css/jquery.datetimepicker.min.css')--}}" rel="stylesheet" type="text/css">*/

    .filter {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير مرتجعات مشتريات خلال فترة زمنية</h5>
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
                                <label> الخزينة </label>
                                <select name="safe_id" data-live-search="true" class="selectpicker form-control inline-control" id="safe_id">
                                    @if(request()->has('safe_id') && request('safe_id') != null)
                                        @php $safe = \App\Models\AccountingSystem\AccountingSafe::find(request('safe_id')); @endphp
                                        <option value="{{ $safe->id }}" selected="">{{ $safe->name }}</option>
                                    @else
                                        <option value="" selected="" disabled="">اختر الخزينة</option>
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
                                <label for="from"> الفترة من </label>
                                {!! Form::date("from",request('from'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="to"> الفترة إلي </label>
                                {!! Form::date("to",request('to'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
                            </div>

                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-success btn-block">بحث</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </section>
        

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> التاريخ </th>
                    <th> إجمالي مرتجعات المشتريات </th>
                    <th> إجمالي الخصومات </th>
                    <th> إجمالي الضريبة </th>
                    <th> إجمالي بعد الخصومات والضريبة </th>
                    <th> إجمالي المرتجع الكاش </th>
                    <th> إجمالي مرتجع الخصم من المديونية </th>
                    
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($purchases as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->created_at->locale('ar')->toDayDateTimeString() !!}</td>
                        <td>{!! $row->all_amounts !!}</td>
                        <td>{!! $row->discounts !!}</td>
                        <td>{!! $row->total_tax !!}</td>
                        <td>{!! $row->all_total !!}</td>
                        <td>{!! $row->return_cash !!}</td>
                        <td>{!! $row->return_agel !!}</td>

                        <td class="text-center">
                            <a href="{{route('accounting.reports.purchase_returns_details')}}?date={{ $row->date }}" data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
        </div>

    </div>


@endsection

@section('scripts')
    {{-- <script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('.inlinedatepicker').datetimepicker().datepicker("setDate", new Date());
            $('.inlinedatepicker').text(new Date().toLocaleString());
            $('.inlinedatepicker').val(new Date().toLocaleString());
        })
    </script> --}}

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
@stop
