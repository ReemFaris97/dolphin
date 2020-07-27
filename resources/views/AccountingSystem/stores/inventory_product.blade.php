@extends('AccountingSystem.layouts.master')
@section('title','  جرد الاصناف ')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  جرد الاصناف</h5>
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

                {!!Form::open( ['route' => 'accounting.stores.filter_inventory_product' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{--<div class="col-sm-6 col-xs-6 pull-left" >--}}
                    {{--<div class="form-group form-float">--}}
                        {{--<label class="form-label"> رقم السند</label>--}}
                        {{--<div class="form-line">--}}
                            {{--{!! Form::text("bond_num",null,['class'=>'form-control','placeholder'=>'رقم السند'])!!}--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="col-sm-6 col-xs-6 pull-left" >--}}
                    {{--<div class="form-group form-float">--}}
                        {{--<label class="form-label"> بيان السند</label>--}}
                        {{--<div class="form-line">--}}
                            {{--{!! Form::text("description",null,['class'=>'form-control','placeholder'=>'بيان السند'])!!}--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}

                <div class="col-sm-6 col-xs-6 pull-left">
                    <label>اختر الصنف </label>
                    {!! Form::select("product_id",$products,null,['class'=>'form-control js-example-basic-single store_id','placeholder'=>' اختر  الصنف'])!!}
                </div>






                <div class="col-sm-6 col-xs-6 pull-left" >
                    <div class="form-group form-float">
                        <label class="form-label">تاريخ الجرد</label>
                        <div class="form-line">
                            {!! Form::date("date",null,['class'=>'form-control','id'=>'example-date'])!!}

                        </div>
                    </div>
                </div>


                <div class="text-center col-md-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-success">بحث<i class="icon-arrow-left13 position-right"></i></button>
                    </div>
                </div>

                {!!Form::close() !!}
            </div>
        </div>
        <!--End Page-Title -->
        @if (isset($product))

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>

                    <th> اسم المنتج </th>
                    <th> نوع المنتج </th>

                    <th>  الباركود </th>

                    <th>الكمية الاساسية </th>


                    <th> الكميه الفعليه</th>
                </tr>
                </thead>
                <tbody>




                    <tr>
                        {{--<td>{!!$loop->iteration!!}</td>--}}
                        <td>{!! $product->name!!}</td>

                        <td>
                            @if ($product->type=="store")
                                مخزون
                            @elseif($product->type=="service")
                                خدمه
                            @elseif($product->type=="offer")
                                مجموعة منتجات
                            @elseif($product->type=="creation")
                                 تصنيع
                            @elseif($product->type=="product_expiration")
                                منتج بتاريخ صلاحيه
                            @endif

                        </td>
                        <td>{!! $product-> bar_code!!}</td>
                        <td>{!! $stores_quantity !!}</td>

                        <td>
                            @if ($product->status==0)

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$product->id}}" onclick="openModal({{$product->id}})" data-target="#exampleModal{{$product->id}}" id="button{{$product->id}}">
                                    ادخل  الكميه الفعليه
                                </button>

                                @else
                                <label class="btn-success" id="done">تم التسوية</label>
                            @endif

                            <span id="qty{{$product->id}}"></span>
                        </td>
                    </tr>







                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> اضافه  الكميه الفعلية </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{--{!!Form::open( ['route' => 'accounting.inventory_settlement.store' ,'class'=>'form phone_validate','method' => 'PATCH','files' => true]) !!}--}}
                            <form id="form{{$product->id}}" >
                                <input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">

                            <div class="modal-body">
                            <input type="hidden" name="product_id" class="product_id">
                                @isset($inventory)
                                <input type="hidden" name="inventory_id" value="{{$inventory->id}}">
                                @endisset
                                <label> الكميه الفعليه</label>
                                <input type="text" class="form-control" name="Real_quantity" id="Real_quantity{{$product->id}}">

                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button class="btn btn-primary" id="hamada{{$product->id}}" type="button" data-dismiss="modal" > اضافةالكميه الفعليه</button>

                            </div>
                            </form>
                            {{--{!!Form::close() !!}--}}
                        </div>
                    </div>
                </div>
                <!-- end model-->



                </tbody>
            </table>

            @isset($inventory)

                <a href="{{route('accounting.stores.inventory_result',$inventory->id)}}"><label class="btn btn-danger">تسوية</label></a>
            @endif
        </div>
        @endif
    </div>


@endsection

@section('scripts')

    <script>



            function openModal(id) {

         $('.product_id').val(id);
         var  token=$('#csrf_token').val();

            $(`#hamada${id}`).click(function (e) {
                e.preventDefault();
                // alert('dsa');
                // var form = $(`form${id}`);
                // console.log(form);
                var real_quantity=$('#Real_quantity'+id).val()

                $.ajax({
                    type: "post",

                    url: '{{route('accounting.inventory_settlement.store')}}',
                    data:   $('#form'+id).serialize()+"&_token="+token,
                    success: function (data) {
                        $('#button'+id).remove();

                        $('#qty'+id).html(real_quantity);
                    },error:function (data) {
                        console.log(data);
                    }
                });
            })

            }

   </script>
    <script src="{{asset('admin/assets/js/get_keepers_by_store.js')}}"></script>

@stop
