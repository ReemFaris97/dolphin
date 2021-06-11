@extends('AccountingSystem.layouts.master')
@section('title','تقرير المبيعات')
@section('parent_title','التقارير ')
{{-- @section('action', URL::route('accounting.purchases.index')) --}}



@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تقرير المبيعات بتاريخ  {{ request('date') }}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

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
                    <th> المدفوع </th>
                    <th> المتبقي </th>
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
                        <td>{!! $row->payed?? 0 !!}</td>
                        <td>{!! ($row->total - $row->payed)?? 0 !!}</td>

                        <td>{!! $row->total?? 0 !!}</td>

                        <td class="text-center td-display-none">
                            <a href="{{route('accounting.sales.show',$row->id)}}" target="_blank" data-toggle="tooltip" data-original-title="تفاصيل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                        </td>
                    </tr>

                @endforeach



                </tbody>
            </table>
	</div>
        </div>
<div class="row print-wrapper">
        	<button class="btn btn-success" id="print-all">طباعة</button>
        </div>

    </div>


@endsection
