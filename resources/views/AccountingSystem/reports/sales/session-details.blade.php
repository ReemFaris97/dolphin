@extends('AccountingSystem.layouts.master')
@section('title','تقرير حركه البيع')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<style>
    .filter {
        margin-bottom: 30px;
    }
</style>
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير حركه البيع</h5>
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
                                @csrf
                            <div class="form-group col-sm-3">
                                <label> الكاشير </label>
                                {!! Form::select("user_id",$sellers, request('user_id'),['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الكاشير','data-live-search'=>'true','id'=>'user_id'])!!}
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="from_date"> من </label>
                                {!! Form::date("from_date",request('from_date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from_date'])!!}
                            </div>
                                <div class="form-group col-sm-3">
                                    <label for="to"> الى </label>
                                    {!! Form::date("to_date",request('to_date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'to_date'])!!}
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
            {{-- <h3>المبيعات</h3> --}}
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th> الموظف </th>
                    <th> التاريخ </th>
                    <th> رقم الفاتوره</th>
                    <th>النوع</th>
                    <th>عدد الاصناف</th>
                    <th>الاجمالى</th>

                </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                    <tr>
                        <td>{{@$sale->user->name}}</td>
                        <td>{{$sale->created_at->format('Y-m-d')}}</td>
                        <td>{{$sale->id}}</td>
                        <td>المبيعات</td>
                        <td>{{$sale->items_count}}</td>
                        <td>{{$sale->amount}}</td>
                    </tr>
                    @endforeach

                    @foreach($returns as $return)
                    <tr>
                        <td>{{@$return->user->name}}</td>
                        <td>{{$return->created_at->format('Y-m-d')}}</td>
                        <td>{{$return->id}}</td>
                        <td>مرتجعات</td>
                        <td>{{$return->items_count}}</td>
                        <td>{{$return->amount}}</td>
                    </tr>
                    @endforeach
                </tbody>

<tfooter style="background-color: rgb(235, 234, 234)">
<tr style="background-color: rgb(235, 234, 234)">
 <td   class="text-center">  البيان</td>
 <td   class="text-center">  العدد</td>
 <td   class="text-center">  الكمية</td>
 <td   class="text-center">  الكاش</td>
 <td   class="text-center">  الشبكة</td>
 <td   class="text-center"> اجمالى الكاش والشبكة</td>
</tr >
                    <tr style="background-color: rgb(235, 234, 234)">
                        <td   class="text-center">  المبيعات</td>
                        {{-- -------------------------------- --}}
                        <td class="text-center">{{$sales->count()}}</td>
                      <td  class="text-center ">
                      {{$total_sales_item=$sales->sum('items_count')}}
                      </td>
                        <td  class="text-center">
                        {{$sales->sum('cash')}}
                        </td>
                        <td  class="text-center">
                        {{$sales->sum('network')}}
                        </td>
                         <td  class="text-center">
                          {{$total_sales_amount=$sales->sum('amount')}}
                        </td>
                    </tr>

                    <tr style="background-color: rgb(235, 234, 234)">
                        <td class="text-center">المرتجعات</td>
                        <td class="text-center">{{$returns->count()}}</td>
                        <td class="text-center">{{$total_returns_item= $returns->sum('items_count')}}</td>
                        <td class=""></td>
                        <td class=" "></td>
                        <td  class="text-center" >{{$total_returns_amount= $returns->sum('amount')}}</td>
                    </tr> 
                    
                    <tr style="background-color: rgb(235, 234, 234)">
                        <td class="text-center">الصافى</td>
                        <td class="hidden d-none"></td>
                        <td class="text-center hidden d-none"></td>

                        <td  class="text-center" class="text-center hidden d-none" ></td>
                        <td class="text-center hidden d-none"></td>

                        <td  class="text-center" colspan="5">{{$total_sales_amount-$total_returns_amount}}</td>
                    </tr>

                </tfooter>
            </table>

        </div>
    </div>

@endsection
