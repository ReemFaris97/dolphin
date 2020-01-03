@extends('AccountingSystem.layouts.master')
@section('title','عرض  تسوية الجرد' )
@section('parent_title','إدارة  المخازن')

@section('action', URL::route('accounting.stores.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> عرض تسوية جرد</h5>
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
                        <th> اسم الصنف   </th>
                        <th>  الكمية  </th>
                        <th> الكميه الفعليه </th>


                        <th class="text-center">النتائج</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($inventory_products as $row)
                        <tr>
                            <td>{!!$loop->iteration!!}</td>
                            <td>{!! $row->product->name!!}</td>

                            <td>{!! $row->quantity!!}</td>
                            <td>{!! $row->Real_quantity!!}</td>



                            <td class="text-center">
                                @if ($row->quantity > $row->Real_quantity)

                                    <label class="btn btn-danger">قيمه العجز بالمخزن ={!! $row->quantity - $row->Real_quantity!!}</label>
                               @elseif($row->quantity < $row->Real_quantity)
                                    <label class="btn btn-success">قيمه الزياده بالمخزن ={!! $row->Real_quantity - $row->quantity!!}</label>
                                @else
                                    <label class="btn btn-warning"> الكميات  متساويه</label>

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
                text: "هل تريد حذف هذة الشركة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الشركة  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop