@extends('distributor.layouts.app')
@section('title')تفاصيل الصنف
@endsection
@section('header')
@endsection
@section('breadcrumb') @php($breadcrumbs=['الاصناف'=>'/products','اضافه'=>'/products/create'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection
@section('content')

<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{$product->name}}
                </h3>
            </div>
        </div>

    </div>
    <div class="m-portlet__body">
        <table class="table table-bordered table-hober">
            <tr>
                <td>الاسم</td>
                <td>{{$product->name}}</td>
            </tr>

            <tr>
                <td>المستودع</td>
                <td>{{$product->store->name}}</td>
            </tr>

            <tr>
                <td>الكمية بالوحدة</td>
                <td>{{$product->quantity_per_unit}}</td>
            </tr>

            <tr>
                <td>الحد الأدنى</td>
                <td>{{$product->min_quantity}}</td>
            </tr>

            <tr>
                <td>الحد الأقصى</td>
                <td>{{$product->max_quantity}}</td>
            </tr>

            <tr>
                <td>السعر</td>
                <td>{{$product->price}}</td>
            </tr>


            <tr>
                <td> الباركود</td>
                <td>
                    <?php echo \Milon\Barcode\DNS1D::getBarcodeHTML($product->bar_code, "C39",1) ?>
                </td>
            </tr>
            <tr>
                <td>قيمة الباركود</td>
                <td>
                    {{$product->bar_code}}
                </td>
            </tr>

            <tr>
                <td>تاريخ انتهاء الصلاحية</td>
                <td>{{$product->expired_at}}</td>
            </tr>



            <tr>
                <td> الصورة الرئيسية</td>
                <td><img src="{!!asset($product->image)!!}" style="width: 100px; height: 100px;"></td>
            </tr>
        </table>

        <hr>
        <h3>شرائح الاسعار</h3>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>الشريحة</th>
                    <th>السعر</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->client_classes as $client_class )
                <tr>
                    <td>{{$client_class->name}}</td>
                    <td>{{$client_class->pivot->price}}</td>

                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
</div>





@endsection


@section('scripts')
@endsection
