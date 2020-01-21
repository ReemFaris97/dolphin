@extends('AccountingSystem.layouts.master')
@section('title','عرض  عروض  الاسعار')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل عروض الاسعار</h5>
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
                    <th> اجمالى  سعر العرض </th>
                    <th>الحالة </th>

                    <th class="text-center">العمليات</th>
                </tr>
                </thead>
                <tbody>

                @foreach($packages as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->client->name!!}</td>
                        <td>{!! $row->total!!}</td>

                        <td>
                        @if ($row->status=="pending")
                            <label class="label btn-primary">
                                 قيد الانتظار</label>
                            @elseif ($row->status=="accept")
                                <label class="label btn-success">
                                    تم القبول
                                      </label>
                            @else
                                <label class="label btn-danger">
                                تم  الرفض
                                </label>

                        @endif
                        </td>



                        <td class="text-center">
                            <a href="{{route('accounting.offers.show',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye text-inverse" style="margin-left: 10px"></i> </a>

                            @if ($row->status=="accept")
                                <a href="{{route('accounting.sales.sale_order',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="امر بيع"> <i class="icon-cart-add" style="margin-left: 10px"></i> </a>

                            @endif
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
                text: "هل تريد حذف هذا  العرض ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  العرض  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop
