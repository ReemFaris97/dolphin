@extends('AccountingSystem.layouts.master')
@section('title','طباعة الباركود')
@section('parent_title','إدارة  الاصناف')
@section('action', URL::route('accounting.products.print_barcode_view'))

@section('styles')

@endsection
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title"> طباعة الباركود</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <button class="btn btn-success" type="button" id="addProduct">اضافة منتج</button>
        <button class="btn btn-danger" type="button" id="removeProduct">حذف منتج</button>

        <div class="panel-body barcodeForm">
            {!!Form::open( ['route' => 'accounting.products.print_barcode', 'method' => 'Post','class'=>'form','id'=>'barcode-form']) !!}
            <div class="row productRow">
                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                    <label>اختر المنتج </label>
                    <select class="form-control" name="product_id" id="products"></select>
                </div>

                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                    <label>السعر</label>
                    {!! Form::text('price', null, ['id'=>'price','class' => 'form-control',
                                    'placeholder' => 'السعر','readonly']) !!}
                </div>

                <div class="form-group col-md-4 col-sm-6 col-xs-12">
                    <label>عدد التكت</label>
                    {!! Form::number('number', null, ['class' => 'form-control', 'placeholder' => 'العدد','required']) !!}
                </div>
            </div>
            <div class="text-center">
                <button id="print" type="submit" class="btn btn-success ">طباعة
                    <i class="icon-printer position-right"></i>
                </button>
            </div>
            {!!Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
            integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>

    {{--    ////////////////////////////--}}
    <script>
        $(document).ready(function () {

            $('#removeProduct').click(function () {
                if ($('.productRow').length > 1) {
                    $('.productRow')[$('.productRow').length - 1].remove()
                }
            });
            $('#addProduct').click(function () {
                $('.barcodeForm').find('.productRow').first().clone().insertBefore(".text-center");
            });
        });
    </script>
    {{--    ////////////////////////////--}}

    <script>
        $('#products').select2({
            ajax: {
                delay: 250,
                url: "/accounting/products-by-ajax",
                data: function (params) {
                    return {
                        search: params.term,
                        page: params.page || 1
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    results = _.toArray(data.data.data);
                    return {
                        results: results,
                        pagination: {
                            more: data.has_more
                        }
                    };
                },
                cache: true
            },
            placeholder: 'ابحث عن المنتجات',
            minimumInputLength: 1,
        });

        $('#products').on('change', function () {
            var product_id = $(this).val();
            $.ajax({
                url: "/accounting/get-product-price/" + product_id,
                method: 'GET',
                type: 'json',
                success: function (data) {
                    $('#price').val(data);
                },
            });
        });
    </script>

@stop
