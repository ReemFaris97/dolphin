@extends('AccountingSystem.layouts.master')
@section('title','عرض  فواتير  مرتجعات المشتريات')
@section('parent_title','إدارة  المشتريات ')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض فواتير مرتجعات المشتريات</h5>
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
                    <th> تاريخ الفاتورة </th>
                    <th>    رقم الفاتورة  الاساسيى</th>
                    <th>اسم المورد</th>
                    <th>  الإجمالي </th>




                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($puchaseReturns as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->bill_date!!}</td>
                        <td>{!! $row->bill_num!!}</td>
                        <td>{!! optional($row->supplier)->name!!}</td>

                        <td>{!! $row->total !!}</td>

                        <td class="text-center">
                            <a href="{{route('accounting.puchaseReturns.show',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                            {{-- <a href="{{route('accounting.puchaseReturns.edit',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"> <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i> </a> --}}
                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"> <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i> </a>

                            {!!Form::open( ['route' => ['accounting.puchaseReturns.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                text: "هل تريد حذف هذة  الفاتورة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الفاتورة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
