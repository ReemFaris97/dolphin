@extends('AccountingSystem.layouts.master')
@section('title','  سجل  ارصده  بدايه المده  للاصناف')
@section('parent_title','إدارة  المستودعات')

@section('action', URL::route('accounting.stores.index'))
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> سجل  ارصده  بدايه المده  للاصناف </h5>
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

                    <th>  اسم الصنف  </th>
                    <th>  نوع  الصنف  </th>
                    <th>  الباركود </th>
                    <th> الوحده الاساسية  </th>
                    <th> سعر البيع </th>
                    <th> سعر الشراء </th>
                    <th> الكميه </th>
                    <th> تاريخ التسويه </th>
                    <th> المستودع القائم بالتسويه </th>

                </tr>
                </thead>
                <tbody>

                @foreach($settlements as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>{!! $row->name!!}</td>

                        <td>
                            @if ($row->type=="store")
                                مخزون
                            @elseif($row->type=="service")
                                خدمه
                            @elseif($row->type=="offer")
                                مجموعة اصناف
                            @elseif($row->type=="creation")
                                تصنيع
                            @elseif($row->type=="product_expiration")
                                منتج بتاريخ صلاحيه
                            @endif

                        </td>
                        <td>{!! $row-> bar_code!!}</td>
                        <td>{!! $row->  main_unit!!}</td>
                        <td>{!! $row->selling_price!!}</td>
                        <td>{!! $row->purchasing_price!!}</td>
                        <td>{!! $row->quantity!!}</td>
                        <td>{!! $row->date_settlement!!}</td>
                        <td>{!!optional( $row->storeSettlement)->ar_name!!}</td>

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