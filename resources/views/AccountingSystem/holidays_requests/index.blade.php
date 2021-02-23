@extends('AccountingSystem.layouts.master')
@section('title','عرض  طلبات الاجازات  ')
@section('parent_title','إدارة الموظفين ')
@section('action', URL::route('accounting.holidays-requests.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">  عرض كل طلبات الاجازات
            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.holidays-requests.create')}}" class="btn btn-success">
                إضافه  طلب جديد
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
                    <th> اسم الموظف </th>
                    <th> جنسية الموظف </th>
                    <th>  الفرع </th>
                    <th> نوع الاجازه </th>
                    <th> تاريخ بداية الاجازه </th>
                    <th> تاريخ نهاية الاجازه </th>
                    <th> ملاحظات </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($holidaysRequests as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->typeable->name !!}</td>
                        <td>{{optional($row->typeable)->nationality ?? '---'}}</td>
                        <td>{{optional($row->typeable)->name}}</td>
                        <td>{{$row->holiday->name}}</td>
                        <td>{{optional($row->start_date)->format('Y-m-d')}}</td>
                        <td>{{optional(optional($row->start_date)->addDays($row->days-1))->format('Y-m-d')}}</td>
                        <td>

                        <td class="text-center">
                            <a href="{{route('accounting.holidays-requests.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.holidays-requests.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة  الضريبة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الضريبة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
