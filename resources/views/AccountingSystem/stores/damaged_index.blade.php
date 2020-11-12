@extends('AccountingSystem.layouts.master')
@section('title','سجل  التالف ')
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">سجل التالف </h5>
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

                    <th>  المستودع  </th>
                    <th>  اسم القائم بالجرد </th>
                    <th> التاريخ   </th>
                    <th> عدد الاصناف التام اتلافها   </th>

                    <th class="text-center">تفاصيل </th>
                </tr>
                </thead>
                <tbody>

                @foreach($damages as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! optional($row->store)->ar_name!!}</td>
                        <td>{!! optional($row->user)->name!!}</td>
                        <td>{!! date($row->created_at)!!}</td>

                        <td>{!! $row->productCount()!!}</td>

                        <td class="text-center">

                            <a href="{{route('accounting.stores.show_damaged_products',['id'=>$row->id])}}" data-toggle="tooltip" data-original-title="عرض "> <i class="icon-eye" style="margin-left: 10px"></i> </a>


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