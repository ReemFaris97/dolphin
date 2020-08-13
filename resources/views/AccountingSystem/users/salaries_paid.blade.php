@extends('AccountingSystem.layouts.master')
@section('title','عرض الاعضاء')
@section('parent_title','إدارة اعضاء الادارة')
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض الرواتب المدفوعة</h5>

            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.users.pay_salaries')}}" class="btn btn-success">
                    دفع  راتب  جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
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
                    <th> المسمى الوظيفى </th>
                    <th> الراتب </th>
                    <th> المكافأة  </th>
                    <th> المدفوع  </th>
                    <th> تاريخ الدفع  </th>
                    {{-- <th class="text-center">العمليات</th> --}}
                </tr>
                </thead>
                <tbody>

                @foreach($salaries as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->user->name!!}</td>
                        <td>{!! $row->user->title->name!!}</td>
                        <td>{!! $row->user->salary!!}</td>
                        <td>{!! $row->bouns!!}</td>
                        <td>{!! $row->total_salary!!}</td>
                        <td>{!! $row->created_at!!}</td>
                        {{-- <td class="text-center">
                            <a href="{{route('accounting.user_permissions.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-users" style="margin-left: 10px"></i> </a>

                            <a href="{{route('accounting.users.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>

                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.users.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td> --}}
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
                text: "هل تريد حذف هذة العضو ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  العضو  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
