@extends('AccountingSystem.layouts.master')
@section('title','تقرير المبيعات خلال فترة')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
    <style>
        /*<link href="
        {{--asset('admin/assets/css/jquery.datetimepicker.min.css')--}} " rel="stylesheet" type="text/css">*/

        .filter {
            margin-bottom: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير المبيعات خلال فترة زمنية</h5>
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
                            <form action="{{route('accounting.reports.sales_period')}}" method="get"
                                  accept-charset="utf-8">
                                <div class="form-group col-sm-3">
                                    <label> الشركة </label>
                                    {!! Form::select("company_id",companies(), request('company_id'),['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
                                </div>
                                <div class="form-group col-sm-3">
                                    <label> الفرع </label>
                                    <select name="branch_id" data-live-search="true"
                                            class="selectpicker form-control inline-control" id="branch_id">
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
                                    <label> الكاشير </label>
                                    <select name="user_id" data-live-search="true"
                                            class="selectpicker form-control inline-control" id="user_id">
                                        @if(request()->has('user_id') && request('user_id') != null)
                                            @php $user = App\User::find(request('user_id')); @endphp
                                            <option value="{{ $user->id }}" selected="">{{ $user->name }}</option>
                                        @else
                                            <option value="" selected="" disabled="">الكاشير</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label> الوردية </label>
                                    <select name="shift_id" data-live-search="true"
                                            class="selectpicker form-control inline-control" id="shift_id">
                                        {{--                                    @if(request()->has('shift_id') && request('shift_id') != null)--}}
                                        {{--                                        @php $shift = \App\Models\AccountingSystem\AccountingBranchShift::find(request('shift_id')); @endphp--}}
                                        {{--                                        <option value="{{ $shift->id }}" selected="">{{ $shift->name }}</option>--}}
                                        {{--                                    @else--}}
                                        {{--                                        <option value="" selected="" disabled="">اختر الوردية</option>--}}
                                        {{--                                    @endif--}}

                                        <option value="" selected="" disabled="">اختر الوردية</option>
                                        @foreach(shifts() as $index=>$shift)
                                            <option value="{{$index}}">{{$shift}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group col-sm-3">
                                    <label> الجلسة </label>
                                    <select name="session_id" data-live-search="true"
                                            class="selectpicker form-control inline-control" id="session_id">
                                        {{--                                    @if(request()->has('session_id') && request('session_id') != null)--}}
                                        {{--                                        @php $safe = \App\Models\AccountingSystem\AccountingSession::find(request('session_id')); @endphp--}}
                                        {{--                                        <option value="{{ $safe->id }}" selected="">{{ $safe->code }}</option>--}}
                                        {{--                                    @else--}}
                                        {{--                                        <option value="" selected="" disabled="">اختر الجلسة</option>--}}
                                        {{--                                    @endif--}}

                                        <option value="" selected="" disabled="">اختر الجلسة</option>
                                        @foreach(\App\Models\AccountingSystem\AccountingSession::all() as $session)
                                            <option
                                                value="{{$session->id}}" {{$session->id ==request('session_id')?'selected':''}}>{{$session->code}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label> القسم </label>
                                    <select name="category_id" data-live-search="true"
                                            class="selectpicker form-control inline-control" id="category_id">
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
                                    <select name="product_id" data-live-search="true"
                                            class="selectpicker form-control inline-control" id="product_id">
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
            <div id="print-window">
                <table class="table datatable-button-init-basic">
                    <thead>

                    <tr class="normal-bgc">
                        @if(isset($requests['company_id']))
                            <td class="company-imgg-td" colspan="8">
                                @php $company=\App\Models\AccountingSystem\AccountingCompany::find($requests['company_id'])@endphp
                                <span><img src="{!!getimg($company->image)!!}"
                                           style="width:100px; height:100px"> </span>
                                <span>{{$company->name}}</span>
                            </td>
                        @endif

                    </tr>

                    <tr class="normal-bgc">
                        @if(isset($requests['branch_id']))
                            @php $branch=\App\Models\AccountingSystem\AccountingBranch::find($requests['branch_id']) @endphp
                            <td class="footTdLbl" colspan="2">الفرع : <span>{{$branch->name}}</span></td>
                        @endif

                        {{--@if(isset($requests['user_id']))--}}
                        {{--@php $user=\App\User::find($requests['user_id']) @endphp--}}
                        {{--<td class="footTdLbl" colspan="2">القائم بالعمليه : <span>{{$user->name}}</span></td>--}}
                        {{--@endif--}}

                        @if(isset($requests['product_id']))
                            @php $product=\App\Models\AccountingSystem\AccountingProduct::find($requests['product_id']) @endphp
                            <td class="footTdLbl" colspan="2">الصنف : <span>{{$product->name}}</span></td>
                        @endif
                        {{--@if(isset($requests['session_id']))--}}
                        {{--@php $session=\App\Models\AccountingSystem\AccountingSession::find($requests['session_id']) @endphp--}}
                        {{--<td class="footTdLbl" colspan="2">كود الجلسه : <span>{{$session->code}}</span></td>--}}
                        {{--@endif--}}

                        @if(isset($requests['from']))
                            <td class="footTdLbl" colspan="2"> من:<span>{{$requests['from']}}</span></td>
                        @endif

                        @if(isset($requests['to']))
                            <td class="footTdLbl" colspan="2">إلى :<span>{{$requests['to']}}</span></td>
                        @endif

                    </tr>
                    <tr>
                        <th>#</th>
                        <th> التاريخ</th>
                        <th> إجمالي المبيعات</th>
                        <th> إجمالي الخصومات</th>
                        <th> إجمالي الضريبة</th>
                        <th> إجمالي بعد الخصومات والضريبة</th>

                        <th class="text-center td-display-none">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @php $all_amounts=0; $discounts=0; $total_tax=0; $all_total=0; $sales_count=0; @endphp
                    @foreach($sales as $row)

                        @php $all_amounts+=$row->total_amount; $discounts+=0; $total_tax+=$row->total_tax; $all_total+=$row->total_without_taxes;$sales_count++@endphp

                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! $row->date_formatted !!}</td>
                            <td>{!! $row->total_amount !!}</td>
                            <td>0</td>
                            <td>{!! $row->total_tax !!}</td>
                            <td>{!! $row->total_without_taxes !!}</td>

                            <td class="text-center td-display-none">
                                <a href="{{route('accounting.reports.sale_details',['date'=>$row->date_formatted])}}"
                                   data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse"
                                                                                          style="margin-left: 10px"></i>
                                </a>

                            </td>
                        </tr>

                    @endforeach


                    </tbody>
                    <tfoot>
                    <tr>
                        <td>المجموع</td>
                        <td></td>
                        <td>{{$all_amounts}}</td>
                        <td>{{$discounts}}</td>
                        <td>{{$total_tax}}</td>
                        <td>{{$all_total}}  </td>
                        <td>عدد الفواتير:{{$sales_count}}</td>

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

    @include('AccountingSystem.reports.sales.script')
@stop
