@extends('AccountingSystem.layouts.master')
@section('title','عرض البنود ')
@section('parent_title','إدارة  البنود')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل  تسجيلات البنود </h5>
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
                    <th> نوع البند</th>
                    <th> اسم  البند </th>
                    <th>   رقم السند </th>

                    <th> التاريخ </th>
                    <th> البيان</th>
                    <th> الصوره  </th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($benods as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>


                        <td>@if ($row->type=="expenses")

                                <label class="label label-info"> مصروف</label>
                                @else
                                <label class="label label-success"> ايراد</label>
                        @endif

                        </td>

                        <td>{!! $row->clause->ar_name !!}</td>
                        <td>{!! $row->sanad_num!!}</td>
                        <td>{!! $row->date!!}</td>
                        <td>{!! $row->desc!!}</td>
                        <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>


                        <td class="text-center">
                            <a href="{{route('accounting.benods.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.benods.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذا البند ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  البند  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
