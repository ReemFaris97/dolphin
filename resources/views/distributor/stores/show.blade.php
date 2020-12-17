@extends('distributor.layouts.app')
@section('title')
{{$store->name}}
@endsection
@section('breadcrumb') @php($breadcrumbs=['المستودعات'=>'/stores',$store->name =>'#'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{$store->name}}
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

                <li class="m-portlet__nav-item"></li>
                @if($store->for_distributor==0)
                <li class="m-portlet__nav-item">
                    <a class="btn btn-warning" href="{{route('distributor.stores.addProduct',$store->id)}}">انتاج</a>
                </li>
                @endif
                <li class="m-portlet__nav-item">
                    <a class="btn btn-warning" href="{{route('distributor.stores.moveProduct',$store->id)}}">نقل</a>
                </li>
                <li class="m-portlet__nav-item">
                    <a class="btn btn-warning" href="{{route('distributor.stores.damageProduct',$store->id)}}">اتلاف</a>
                </li>

            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <table class="table table-bordered table-hover ">
            <tbody>
                <tr>
                    <td>
                        الاسم
                    </td>
                    <td>
                        {{$store->name}}
                    </td>
                </tr>
                @if($store->for_distributor==1)
                <tr>
                    <td>
                        المندوب
                    </td>
                    <td>
                        <a href="{!!route('distributor.distributors.show',$store->distributor_id)!!}"
                            class="btn btn-success">
                            <i class="fas fa-eye"></i></a>
                        {{$store->distributor->name}}
                    </td>
                </tr>
                @endif
                <tr>
                    <td>
                        نوع المستودع
                    </td>
                    <td>
                        {{$store->category->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        الملاحظات </td>
                    <td>
                        {{$store->notes}}
                    </td>
                </tr>

            </tbody>
        </table>
        <br>
        <h3> الصنفات</h3>
        <table class="table table-bordered table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف</th>
                    <th> الكود</th>
                    <th> الكميه</th>
                </tr>
            </thead>
            <tbody>
                @foreach($store->totalQuantities ??[] as $product_quantity)

                <tr>
                    <td> {{$loop->iteration}}</td>
                    <td> {{$product_quantity->product->name}}</td>
                    <td> {{$product_quantity->product->bar_code}}</td>
                    <td> {{$product_quantity->total_quantity}}</td>
                </tr>
                @endforeach
            </tbody>



        </table>
        <br>
        <h3> حركه المخزون</h3>
        <table class="table table-bordered table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th> اسم الصنف</th>
                    <th> الكود</th>
                    <th> طبيعة الحركة</th>
                    <th> الكميه</th>
                </tr>
            </thead>
            <tbody>
                @foreach($store->ProductQuantity ??[] as $product_quantity)

                <tr>
                    <td> {{$loop->iteration}}</td>
                    <td> {{$product_quantity->product->name}}</td>
                    <td> {{$product_quantity->product->bar_code}}</td>

                    <td> {{$product_quantity->movement_type}}</td>

                    <td> {{$product_quantity->quantity}}</td>
                </tr>
                @endforeach
            </tbody>



        </table>
    </div>
</div>


@endsection
