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

                {!!Form::open( ['route' => 'accounting.stores_settle.filter_settlements' ,'class'=>'form phone_validate','id'=>'form', 'method' => 'Post','files' => true]) !!}


                <div class="col-sm-6 col-xs-6 pull-left" >
                    <div class="form-group form-float">
                        <label class="form-label">اختر المخزن</label>
                        <div class="form-line">
                            {!! Form::select("store_id",$stores,null,['class'=>'form-control','id'=>'example-date'])!!}

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

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج </th>
                    <th> نوع المنتج </th>

                    <th>  الباركود </th>
                    <th> الوحده الاساسية  </th>
                    <th> سعر البيع </th>
                    <th> سعر الشراء </th>
                    <th> صورة  المنتج </th>
                    <th>تسويه ارصدة بداية الصنف</th>
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
                        <td>{!! $row->  main_unit!!}</td>
                        <td>{!! $row->  selling_price!!}</td>
                        <td>{!! $row->  purchasing_price!!}</td>
                        <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>
                        <td>
                            {{--<a href="{{route('accounting.products.settlements',['id'=>$row->id])}}" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-original-title="تسوية ارصده البداية "> <i class="icon-eye" style="margin-left: 10px"></i> </a>--}}
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-id="{{$row->id}}" onclick="openModal({{$row->id}})" data-target="#exampleModal" id="products_button">
                                تسوية ارصده البداية
                            </button>
                        </td>
                    </tr>




                @endforeach

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> نسخ الاصناف بالمخزن</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {!!Form::open( ['route' => 'accounting.products_settlement.store' ,'class'=>'form phone_validate', 'method' => 'PATCH','files' => true]) !!}

                            <div class="modal-body">
                            <input type="hidden" name="product_id" id="product_id">

                                <label> الكمية</label>
                                <input type="text" class="form-control" name="quantity">
                                <label>  سعر الوحده</label>
                                <input type="text" class="form-control" name="unit_price">
                                <label>  سعر الشراء</label>
                                <input type="text" class="form-control" name="purchasing_price">
                                <label>  سعر البيع</label>
                                <input type="text" class="form-control"  name="selling_price">




                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button class="btn btn-primary" type="submit" data-dismiss="modal" onclick="this.form.submit()">نسخ الاصناف بالمخزن </button>

                            </div>
                            {!!Form::close() !!}
                        </div>
                    </div>
                </div>
                <!-- end model-->

                </tbody>
            </table>

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
                text: "هل تريد حذف هذا الفرع ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الفرع  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }

        function openModal(id) {
            var item_id = id;

          // alert(item_id);
            $('#product_id').val(item_id);
        }

    </script>
@stop