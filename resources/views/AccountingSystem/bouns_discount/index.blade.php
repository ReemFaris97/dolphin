@extends('AccountingSystem.layouts.master')
@section('title','عرض  خصومات واضافات ')
@section('parent_title',' أدارة الموظفين ')
@section('action', URL::route('accounting.bonus-discount.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض كل الخصومات والاضافات
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.bonus-discount.create')}}" class="btn btn-success">
                إضافه  خصم واضافة جديد
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
                    <th>اسم الموظف</th>
                    <th>النوع</th>
                    <th>التاريخ</th>
                    <th>القيمة</th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($bouns as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{{$row->typeable->name }}</td>
                        <td>{{$row->type=='bonus'? 'بونص':'خصم'}}</td>
                        <td>{{$row->date}}</td>
                        <td>{{$row->value}}</td>
                        <td class="text-center">
                            <a href="{{route('accounting.bonus-discount.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.bonus-discount.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة  البونص او الخصم ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف   البونص او الخصم   تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
