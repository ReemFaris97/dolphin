@extends('distributor.layouts.app')
@section('title')تفاصيل المنتج
@endsection
@section('header')
@endsection
@section('breadcrumb') @php($breadcrumbs=['الاصناف'=>'/products','اضافه'=>'/products/create'])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection
@section('content')
    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-demo__preview  m-demo__preview--btn">
            </div>
        </div>
    </div>


    <div class="m-section__content">
        <div class="m-demo" data-code-preview="true" data-code-html="true" data-code-js="false">
            <div class="m-portlet__body">

                <div class="col-xs-4">
                    <h5>الاسم</h5>
                    <h3>{{$product->name}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>المستودع</h5>
                    <h3>{{$product->store->name}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>الكمية بالوحدة</h5>
                    <h3>{{$product->quantity_per_unit}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>الحد الأدنى</h5>
                    <h3>{{$product->min_quantity}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>الحد الأقصى</h5>
                    <h3>{{$product->max_quantity}}</h3>
                </div>

                <div class="col-xs-4">
                    <h5>السعر</h5>
                    <h3>{{$product->price}}</h3>
                </div>


                <div class="col-xs-4">
                    <h5> الباركود</h5>
                    <h3>
                        <?php echo \Milon\Barcode\DNS1D::getBarcodeHTML($product->bar_code, "C39",1) ?>
                    </h3>
                </div>
                <div class="col-xs-4">
                    <h5>قيمة الباركود</h5>
                    <h3>
                       {{$product->bar_code}}
                    </h3>
                </div>

                <div class="col-xs-4">
                    <h5>تاريخ انتهاء الصلاحية</h5>
                    <h3>{{$product->expired_at}}</h3>
                </div>



                <div class="col-xs-4">
                    <h5> الصورة الرئيسية</h5>
                    <h3><img src="{!!asset($product->image)!!}" style="width: 300px; height: 300px;"></h3>
                </div>


                <div class="col-xs-4">
                    <h5> صور المنتج</h5>
                    @foreach(\App\Models\Image::where('model_type','App\Models\Product')->where('model_id',$product->id)->get() as $image)
                  <img src="{!!asset($image->image)!!}" style="width: 300px; height: 300px;">
                        @endforeach
                </div>

            </div>
        </div>
    </div>





@endsection


@section('scripts')
@endsection
