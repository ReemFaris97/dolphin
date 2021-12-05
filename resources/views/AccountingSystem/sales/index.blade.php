@extends('AccountingSystem.layouts.master')
@section('title','عرض  الفواتير')
@section('parent_title','إدارة  المبيعات ')
@section('action', URL::route('accounting.sales.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل فواتير البيع</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
        </div>

        <div class="panel-body">
            {!! $dataTable->table() !!}

        </div>

    </div>


@endsection

@section('scripts')
    {!! Html::script('vendor/datatables/buttons.server-side.js') !!}
    {!! $dataTable->scripts() !!}

    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذة الفاتورة ؟",
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
