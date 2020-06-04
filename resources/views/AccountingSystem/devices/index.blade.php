@extends('AccountingSystem.layouts.master')
@section('title','عرض الاجهزة')
@section('parent_title','إدارة  المنتجات')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل الاجهزة</h5>
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

                    <th>اسم الجهاز </th>
                    <th>كود الجهاز </th>
                    <th> الجهاز  تابع الى  </th>


                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($devices as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! $row->code!!}</td>
                        <td>
                        @if($row->model_type=='App\Models\AccountingSystem\AccountingBranch')
                       {!! $row->branch->name!!}
                        @elseif($row->model_type=='App\Models\AccountingSystem\AccountingCompany')
                        {!! $row->company->name!!}</td>
                        @endif

                        <td class="text-center">
                            @can('تعديل الجهاز')
                            <a href="{{route('accounting.devices.edit',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a>
                           @endcan
                                @can('حذف الجهاز')
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.devices.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذا الجهاز ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الجهاز  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
