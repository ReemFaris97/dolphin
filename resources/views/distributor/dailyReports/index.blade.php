@extends('distributor.layouts.app')
@section('title')الجرد
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['الجرد'=>route('distributor.dailyReports.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                     الجرد
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        <a href="{!!route('distributor.dailyReports.create')!!}"
                           class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="fas fa-plus"></i>
                            <span>إنشاء جرد</span>
                        </span>
                        </a>
                    </li>
                    <li class="m-portlet__nav-item"></li>

                </ul>
            </div>
        </div>
        <form class="Clearfix m-form m-form--fit m-form--label-align-right a-smaller-input-wrapper" enctype="multipart/form-data" method="get" action="">
            <div class="m-portlet__foot m-portlet__foot--fit ">
                <div class="m-form__actions">

                    <div class="form-group m-form__group">
                        <label>من تاريخ</label>
                        {!! Form::text('from',request()->from,['class'=>'form-control m-input datepicker' ])!!}
                    </div>
                    <div class="form-group m-form__group">
                        <label>الى تاريخ</label>
                        {!! Form::text('to',request()->to,['class'=>'form-control m-input datepicker'])!!}
                    </div>


                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </div>

        </form>

        <div class="m-portlet__body">
            @include('distributor.dailyReports._table')
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        function Delete(id) {
            var item_id=id;
            console.log(item_id);
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا الجرد ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,

            }).then(function(isConfirm){
                if(isConfirm){
                    document.getElementById('delete-form'+item_id).submit();
                }
                else{
                    swal("تم االإلفاء", "حذف  الجرد الغاؤه",'info',{buttons:'موافق'});
                }
            });
        }
    </script>
@endpush

