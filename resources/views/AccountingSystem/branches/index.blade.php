@extends('AccountingSystem.layouts.master')
@section('title','عرض الفروع')
@section('parent_title','إدارة فروع الشركات')
@section('action', URL::route('accounting.branches.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل الفروع
            	<div class="btn-group beside-btn-title">
                <a href="{{route('accounting.branches.create')}}" class="btn btn-success">
                   إضافه  فرع  جديد
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
                    <th> اسم الفرع </th>
                    <th> اسم الشركة التابع  لها  </th>
                    <th> جوال الفرع </th>
                    <th> ايميل الفرع </th>
                    <th>  الرصيد العام لخزائن الفرع </th>
                    <th>  الرصيد الفعلى لخزائن الفرع  </th>
                    <th> صورة الفرع </th>
                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($branches as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>

                        <td><a href="{{route('accounting.companies.show',$row->company_id)}}">{!! $row->company->name!!}</a></td>
                        <td>{!! $row->phone!!}</td>
                        <td>{!! $row->email!!}</td>
                        <td>{!! $row->getGeneralBalances()!!}</td>
                        <td>{!! $row->getRealBalances()!!}</td>

                        <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>


                        <td class="text-center">
                            <a href="{{route('accounting.branches.show',$row->id)}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>
                            @can('تعديل الفرع')
                            <a href="{{route('accounting.branches.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                           @endcan
                            @can('حذف الفرع')
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.branches.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
    </script>
@stop
