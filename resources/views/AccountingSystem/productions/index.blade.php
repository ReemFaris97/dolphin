@extends('AccountingSystem.layouts.master')
@section('title','عرض  أوامر التصنيع')
@section('parent_title','إدارة   التصنيع  ')
@section('action', URL::route('accounting.productions.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض   أوامر التصنيع
            	<div class="btn-group beside-btn-title">
                <a href="{{route('accounting.productions.create')}}" class="btn btn-success">
                   إضافه     أمر تصنيع  جديد
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
                    <th> اسم الشركة </th>
                    <th> اسم خط الانتاج </th>
                    <th>حالة الامر</th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($productions as $row)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                         <td>{{$row->company->name}}</td>
                         <td>{{$row->production_line->name}}</td>
                         <td>{{$row->status=='new' ? 'جديد':'تم التصنيع'}}</td>

                        <td class="text-center">
                            <a href="{{route('accounting.productions.show',$row->id)}}" title="عرض"
                               data-toggle="tooltip" data-original-title="عرض">
                                <i class="icon-eye text-inverse" style="margin-left: 10px"></i>
                            </a>

                            <a href="{{route('accounting.productions.edit',$row->id)}}"
                               data-toggle="tooltip" data-original-title="تعديل">
                                <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                            </a>

                            <a href="#" onclick="Delete({{$row->id}})"
                               data-toggle="tooltip" data-original-title="حذف">
                                <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                            </a>

                            {!!Form::open( ['route' => ['accounting.productions.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذا الامر ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الامر  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop