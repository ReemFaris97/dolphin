@extends('distributor.layouts.app')
@section('title') العملاء
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['العملاء'=>route('distributor.clients.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        كل العملاء
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('distributor.clients.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>اضافه عميل جديد</span>
                        </span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>

        <div class="m-portlet__body">
            @include('distributor.clients.filter')

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
                text: "هل تريد حذف هذا العميل ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  العميل تم الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
    {!!$dataTable->scripts()  !!}
@endpush
