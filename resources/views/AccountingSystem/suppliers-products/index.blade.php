@extends('AccountingSystem.layouts.master')
@section('title','عرض الاصناف المقترحة')
@section('parent_title','إدارة  الاصناف المقترحة')
@section('action', URL::route('accounting.products.index'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">عرض كل الاصناف المقترحة


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
    {{$dataTable->table([], true)}}
        </div>

    </div>


@endsection

@section('scripts')
        {{$dataTable->scripts()}}

    <script>

        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذة  المنتج ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  المنتج  تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@stop