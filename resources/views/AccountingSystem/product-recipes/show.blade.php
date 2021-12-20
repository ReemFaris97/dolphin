@extends('AccountingSystem.layouts.master')
@section('title','عرض مكونات الصنف '.' '. $product->product->name )
@section('parent_title','إدارة   المنتجات المصنعة')
@section('action', URL::route('accounting.product-recipes.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض  مكونات الصنف /  {{ $product->product->name  }}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="clearfix"></div>
            <h4>عرض المنتجات</h4>
            <div class="form-group col-md-12 pull-left">
                <table class="table init-basic">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الصنف</th>
                        <th>الوحدة</th>
                        <th>الكمية</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->items as $index=>$item)
                        <tr>
                            <td> {{$index+1}}</td>
                            <td> {{$item->product->name}}</td>
                            <td> {{$item->unit->name ?? $item->product->main_unit}}</td>
                            <td> {{$item->quantity}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

