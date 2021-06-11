@extends('AccountingSystem.layouts.master')
@section('title','سجل  سندات الجرد ')
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">سجل سندات الجرد </h5>
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
                    <th>  رقم السند  </th>
                    <th>  المستودع  </th>
                    <th>  اسم القائم بالجرد </th>
                    <th> التاريخ   </th>


                    <th class="text-center">تفاصيل السند</th>
                </tr>
                </thead>
                <tbody>

                @foreach($inventories as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! isset($row->bond_num)?$row->bond_num: ""  !!}</td>
                        <td>{!! optional($row->store)->ar_name!!}</td>

                        <td>{!! $row->user->name!!}</td>
                        <td>{!! $row->date!!}</td>


                        <td class="text-center">

                            <a href="{{route('accounting.stores.show_inventory_band',$row->id)}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>


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
