@extends('AccountingSystem.layouts.master')
@section('title','عرض اوامر التوريد')
@section('parent_title','إدارة اوامر التوريد')
@section('action', URL::route('accounting.supply-requisitions.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">تفاصيل امر التوريد
                <div class="btn-group beside-btn-title">
                    <a href="{{route('accounting.supply-requisitions.create')}}" class="btn btn-success">
                        إضافه امر توريد جديد
                        <span class="m-l-5"><i class="fa fa-plus"></i></span>
                    </a>
                </div>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="">
            <div class="">
                <div class="">
                    <div>
                        <div class="row">

                            <div class="form-group col-md-6 pull-left">
                                <label> الشركة التوريد</label>
                                <input type="text" class="form-control" readonly value="{{$supplyRequisition->company->name}}">
                            </div>


                            <div class="form-group col-md-6 pull-left">
                                <label> الفرع</label>
                                <input type="text" class="form-control" readonly value="{{$supplyRequisition->branch->name}}">

                            </div>

                            <div class="form-group col-md-4 pull-left">
                                <label>المورد </label>
                                <input type="text" class="form-control" readonly value="{{$supplyRequisition->supplier->name}}">

                            </div>
                            <div class="form-group col-md-4 pull-left">
                                <label>منشئ الطلب </label>
                                <input type="text" class="form-control" readonly value="{{$supplyRequisition->creator->name}}">
                            </div>

                            <div class="form-group col-md-4 pull-left">
                                <label>تاريخ الانشاء </label>
                                <input type="text" class="form-control" readonly value="{{$supplyRequisition->created_at}}">
                            </div>

                            <div class="form-group col-md-6 pull-left">
                                <label>معتمد الطلب </label>
                                <input type="text" class="form-control" readonly value="{{@$supplyRequisition->approver->name}}">
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label>تاريخ اعتماد الطلب </label>
                                <input type="text" class="form-control" readonly value="{{@$supplyRequisition->approved_at}}">
                            </div>

                            <div class="col-md-12">
                                <table class="table finalTb table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>اسم المنتج</th>
                                        <th>باركود</th>
                                        <th>الوحدة</th>
                                        <th>الكمية المطلوب</th>
                                    </tr>
                                    </thead>
                                    <tbody id="products-list">
                                    @foreach($supplyRequisition->items as $item)
                                        <td>{{$item->product->name}}</td>
                                        <td>{{Arr::first($item->product->bar_code)}}</td>
                                        <td>{{$item->unit}}</td>
                                        <td>{{$item->quantity}}</td>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>


                @endsection
