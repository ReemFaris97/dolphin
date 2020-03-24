@extends('AccountingSystem.layouts.master')
@section('title','إنشاء عرض  سعر  جديد')
@section('parent_title','إدارة  العملاء')
@section('action', URL::route('accounting.clients.prices_offer'))

@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة   عرض  سعر جديد</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.clients.prices_offer' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true]) !!}



            <div class="form-group col-md-6">
                <label>اسم المنتج</label>
                <select class="form-control"
                        id="product"
                        data-parsley-trigger="select"
                        data-parsley-required-message="@lang('system.field_required')">
                    <option value="" selected disabled>@lang('system.choose_product')</option>
                    @foreach ($products  as $product)
                        <option data-name="{{$product->name}}" data-price="{{$product->price}}" value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>

                @if($errors->has('products'))
                    <p class="help-block" style="color: #FF0000;">
                        {{ $errors->first('products') }}
                    </p>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label>الكمية</label>
                <input id="qty" type="number" value="{{old('qty')}}"
                       data-parsley-trigger="keyup"
                       oninput="this.value = Math.abs(this.value)"
                       class="form-control m-input" placeholder="ادخل الكمية">
                @if($errors->has('qty'))
                    <p class="help-block">
                        {{ $errors->first('qty') }}
                    </p>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label>السعر</label>
                <input id="price" type="number" value="{{old('price')}}"
                       data-parsley-trigger="keyup"
                       oninput="this.value = Math.abs(this.value)"
                       class="form-control m-input" placeholder="ادخل السعر">
                @if($errors->has('price'))
                    <p class="help-block">
                        {{ $errors->first('price') }}
                    </p>
                @endif
            </div>



            <div class="col-md-2">
                <button id="addProduct" class="btn btn-primary waves-effect waves-light m-t-20"  type="button">
                    اضافة
                </button>
            </div>


            <div class="table-responsive">
                <table id="productsTable" class="table m-0">
                    <thead>
                    <tr>
                        <th> اسم المنتج</th>
                        <th> الكمية</th>
                        <th> السعر</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (isset($offer))
                        @foreach ($offer->offer_products as $sup)
                            <tr>
                                <td>{{$sup->product->name}} </td>
                                <td>{{$sup->quantity}} </td>
                                <td>{{$sup->price}} </td>
                                <td>
                                    <a href="javascript:" id="{{$sup->id}}" class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">حذف</a>

                                </td>

                                <input type="hidden" name="products[]" value="id" />
                            </tr>
                        @endforeach


                    @endif


                    </tbody>
                </table>
            </div>

        </div>

@endsection

        @section('scripts')
            <script>
                $('#check-all').change(function () {
                    $("input:checkbox").prop("checked", $(this).prop("checked"))
                })
            </script>
            <script>
                $('body').delegate('#addProduct','click', function(){


                    var product_name   = $('#product').find("option:selected").attr('data-name');
                    var product_id = $('#product').find("option:selected").val();
                    var deleteId = "removeProduct"+product_id;
                    var trId = "tr"+product_id;

                    var qty = $('#qty').val();
                    var price = $('#price').val();

                    if(product_name == null || qty <= 0 || qty == "" ){
                        $('#addProduct').attr('disabled')==true;
                    }else {
                        $('#addProduct').attr('disabled')==false;
                        $('#productsTable > tbody:last-child').append(
                            '<tr id="'+trId+'">' +
                            '<td>' + product_name + '</td>'+
                            '<td>' + qty + '</td>'+
                            '<td>' + price + '</td>'+
                            '<td>' +
                            '<a href="javascript:;" id="' +deleteId +'" data-id="'+product_id+'"  class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">'+'حذف'+'</a>' + '</td>'+
                            '<input type="hidden" name="products[]" value="' + product_id + '" />' +
                            '<input type="hidden" name="qtys[]" value="' + qty + '" />' +
                            '<input type="hidden" name="prices[]" value="' + price + '" />' +
                            '</tr>');

                        $('#product').prop('selectedIndex',0);
                        $('#qty').val('');
                        $('#price').val('');
                    }


//
                });


                $('body').on('click', '.removeProduct', function () {
                    var id = $(this).attr('data-id');
                    var tr = $(this).closest($('#removeProduct' + id).parent().parent());

                    tr.find('td').fadeOut(500, function () {
                        tr.remove();
                    });
                });

                $('#product').change(function () {
                    var id = $(this).val();
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('supplier.getAjaxProductQty') }}',
                        data: {id: id},
                        dataType: 'json',

                        success: function (data) {
//                    $.each(data.data, function (element, ele) {
//                        console.log(ele);
//                        $('#students').append("<option value='"+ele.id+"'>" + ele.name + "</option>");
//                    });
//                    $('#full_degree').html("الدرجة الكلية "+data.data);
                            $('#qty').attr("data-parsley-max",data.data);
                            $('#qty').attr("data-parsley-max-message","@lang('system.allowed_qty') "+data.data);
                        }
                    });
                });



            </script>


@endsection