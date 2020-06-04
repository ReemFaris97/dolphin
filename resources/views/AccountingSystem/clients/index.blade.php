@extends('AccountingSystem.layouts.master')
@section('title','عرض العملاء')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل  العملاء</h5>
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
                    <th> اسم العميل </th>
                    <th> الايميل </th>
                    <th> التصنيف </th>
                    <th> قائمة الاسعار </th>
                    <th> السياسه الائتمانيه </th>
                    <th>  التعاملات الضربيه </th>
                    <th> رصيد العميل </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($clients as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! $row->email!!}</td>
                        <td>@if ($row->category=="1")
                            شركات
                                @else
                                افرداد
                        @endif
                           </td>
                        <td>{!! $row->type_price!!}</td>
                        <td>
                            @if ($row->credit=="1")
                                حد دين
                            @else
                               فتره دين
                            @endif
                        </td>
                        <td>

                            @if ($row->taxes_status=="1")
                                خاضع للضرائب
                            @else
                           معفى  من الضرائب
                            @endif

                        </td>
                        <td>{!! $row->amount!!}</td>

                        <td class="text-center">
                            @can('تعديل العميل')
                            <a href="{{route('accounting.clients.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            @endcan
                             @can('حذف العميل')
                              <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.clients.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذا  العميل ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف   العميل  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
