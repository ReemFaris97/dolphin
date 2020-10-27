@extends('AccountingSystem.layouts.master')
@section('title','عرض المنتجات')
@section('parent_title','إدارة  المنتجات')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل المنتجات

            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.products.create')}}" class="btn btn-success">
                    إضافه منتج  جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
            </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <table class="table datatable-button-init-basic">
                <thead>
                <tr>
                    <th>#</th>
                    <th> اسم المنتج </th>
                    <th> نوع المنتج </th>
                    <th>  الكمية </th>
                    <th>  الباركود </th>
                    <th> الوحده الاساسية  </th>
                    <th> سعر البيع </th>
                    <th> سعر الشراء </th>
                    <th> صورة  المنتج </th>
                    <th class="text-center">العمليات</th>
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
                        <td>{!! $row->getTotalQuantities()!!}</td>
                        <td>{!! $row->bar_code!!}</td>
                        <td>{!! $row->main_unit!!}</td>
                        <td>{!! $row->selling_price!!}</td>
                        <td>{!! $row->purchasing_price!!}</td>
                        <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>

                        <td class="text-center">
                            <a href="{{route('accounting.products.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>
                            <a href="{{route('accounting.products.barcode',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-barcode2" style="margin-left: 10px"></i> </a>

                            <a href="{{route('accounting.products.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>
                            {!!Form::open( ['route' => ['accounting.products.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach



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
                text: "هل تريد حذف هذة  المنتج ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  المنتج  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
