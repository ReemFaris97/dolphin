@extends('AccountingSystem.layouts.master')
@section('title','عرض الموردين')
@section('parent_title','إدارة  الموردين')
@section('action', URL::route('accounting.suppliers.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل الموردين

            <div class="btn-group beside-btn-title">
                <a href="{{route('accounting.suppliers.create')}}" class="btn btn-success">
                    إضافه  مورد  جديد
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
                    <th> اسم المورد</th>
                    <th>الشركات المورده</th>

                    <th>رصيد المورد</th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($suppliers as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>

                            @foreach ($row->companies as $company)
                                <li>{{$company->company->name}}</li>

                            @endforeach
                        </td>

                        <td>{!! $row->balance!!}</td>

                        <td>
                            <a href="{{route('accounting.suppliers.show',$row->id)}}" data-toggle="tooltip"
                               data-original-title="كشف سداد  ">كشف حساب  </a>
                            @can('تعديل مورد')
                            <a href="{{route('accounting.suppliers.edit',$row->id)}}" data-toggle="tooltip"
                               data-original-title="تعديل">تعديل </a>
                            @endcan
                            @if ($row->is_active==0)
                                <a href="{{route('accounting.suppliers.is_active',$row->id)}}"
                                   data-toggle="tooltip" data-original-title=" تفعيل "> تفعيل</a>
                            @else
                                <a href="{{route('accounting.suppliers.dis_active',$row->id)}}"
                                   data-toggle="tooltip" data-original-title=" الغاء التفيل">الغاء التفعيل </a>
                            @endif
                            @can('حذف المورد')
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف">
                                حذف</a>

                            {!!Form::open( ['route' => ['accounting.suppliers.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
            var item_id = id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا  المورد ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function (isConfirm) {
                if (isConfirm) {
                    document.getElementById('delete-form' + item_id).submit();
                } else {
                    swal("تم االإلفاء", "حذف  الوجة  تم الغاؤه", 'info', {buttons: 'موافق'});
                }
            });
        }
    </script>
@stop
