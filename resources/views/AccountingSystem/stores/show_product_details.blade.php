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


          <div class="custom-tabs">
        
          <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">بيانات المكان</a></li>
    <li><a data-toggle="tab" href="#menu1">بيانات المنتج</a></li>
    <li><a data-toggle="tab" href="#menu2">بيانات البيع</a></li>
    <li><a data-toggle="tab" href="#menu3">مواصفات أخرى (إختياري)</a></li>
    <li><a data-toggle="tab" href="#menu4">العروض والخصومات</a></li>
    <li><a data-toggle="tab" href="#menu5">الضريبه المضافة</a></li>
  </ul>
              
               <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
        <div class="row">
            <div class="form-group col-md-4 pull-left" id="store_id">
                                <label> اسم المخزن </label>
                               {!! optional($store)->ar_name??"" !!}
                            </div>
        </div>
                   </div>
                   
                   <div id="menu1" class="tab-pane fade">
        <div class="row">
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
                   
                   <div id="menu2" class="tab-pane fade">
        <div class="row">
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
                                <label> الكمية  الموجوده بالمخزن</label>
                                {!! $storeproduct_quantity !!}
                            </div>

                       </div>
                   </div>
                   
                    <div id="menu3" class="tab-pane fade">
                        <div class="row">
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
                   
                   <div id="menu4" class="tab-pane fade">
                        <div class="row">
                            
                            <!--discounts table-->
                            <table id="discountTable" class="table datatable-button-init-basic all">
                                <thead>
                                <tr>
                                    <th>  نوع الخصم</th>
                                    <th> الكمية الاساسية</th>
                                    <th> الكمية  الهدية</th>
                                    <th>   النسبة</th>

                                </tr>
                                </thead>
                                <tbody class="add-discounts">
                                @foreach($discounts as $discount)
                                    @if ($discount->discount_type=="quantity")
                                        <td><label >كميه</label> </td>
                                        @else
                                        <td><label >نسبة</label> </td>

                                    @endif

                                    <td>{!! $discount->quantity !!}</td>
                                    <td>{!! $discount->gift_quantity !!}</td>
                                    <td>{!! $discount->percent !!}</td>
                                @endforeach
                                </tbody>
                            </table>

                            <!-- end table-->
                        </div>
                        </div>
                   
                   <div id="menu5" class="tab-pane fade">
                        <div class="row">
                            @if (isset($tax))


                            <div class="form-group col-md-6 pull-left">
                             @if ($tax->tax==1)

                                    <label> يوجد ضريبه مضافه للمنتج</label>
                                     @if ($tax->price_has_tax==1)

                                            <label>-- السعر  شامل الضريبه المضافة</label>
                                         @else
                                            <label>-- السعر غير شامل الضريبه المضافة</label>
                                        @endif
                                 @else
                                    <label>لا يوجد ضريبه مضافه للمنتج</label>
                             @endif
                                 @endif

                            </div>
                        </div>
                        </div>
                   
              </div>
              
              
              
              
        </div>
        
        

<!--            <div class="panel-group">-->
<!--
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
                               {!! optional($store)->ar_name??"" !!}
                            </div>

                        </div>
                    </div>
                </div>
-->

<!--
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
                                {{-- Button trigger modal --}}
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
-->

<!--
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
-->

<!--
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
-->



<!--
                <div class="panel">
                    <div class="panel-heading " style="background: #8d76a6">
                        <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group5">  العروض والخصومات</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group5" class="panel-collapse collapse">
                        <div class="panel-body">

                            <table id="discountTable" class="table datatable-button-init-basic all">
                                <thead>
                                <tr>
                                    <th>  نوع الخصم</th>
                                    <th> الكمية الاساسية</th>
                                    <th> الكمية  الهدية</th>
                                    <th>   النسبة</th>

                                </tr>
                                </thead>
                                <tbody class="add-discounts">
                                @foreach($discounts as $discount)
                                    @if ($discount->discount_type=="quantity")
                                        <td><label >كميه</label> </td>
                                        @else
                                        <td><label >نسبة</label> </td>

                                    @endif

                                    <td>{!! $discount->quantity !!}</td>
                                    <td>{!! $discount->gift_quantity !!}</td>
                                    <td>{!! $discount->percent !!}</td>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
-->
<!--
                <div class="panel">
                    <div class="panel-heading " style="background: #f58442">
                        <h6 class="panel-title">
                            <a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group6">الضريبه المضافة</a>
                        </h6>
                    </div>
                    <div id="collapsible-styled-group6" class="panel-collapse collapse">
                        <div class="panel-body">
                       @if (isset($tax))


                            <div class="form-group col-md-6 pull-left">
                             @if ($tax->tax==1)

                                    <label> يوجد ضريبه مضافه للمنتج</label>
                                     @if ($tax->price_has_tax==1)

                                            <label>-- السعر  شامل الضريبه المضافة</label>
                                         @else
                                            <label>-- السعر غير شامل الضريبه المضافة</label>
                                        @endif
                                 @else
                                    <label>لا يوجد ضريبه مضافه للمنتج</label>
                             @endif
                                 @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
-->

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