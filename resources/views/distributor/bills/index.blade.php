@extends('distributor.layouts.app')
@section('title')
الفواتير
@endsection
@section('header')
@endsection
@section('breadcrumb') @php($breadcrumbs=['الفواتير'=>route('distributor.bills.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection
@section('content')
    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل الفواتير
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">

            </div>
        </div>
        <div class="m-portlet__body">
            {!!  $dataTable->table()!!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function Delete(id) {
            var item_id=id;
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا الفاتورة ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الفاتورة تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
    {!!$dataTable->scripts()  !!}
@endpush
