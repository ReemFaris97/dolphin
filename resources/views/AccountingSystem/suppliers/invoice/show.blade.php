@extends('AccountingSystem.layouts.master')
@section('title','تفاصيل عرض السعر')
@section('parent_title','تفاصيل عرض السعر')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل تفاصيل عرض السعر
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">

            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الصنف</th>
                    <th>الوحدة</th>
                    <th> السعر</th>
                    <th> الكيمة</th>
                    <th>الاجمالي</th>
                    <th> تاريخ الانتهاء ان وجد</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoice->items as $item)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{{ $item->accountingProduct->name}}</td>
                        <td>{{ $item->unit}}</td>
                        <td>{{ $item->price}}</td>
                        <td>{{ $item->quantity}}</td>
                        <td>{{ $item->total}}</td>
                        <td>{{ $item->expire_at}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        @endsection


