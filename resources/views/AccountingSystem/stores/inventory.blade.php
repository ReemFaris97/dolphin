@extends('AccountingSystem.layouts.master')
@section('title','  جرد المخازن ')
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  جرد المخازن</h5>
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

                {!!Form::open( ['route' => 'accounting.stores.filter_inventory' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}


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
                    <label>اختر المخزن </label>
                    {!! Form::select("store_id",allstores(),null,['class'=>'form-control js-example-basic-single store_id','placeholder'=>' اختر  المخزن'])!!}
                </div>

                <div class="col-sm-6 col-xs-6 pull-left">
                    <label>اختر امين المخزن </label>
                    {!! Form::select("user_id",keepers(),null,['class'=>'form-control js-example-basic-single storekeeper_id','id'=>'storekeeper_id','placeholder'=>' اختر امين المخزن'])!!}
                </div>




                <div class="col-sm-6 col-xs-6 pull-left" >
                    <div class="form-group form-float">
                        <label class="form-label">تاريخ الجرد</label>
                        <div class="form-line">
                            <?php
                            $mytime = Carbon\Carbon::now();
                            $date= $mytime->toDateTimeString();
                            ?>
                          <input type="text" name="date" value="{{$date}}" class="form-control" readonly>

                        </div>
                    </div>
                </div>


                <div class="form-group col-xs-6 pull-left">
                    <label class="display-block text-semibold">  نوع  التحمل</label>
                    <label class="radio-inline">
                        <input type="radio" name="cost_type" class="styled"    value="1">
                        الشركة
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="cost_type"  class="styled "    value="0">
                        امين المخزن
                    </label>
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

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج </th>
                    <th> نوع المنتج </th>

                    <th>  الباركود </th>

                    <th>الكمية الاساسية </th>


                    <th> الكميه الفعليه</th>
                </tr>
                </thead>
                <tbody>

                @foreach($products as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>

                        <td>
                            @if ($row->type=="store")
                                مخزون
                            @elseif($row->type=="service")
                                خدمه
                            @elseif($row->type=="offer")
                                مجموعة منتجات
                            @elseif($row->type=="creation")
                                 تصنيع
                            @elseif($row->type=="product_expiration")
                                منتج بتاريخ صلاحيه
                            @endif

                        </td>
                        <td>{!! $row-> bar_code!!}</td>
                        <td>{!! $row->  quantity!!}</td>

                        <td>
                            @if ($row->status==0)

                                <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$row->id}}" onclick="openModal({{$row->id}})" data-target="#exampleModal{{$row->id}}" id="button{{$row->id}}">
                                   ادخل  الكميه الفعليه
                                </button>

                                @else
                                <label class="btn-success" id="done">تم التسوية</label>
                            @endif

                        </td>
                    </tr>




                @endforeach

                @foreach($products as $row)
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> اضافه  الكميه الفعلية </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{--{!!Form::open( ['route' => 'accounting.inventory_settlement.store' ,'class'=>'form phone_validate','method' => 'PATCH','files' => true]) !!}--}}
                            <form id="form{{$row->id}}" >
                                <input type="hidden" name="csrf_token" id="csrf_token" value="{{ csrf_token() }}">

                            <div class="modal-body">
                            <input type="hidden" name="product_id" class="product_id">
                                @isset($inventory)
                                <input type="hidden" name="inventory_id" value="{{$inventory->id}}">
                                @endisset
                                <label> الكميه الفعليه</label>
                                <input type="text" class="form-control" name="Real_quantity">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button class="btn btn-primary" id="hamada{{$row->id}}" type="button" data-dismiss="modal" > اضافةالكميه الفعليه</button>
                            </div>
                            </form>
                            {{--{!!Form::close() !!}--}}
                        </div>
                    </div>
                </div>
                <!-- end model-->
                    @endforeach


                </tbody>
            </table>
            @isset($inventory)

                <a href="{{route('accounting.stores.inventory_result',$inventory->id)}}"><label class="btn btn-danger">تسوية</label></a>
            @endif
        </div>

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


                $.ajax({
                    type: "post",

                    url: '{{route('accounting.inventory_settlement.store')}}',
                    data:   $('#form'+id).serialize()+"&_token="+token,
                    success: function (data) {

                        $('#button'+id).remove();



                    },error:function (data) {
                        console.log(data);
                    }

                });
            })

            }

   </script>
    <script src="{{asset('admin/assets/js/get_keepers_by_store.js')}}"></script>

@stop