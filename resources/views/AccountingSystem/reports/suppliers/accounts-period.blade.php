@extends('AccountingSystem.layouts.master')
@section('title','تقرير كشف حساب مورد خلال فترة')
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
            <h5 class="panel-title">تقرير كشف حساب مورد خلال فترة زمنية</h5>
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
                                <label> المورد </label>
                                <select name="supplier_id" data-live-search="true"
                                        class="selectpicker form-control inline-control" id="supplier_id">
                                        <option value="" selected="" disabled="">اختر المورد</option>
                                        @foreach(suppliers() as $index=>$supplier)
                                            <option
                                                value="{{ $index }}" {{$index == request('supplier_id') ? 'selected':''}}>{{ $supplier }}</option>
                                        @endforeach
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

                    @if(isset($requests['supplier_id']))
                    @php $supplier=\App\Models\AccountingSystem\AccountingSupplier::find($requests['supplier_id']) @endphp
                    <td class="footTdLbl" colspan="2">المورد : <span>{{$supplier->name}}</span></td>
                    @endif




                    @if(isset($requests['from']))
                        <td class="footTdLbl" colspan="2"> من:<span>{{$requests['from']}}</span></td>
                    @endif

                    @if(isset($requests['to']))
                        <td class="footTdLbl" colspan="2">إلى :<span>{{$requests['to']}}</span></td>
                    @endif

                </tr>

                {{--التفاصيل (التاريخ– نوع الحركة – بيان الحركة - دائن – مدين – الرصيد بعد العملية).--}}
                <tr>
                    <th>#</th>
                    <th> التاريخ </th>
                    <th> نوع الحركة </th>
                    <th> بيان الحركة </th>
                    <th> الحالة </th>
                    <th> الرصيد بعد العملية </th>
                    {{--<th> إجمالي مرتجع الخصم من المديونية </th>--}}

                    {{--<th class="text-center">العمليات</th>--}}
                </tr>
                </thead>

                <tbody>


                @foreach($accounts as $row)

                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->created_at!!}</td>
                        <td>{!! $row->type !!}</td>
                        @if ($row->type=="مرتجعات")
                            <td><a href="{{route('accounting.puchaseReturns.show',['id'=>$row->return_id])}}">{{$row->return_id}}</a></td>
                       @elseif($row->type=="مشتريات")
                            <td><a href="{{route('accounting.purchases.show',['id'=>$row->purchase_id])}}">{{$row->purchase_id}}</a></td>
                        @else
                            <td><a href="{{route('accounting.clauses.show',['id'=>$row->clause_id])}}">{{$row->clause_id}}</a></td>

                        @endif
                        @if ($row->status=='debit')
                            <td>مدين</td>
                        @else
                            <td>دائن</td>
                        @endif

                        <td>{!! $row->new_balance !!}</td>


                        {{--<td class="text-center">--}}
                            {{--<a href="{{route('accounting.reports.purchase_returns_details')}}?date={{ $row->date }}" data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>--}}

                        {{--</td>--}}
                    </tr>

                @endforeach



                </tbody>
                <tfoot>
                {{--<tr>--}}
                    {{--<td>المجموع</td>--}}
                    {{--<td></td>--}}
                    {{--<td>{{$all_amounts}}</td>--}}
                    {{--<td>{{$discounts}}</td>--}}
                    {{--<td>{{$total_tax}}</td>--}}
                    {{--<td>{{$all_total}}  </td>--}}
                    {{--<td></td>--}}
                {{--</tr>--}}
                {{--</tfoot>--}}
            </table>
        	</div>
        </div>
<div class="row print-wrapper">
        	<button class="btn btn-success" id="print-all">طباعة</button>
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
                let suppliers = $('#supplier_id');
                $.ajax({
                    url: `{{ url('accounting/ajax/users-by-branches') }}/${$(this).val()}`,
                    type: "get",
                    success (data) {
                        // console.log(data)
                        userSelect.empty();
                        cases.empty();
                        suppliers.empty();
                        userSelect.append('<option value="">القائم بالعملية</option>');
                        cases.append('<option value="">الخزينة</option>');
                        suppliers.append('<option value="">المورد</option>');
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
                        data.suppliers.forEach( supplier => {
                            suppliers.append(`
                                <option value="${supplier.id}">${supplier.name}</option>
                            `);
                        });
                        userSelect.selectpicker('refresh');
                        cases.selectpicker('refresh');
                        suppliers.selectpicker('refresh');
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
