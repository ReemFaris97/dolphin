@extends('AccountingSystem.layouts.master')
@section('title','عرض اصناف مستودع'.' '. $store->name )
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض اصناف المستودع  {!! $store->ar_name !!}</h5>
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

                    <th>  الباركود </th>
                    <th> الوحده الاساسية  </th>
                    <th> سعر البيع </th>
                    <th> سعر الشراء </th>
                    <th> الكميه الحاليه بالمستودع </th>
                    <th>  حاله المنتج بالمستودع </th>

                    <th> صورة  المنتج </th>
                    <th>عرض  تفاصيل    المنتج </th>
                </tr>
                </thead>
                <tbody>

                @foreach($products_store as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->product->name!!}</td>

                        <td>
                            @if ($row->product->type=="store")
                                مخزون
                            @elseif($row->product->type=="service")
                                خدمه
                            @elseif($row->product->type=="offer")
                                مجموعة اصناف
                            @elseif($row->product->type=="creation")
                                تصنيع
                            @elseif($row->product->type=="product_expiration")
                                منتج بتاريخ صلاحيه
                            @endif
                        </td>
                        <td>{!! $row->product-> bar_code!!}</td>
                        <td>{!! $row->product->  main_unit!!}</td>
                        <td>{!! $row->product->  selling_price!!}</td>
                        <td>{!! $row->product->  purchasing_price!!}</td>
                        <td>
                            @php( $storeproduct_quantity=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$row->product->id)->where('store_id',$store->id)->sum('quantity'))
                            {{ $storeproduct_quantity}}
                        </td>
                        <td>@if (  $row->is_active==1)
                                مفعل
                            @else
                                غير  مفعل
                            @endif
                        </td>
                        <td><img src="{!! getimg($row->product->image)!!}" style="width:100px; height:100px"> </td>
                        <td>
                            @if ($row->is_active==0)
                                <a href="{{route('accounting.stores.is_active_product',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="اصناف المستودع "> <i class="fa fa-close"></i></a>
                            @else
                                <a href="{{route('accounting.stores.dis_active_product',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="اصناف المستودع "> <i class="icon-checkmark-circle" style="margin-left: 10px"></i> </a>

                                @endif

                            <a href="{{route('accounting.stores.show_product_details',['id'=>$row->product->id,'store_id'=>$store->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>

                            <a href="#" onclick="Delete({{$row->product->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.stores.destroy_product',$row->product->id] ,'id'=>'delete-form'.$row->product->id, 'method' => 'Post']) !!}
                          <input type="hidden"  name="store_id" value="{{$store->id}}">
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
                text: "هل تريد حذف هذا المنتج  من المستودع ؟",
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
