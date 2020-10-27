<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label> اسم المورد</label>
        {!! Form::select('supplier_id',$suppliers,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>رقم الفاتورة</label>
        {!! Form::number('bill_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل رقم الفاتورة','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>تاريخ الفاتورة</label>
        {!! Form::text('date',isset($bill)?old('date')??optional($bill->date)->format('m-d-Y'):old('date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>المبلغ المدفوع</label>
        {!! Form::number('amount_paid',isset($bill)?$bill->amount_paid:0,['id'=>'amount_input','class'=>'form-control m-input','placeholder'=>'المبلغ المدفوع','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>المبلغ المتبقي</label>
        {!! Form::number('amount_rest',isset($bill)?$bill->amount_rest:0,['id'=>'rest_input','class'=>'form-control m-input','placeholder'=>'المبلغ المتبقي','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>قيمة الضريبة</label>
        {!! Form::number('vat',isset($bill)?$bill->vat:0,['id'=>'vat_input','class'=>'form-control m-input','placeholder'=>'قيمة الضريبة','required'=>'required'])!!}
    </div>


    <div class="form-group m-form__group">
        <label>الإجمالي(للعرض فقط)</label>
        {!! Form::number('',isset($bill)? ($bill->amount_paid+$bill->amount_rest+$bill->vat) :0,['id'=>'total_input','class'=>'form-control m-input','placeholder'=>'لعرض القيمة فقط','readonly'=>'readonly'])!!}
    </div>


    <div class="form-group m-form__group">
        <label> نوع السداد</label>
        {!! Form::select('payment_method',["cash"=>"كاش","bank_transfer"=>"تحويل بنكي","check"=>"شيك بنكي"],null,['class'=>'form-control m-input select2','placeholder'=>'إختر نوع السداد','required'=>'required','id'=>"payment_method"])!!}
    </div>

    @if(!isset($bill))
    <div id="transfer" style="display: none;">

        <div class="form-group m-form__group">
            <label>تاريخ التحويل</label>
            {!! Form::text('transfer_date',isset($bill)?old('transfer_date')??optional($bill->transfer_date)->format('m-d-Y'):old('transfer_date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
        </div>

        <div class="form-group m-form__group">
            <label>رقم التحويل</label>
            {!! Form::number('transfer_number',isset($bill)?$bill->transfer_number:0,['class'=>'form-control m-input','placeholder'=>'رقم التحويل'])!!}
        </div>
    </div>

    <div id="check" style="display: none;">

        <div class="form-group m-form__group">
            <label> اسم البنك</label>
            {!! Form::text('bank_name',null,['class'=>'form-control m-input','placeholder'=>'ادخل إسم البنك'])!!}
        </div>

        <div class="form-group m-form__group">
            <label>رقم الشيك</label>
            {!! Form::number('check_number',isset($bill)?$bill->check_number:0,['class'=>'form-control m-input','placeholder'=>'رقم الشيك'])!!}
        </div>
        <div class="form-group m-form__group">
            <label>تاريخ الشيك</label>
            {!! Form::text('check_date',isset($bill)?old('check_date')??optional($bill->check_date)->format('m-d-Y'):old('check_date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
        </div>

    </div>
        @else
                @if($bill->payment_method == 'bank_transfer')
            <div id="transfer">
                <div class="form-group m-form__group">
                    <label>تاريخ التحويل</label>
                    {!! Form::text('transfer_date',isset($bill)?old('transfer_date')??optional($bill->transfer_date)->format('m-d-Y'):old('transfer_date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
                </div>

                <div class="form-group m-form__group">
                    <label>رقم التحويل</label>
                    {!! Form::number('transfer_number',isset($bill)?$bill->transfer_number:0,['class'=>'form-control m-input','placeholder'=>'رقم التحويل'])!!}
                </div>
            </div>
                @endif

                 @if($bill->payment_method=='check')
                        <div id="check">
                                <div class="form-group m-form__group">
                                    <label> اسم البنك</label>
                                    {!! Form::text('bank_name',null,['class'=>'form-control m-input','placeholder'=>'ادخل إسم البنك'])!!}
                                </div>

                                <div class="form-group m-form__group">
                                    <label>رقم الشيك</label>
                                    {!! Form::number('check_number',isset($bill)?$bill->check_number:0,['class'=>'form-control m-input','placeholder'=>'رقم الشيك'])!!}
                                </div>
                                <div class="form-group m-form__group">
                                    <label>تاريخ الشيك</label>
                                    {!! Form::text('check_date',isset($bill)?old('check_date')??optional($bill->check_date)->format('m-d-Y'):old('check_date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
                                </div>
                        </div>
                @endif



@endif


</div>


<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>اسم المنتج</label>
        <select class="form-control"
                id="product"
                data-parsley-trigger="select"
                data-parsley-required-message="هذا الحقل مطلوب">
            <option value="" selected disabled>إختار منتج</option>
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

    <div class="form-group m-form__group">
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

    <div class="form-group m-form__group">
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
            @if (isset($bill))
                @foreach ($bill->products as $sup)
                    <tr id="tr{{$sup->id}}">
                        <td>{{$sup->product->name}} </td>
                        <td>{{$sup->quantity}} </td>
                        <td>{{$sup->price}} </td>
                        <td>
                            <a href="javascript:" data-id="{{$sup->id}}" id="removeProduct{{$sup->id}}" class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">حذف</a>

                        </td>

                        <input type="hidden" name="products[]" value="{{$sup->product_id}}" />
                        <input type="hidden" name="qtys[]" value="{{$sup->quantity}}" />
                        <input type="hidden" name="prices[]" value="{{$sup->price}}" />
                    </tr>
                @endforeach


            @endif


            </tbody>
        </table>
    </div>

</div>


@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        });
        $('#amount_input').on('keyup',function () {
            var amount =$(this).val();
            var rest = $('#rest_input').val();
            var vat =  $('#vat_input').val();
            var total = parseInt(amount) + parseInt(rest) + parseInt(vat);
            $('#total_input').val(total);
        });
        $('#rest_input').on('keyup',function () {
            var amount = $('#amount_input').val();
            var rest = $(this).val();
            var vat = $('#vat_input').val();
            var total = parseInt(amount) + parseInt(rest) + parseInt(vat);
            $('#total_input').val(total);
        });
        $('#vat_input').on('keyup',function () {
            var amount = $('#amount_input').val();
            var rest =  $('#rest_input').val();
            var vat = $(this).val();
            var total = parseInt(amount) + parseInt(rest) + parseInt(vat);
            $('#total_input').val(total);
        });
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
                    '<a href="javascript:;" id="removeProduct' +deleteId +'" data-id="'+product_id+'"  class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">'+'حذف'+'</a>' + '</td>'+
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

            // var tr = $(this).closest($('#removeProduct' + id).parent().parent());
            var row = $('#tr'+id);
            row.find('td').fadeOut(500, function () {
                row.remove();
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
@endpush
