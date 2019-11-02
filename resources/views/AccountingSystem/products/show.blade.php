@extends('AccountingSystem.layouts.master')
@section('title','عرض المنتجات')
@section('parent_title','إدارة  المنتجات')
@section('action', URL::route('accounting.products.index'))


@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض بيانات المنتج  {!! $product->name !!}</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>



            <div class="panel-group">
                <div class="panel">
                    <div class="panel-heading" style="background: #2ecc71">
                        <h6 class="panel-title">
                            <a data-toggle="collapse" href="#collapsible-styled-group1">بيانات المكان</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group1" class="panel-collapse collapse in">
                        <div class="panel-body">

                            <div class="form-group col-md-4 pull-left" id="store_id">
                                <label> اسم المخزن </label>
                               {!! $store->ar_name !!}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading" style="background: #e74c3c">
                        <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group2">بيانات المنتج</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group col-md-6 pull-left">
                                <label>اسم المنتج </label>
                                {!! $product->name !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label> اسم التصنيف </label>
                                {!! $product->category->ar_name !!}
                            </div>
                            {{--<div class="form-group col-md-6 pull-left">--}}
                                {{--<label>النوع </label>--}}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" id="components_button">--}}
                                    {{--المكونات--}}
                                {{--</button>--}}
                                {{--{!! Form::select("type",['store'=>'مخزون','service'=>'خدمه','offer'=>'مجموعة منتجات ','creation'=>'تصنيع','product_expiration'=>'منتج بتاريخ صلاحيه'],null,['class'=>'form-control js-example-basic-single','placeholder'=>'  نوع المنتج   ','id'=>'type'])!!}--}}
                            {{--</div>--}}
                            {{--<div class="form-group col-md-6 pull-left">--}}
                                {{--<label>الوحدة الاساسية </label><span style="color: #ff0000; margin-right: 15px;">[جرام -كيلو-لتر]</span>--}}
                                {{--<!-- Button trigger modal -->--}}
                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">--}}
                                    {{--الوحدات الفرعية--}}
                                {{--</button>--}}

                                {{--{!! Form::text("main_unit",null,['class'=>'form-control','placeholder'=>'  الوحدة الاساسية '])!!}--}}
                            {{--</div>--}}
                            <div class="form-group col-md-12 pull-left">
                                <label>وصف المنتج </label>
                                {!! $product->description !!}
                            </div>


                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading" style="background: #3498db">
                        <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group3">بيانات البيع</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group col-md-6 pull-left">
                                <label>التفعيل </label>
                              @if ($product->is_active=="1")
                                  مفعل
                                  @else
                                  غير مغعل

                              @endif
                             </div>
                            <div class="form-group col-md-6 pull-left">
                                <label>الباركود </label>
                                {!! $product->bar_code !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label>سعر البيع </label>
                                {!! $product->selling_price !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label>سعر الشراء </label>
                                {!! $product->purchasing_price !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label>الحد الادنى من الكمية </label>
                                {!! $product->min_quantity !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label> الحد الاقصى من الكمية </label>
                                {!! $product->max_quantity !!}
                            </div>

                        </div>
                    </div>
                </div>

                <div class="panel">
                    <div class="panel-heading " style="background: #f1c40f">
                        <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group4">مواصفات أخرى (إختياري)</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="form-group col-md-6 pull-left">
                                <label> الحجم </label>
                                {!! $product->size !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label> اللون </label>
                                {!! $product->color !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label> الارتفاع </label>
                                {!! $product->height !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">

                                <label> العرض </label>
                                {!! $product->width !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label> تاريخ الانتهاء </label>
                                {!! $product->expired_at !!}
                            </div>
                            <div class="form-group col-md-6 pull-left">
                                <label>عدد أيام فترة الركود</label>
                                {!! $product->num_days_recession !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>






    </div>


@endsection

@section('scripts')

    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذة الشركة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الشركة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop