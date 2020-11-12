@extends('AccountingSystem.layouts.master')
@section('title','عرض المستودعات')
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل المستودعات
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.stores.create')}}" class="btn btn-success">
                    إضافه  مستودع  جديد
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
                    <th> اسم المستودع باللغة العربية </th>
                    <th>  نوع المستودع </th>
                    <th>  حالة المستودع </th>
                    <th> كود المستودع </th>
                    {{--<th>  المستودع تابع الى </th>--}}
                    <th> صورة المستودع </th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($stores as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->ar_name!!}</td>
                        <td>@if (  $row->type==1)
                            رئيسى
                                @else
                                فرعى

                        @endif
                           </td>

                        <td>@if (  $row->is_active==1)
                                مفعل
                            @else
                                غير  مفعل

                            @endif
                        </td>

                        <td>{!! $row->code!!}</td>
                        {{--<td>{!! $row->model->name ??''!!}</td>--}}
                        <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>


                        <td class="text-center">
                            <a href="{{route('accounting.stores.product',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="اصناف المستودع "> <i class="icon-cart" style="margin-left: 10px"></i> </a>
                                @if ($row->is_active==0)
                                <a href="{{route('accounting.stores.is_active',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="اصناف المستودع "> <i class="fa fa-close"></i></a>
                                @else
                                <a href="{{route('accounting.stores.dis_active',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="اصناف المستودع "> <i class="icon-checkmark-circle" style="margin-left: 10px"></i> </a>

                            @endif

                            <a href="{{route('accounting.stores.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>
                            @can('تعديل المستودع')
                            <a href="{{route('accounting.stores.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            @endcan
                            @can('حذف المستودع')
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.stores.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}
                                @endcan

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
                text: "هل تريد حذف هذا المستودع ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  المستودع  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
