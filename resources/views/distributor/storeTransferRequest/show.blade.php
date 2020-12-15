@extends('distributor.layouts.app')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    عرض عمليات النقل
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

            </ul>
        </div>
    </div>
    <div class="m-portlet__body">
        <table class="table table-bordered table-hover ">
            {{-- 'sender_id',
    'distributor_id', 'is_confirmed', 'sender_store_id',
        'distributor_store_id','receiver_store_id'
     --}}

            <tbody>
                <tr>
                    <td>
                        من المندوب
                    </td>
                    <td>
                        {{$store->sender->name}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        من مستودع
                    </td>

                    <td>
                        {{$store->sender_store->name}}
                    </td>
                </tr>
                <tr>
                    <td>
                        الى المندوب
                    </td>
                    <td>
                        {{$store->distributor->name}}
                    </td>
                  </tr>
                  <tr>
                    <td>
                        الى مستودع
                    </td>

                    <td>
                        {{$store->receiver_store->name}}
                    </td>
                </tr>

            </tbody>
        </table>
        <br>
        <h3> المنتجات</h3>
        <table class="table table-bordered table-hover ">
            <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج</th>
                    <th> الكود</th>
                    <th> الكميه</th>
                </tr>
            </thead>
            <tbody>
                @foreach($store->productQuantities ??[] as $product_quantity)

                <tr>
                    <td> {{$loop->iteration}}</td>
                    <td> {{$product_quantity->product->name}}</td>
                    <td> {{$product_quantity->product->bar_code}}</td>
                    <td> {{$product_quantity->quantity}}</td>
                </tr>
                @endforeach
            </tbody>



        </table>
    </div>
</div>


@endsection
