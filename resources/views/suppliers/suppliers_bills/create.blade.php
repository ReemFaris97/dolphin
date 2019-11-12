@extends('suppliers.layouts.app')
@section('title') اضافه فاتورة للمورد
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['فواتير المورد'=>route('supplier.suppliers-bills.index'),'اضافه'=>route('supplier.suppliers-bills.create')])
@includeWhen(isset($breadcrumbs),'suppliers.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')


    <div class="m-content">
        <div class="row">
            <div class="col-md-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head belong-to-aform">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    اضافه فاتورة جديدة
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','route'=>'supplier.suppliers-bills.store','files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}
                    @include('suppliers.suppliers_bills._form')

                    <div class="m-portlet__foot m-portlet__foot--fit clearfix">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </div>

                {!!Form::close()!!}
                <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('owl')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#supplier_id').change(function () {
                var id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('supplier.getAjaxSupplierProducts') }}',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').html(data.data);
                        $('#switch_product_id').html(data.data);
                        $('#receivable_amount').val(data.receivables);
                    }
                });
            });

            //            **************************************
        });
    </script>


@endsection
