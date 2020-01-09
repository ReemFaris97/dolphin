@extends('AccountingSystem.layouts.master')
@section('title','تسوية أرصدة بداية كمية الاصناف ')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  تسوية ارصده بداية كمية الاصناف</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">


                {!!Form::open( ['route' => 'accounting.products_settlement.store' ,'class'=>'form phone_validate', 'method' => 'PATCH','files' => true]) !!}

                <div class="form-group col-md-4 pull-left">
                    <label>اختر المخزن منه </label>
                    {!! Form::select("store_id",allstores(),null,['class'=>'form-control js-example-basic-single form_store_id','id'=>'form_store_id','placeholder'=>' اختر  المخزن'])!!}
                </div>
                <div class="form-group col-md-4 pull-left">
                    <label>اختر الصنف </label>
                    {!! Form::select("product_id[]",products_not_settement(),null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id','placeholder'=>' اختر  الصنف'])!!}
                </div>



            </div>
        </div>
        <!--End Page-Title -->

        <div class="panel-body">


            <div class="products">

            </div>

            <div class="text-center col-md-12">
                <div class="text-right">
                    <button type="submit" class="btn btn-success" onclick="this.form.submit()"> تسويه رصيد<i class="icon-arrow-left13 position-right"></i></button>
                </div>
            </div>



            {!!Form::close() !!}

            {{--<table class="table datatable-button-init-basic">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th>#</th>--}}
                    {{--<th> اسم المنتج </th>--}}
                    {{--<th> نوع المنتج </th>--}}

                    {{--<th>  الباركود </th>--}}
                    {{--<th> الوحده الاساسية  </th>--}}
                    {{--<th> سعر البيع </th>--}}
                    {{--<th> سعر الشراء </th>--}}
                    {{--<th>  الكميه </th>--}}
                    {{--<th> صورة  المنتج </th>--}}
                    {{--<th>تسويه ارصدة بداية الصنف</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}

                {{--@foreach($products as $row)--}}
                    {{--<tr>--}}
                        {{--<td>{!!$loop->iteration!!}</td>--}}
                        {{--<td>{!! $row->name!!}</td>--}}

                        {{--<td>--}}
                            {{--@if ($row->type=="store")--}}
                                {{--مخزون--}}
                            {{--@elseif($row->type=="service")--}}
                                {{--خدمه--}}
                            {{--@elseif($row->type=="offer")--}}
                                {{--مجموعة منتجات--}}
                            {{--@elseif($row->type=="creation")--}}
                                {{--تصنيع--}}
                            {{--@elseif($row->type=="product_expiration")--}}
                                {{--منتج بتاريخ صلاحيه--}}
                            {{--@endif--}}

                        {{--</td>--}}
                        {{--<td>{!! $row-> bar_code!!}</td>--}}
                        {{--<td>{!! $row->  main_unit!!}</td>--}}
                        {{--<td>{!! $row->  selling_price!!}</td>--}}
                        {{--<td>{!! $row->  purchasing_price!!}</td>--}}
                        {{--<td>{!! $row->  quantity!!}</td>--}}
                        {{--<td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>--}}
                        {{--<td>--}}
                            {{--<a href="{{route('accounting.products.settlements',['id'=>$row->id])}}" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-original-title="تسوية ارصده البداية "> <i class="icon-eye" style="margin-left: 10px"></i> </a>--}}
                            {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$row->id}}" onclick="openModal({{$row->id}})" data-target="#exampleModal" id="products_button">--}}
                                {{--تسوية ارصده البداية--}}
                            {{--</button>--}}
                        {{--</td>--}}
                    {{--</tr>--}}




                {{--@endforeach--}}

                {{--<!-- Modal -->--}}
                {{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
                    {{--<div class="modal-dialog" role="document">--}}
                        {{--<div class="modal-content">--}}
                            {{--<div class="modal-header">--}}
                                {{--<h5 class="modal-title" id="exampleModalLabel"> تسويه اؤصد الاصناف </h5>--}}
                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                    {{--<span aria-hidden="true">&times;</span>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                            {{--{!!Form::open( ['route' => 'accounting.products_settlement.store' ,'class'=>'form phone_validate', 'method' => 'PATCH','files' => true]) !!}--}}

                            {{--<div class="modal-body">--}}
                            {{--<input type="hidden" name="product_id" id="product_id">--}}

                                {{--<label> الكمية</label>--}}
                                {{--<input type="text" class="form-control" name="quantity">--}}
                                {{--<label>  سعر الوحده</label>--}}
                                {{--<input type="text" class="form-control" name="unit_price">--}}
                                {{--<label>  سعر الشراء</label>--}}
                                {{--<input type="text" class="form-control" name="purchasing_price">--}}
                                {{--<label>  سعر البيع</label>--}}
                                {{--<input type="text" class="form-control"  name="selling_price">--}}




                            {{--</div>--}}
                            {{--<div class="modal-footer">--}}
                                {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>--}}
                                {{--<button class="btn btn-primary" type="submit" data-dismiss="modal" onclick="this.form.submit()">نسخ الاصناف بالمخزن </button>--}}

                            {{--</div>--}}
                            {{--{!!Form::close() !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- end model-->--}}

                {{--</tbody>--}}
            {{--</table>--}}

        </div>

    </div>


@endsection

@section('scripts')

    <script src="{{asset('admin/assets/js/get_products_settlement_by_store.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script>
        $(".product_id").on('change', function() {

            var store_id = $('#form_store_id').val();

            var id = $(this).val();
            console.log(id);

            $.ajax({
                url:"/accounting/productsettlement",
                type:"get",
                data:{'ids':id,'store_id':store_id}

            }).done(function (data) {

                $('.products').html(data.data);
            }).fail(function (error) {
                console.log(error);
            });

        });

    </script>

    <script>
        $(".quantity").on('change', function() {


            var quantity = $(this).val();
            var selling_price = $(".selling_price").val();
            var purchasing_price = $(".purchasing_price").val();
            var cost=quantity*selling_price;
            var  price=quantity*purchasing_price;
            $(".cost").empty()

            $(".cost").append('<div class="form-group col-md-4 pull-left"> <label> التكلفة</lable> <input type="text" name="cost" value="' + cost + '"  class="form-control" readonly> </div>');
            $(".price").empty()
            $(".price").append('<div class="form-group col-md-4 pull-left"> <label> القيمة</lable> <input type="text" name="price" value="' + price + '"  class="form-control" readonly> </div>');

        });

    </script>
@stop