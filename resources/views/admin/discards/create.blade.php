@extends('admin.layouts.app')
@section('title') اضافه مرتجع
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المرتجع'=>route('admin.suppliers-discards.index'),'اضافه'=>route('admin.suppliers-discards.create')])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
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
                                    اضافه مرتجع جديد
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','route'=>'admin.suppliers-discards.store','files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}
                    @include('admin.discards._form')

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
                    url: '{{ route('admin.getAjaxSupplierProducts') }}',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        $('#product_id').html(data.data);
                    }
                });
            });

            //            **************************************
        });
    </script>

    <script>

        $(document).ready(function(){
            $('#return_type').on('change',function(){
                var val = $(this).val();
                alert(val);
            });
        });

    </script>

    <script>
        $(document).ready(function(){
            $('#add_discard_product').on('click',function () {
               var product_id = $('#product_id').children("option:selected").val();
               var product_name = $('#product_id').children("option:selected").text();
               var quanity = $('#discard_product_quantity').val();
               var price = $('#discard_product_price').val();

               if(product_id == null || product_id == ""){
                   alert("يجب إختيار منتج أولا ");
                   return 0;
               }
                else if(quanity == null || quanity == ""){
                    alert("من فضلك أضف كمية المنتج");
                    return 0;
                }

                else if(price == null || price == ""){
                    alert("أضف سعر المنتجات");
                    return 0;
                }else {
                   $('#discards_products').append(
                       '<tr>' +
                       '<th>'+product_name+'</th>' +
                       '<th>'+quanity+'</th>' +
                       '<th>'+price+'</th>' +
                       '<th>'+"زر الحذف"+'</th>' +
                       '</tr>');
               }



            });
        });
    </script>


@endsection
