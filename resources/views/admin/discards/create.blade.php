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
                        $('#switch_product_id').html(data.data);
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
            /*
             Start Discards products section ......
            */

            $('#add_discard_product').on('click',function () {
               var product_id = $('#product_id').children("option:selected").val();
               var deleteId = "removeProduct"+product_id;
               var trId = "tr"+product_id;
               var product_name = $('#product_id').children("option:selected").text();
               var quantity = $('#discard_product_quantity').val();
               var price = $('#discard_product_price').val();

               if(product_id == null || product_id == ""){
                   alert("يجب إختيار منتج أولا ");
                   return 0;
               }
                else if(quantity == null || quantity == ""){
                    alert("من فضلك أضف كمية المنتج");
                    return 0;
                }

                else if(price == null || price == ""){
                    alert("أضف سعر المنتجات");
                    return 0;
                }else {

                   $('#discards_products').append(
                       '<tr id="'+trId+'">' +
                       '<td>'+product_name+'</td>' +
                       '<td>'+quantity+'</td>' +
                       '<td>'+price+'</td>' +
                       '<td>'+'<a href="javascript:;" id="' + deleteId +'" data-id="'+product_id+'"  class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">'+'حذف'+'</a>'+'</td>' +
                       '<input type="hidden" name="products[]" value="' + product_id + '" />' +
                       '<input type="hidden" name="qtys[]" value="' + quantity + '" />' +
                       '</tr>');
               }



            });

            $('body').on('click', '.removeProduct', function () {
                var id = $(this).attr('data-id');
                var tr = $(this).closest($('#removeProduct' + id).parent().parent());

                tr.find('td').fadeOut(500, function () {
                    tr.remove();
                });
            });
            /*
            End Discards products section...........
             */


            /*
            start switched products section
             */
            $('#add_switch_product').on('click',function () {
                var product_id = $('#switch_product_id').children("option:selected").val();
                var deleteId = "switch_removeProduct"+product_id;
                var trId = "switch_tr"+product_id;
                var product_name = $('#switch_product_id').children("option:selected").text();
                var quantity = $('#switch_product_quantity').val();
                var price = $('#switch_product_price').val();

                if(product_id == null || product_id == ""){
                    alert("يجب إختيار منتج أولا للبدل");
                    return 0;
                }
                else if(quantity == null || quantity == ""){
                    alert("من فضلك أضف كمية المنتج للتبديل");
                    return 0;
                }

                else if(price == null || price == ""){
                    alert("أضف سعر المنتجات");
                    return 0;
                }else {

                    $('#switch_products').append(
                        '<tr id="'+trId+'">' +
                        '<td>'+product_name+'</td>' +
                        '<td>'+quantity+'</td>' +
                        '<td>'+price+'</td>' +
                        '<td>'+'<a href="javascript:;" id="' + deleteId +'" data-id="'+product_id+'"  class="switch_removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">'+'حذف'+'</a>'+'</td>' +
                        '<input type="hidden" name="switch_products[]" value="' + product_id + '" />' +
                        '<input type="hidden" name="switch_qtys[]" value="' + quantity + '" />' +
                        '</tr>');
                }



            });

            $('body').on('click', '.switch_removeProduct', function () {
                var id = $(this).attr('data-id');
                var tr = $(this).closest($('#switch_removeProduct' + id).parent().parent());

                tr.find('td').fadeOut(500, function () {
                    tr.remove();
                });
            });

            /*
            end switched products
            */
        });
    </script>

@endsection
