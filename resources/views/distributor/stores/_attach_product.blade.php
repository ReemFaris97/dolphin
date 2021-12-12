<div class="form-group m-form__group "style="width:100%">
    <label>إختار الصنف والكمية </label>

    <select name="product_id" class="form-control m-input select2" style="width:100%" id="product_id">
        <option disabled @if(old('product_id')==null) selected @endif value="">اختر الصنف</option>
        @foreach($products as $product)

            <option data-quantity="999999999999"
                    value="{{$product->id}}" data-unit="{{$product->quantity_per_unit}}"
                    @if($product->id == (old("product_id")))
                    selected

                @endif
            > {{$product->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group m-form__group">
    <label>كمية الصنف بالعلبة</label>
    {!! Form::number('package',null,['class'=>'form-control m-input','id'=>'product_package'])!!}
</div>
<div class="form-group m-form__group">
    <label>كمية الصنف بالحبة</label>
    {!! Form::number('unit',null,['class'=>'form-control m-input','id'=>'product_unit'])!!}
</div>

<div class="form-group m-form__group">
    <button id="add-product" type="button" class="btn btn-primary">إضافة الصنف</button>
</div>

<div class="form-group m-form__group">
    <table class="table table-striped- table-bordered table-hover table-checkable">
        <thead>
        <tr>
            <th>الصنف</th>
            <th>عدد الحبات</th>
            <th>عدد العلب</th>
            <th>عدد الحبات لكل علبة</th>
            <th>الاجمالى</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        @foreach(old('products')??[] as $key=>$old_product)
            <tr>
                <td> {{$old_product['product_name']??null }}</td>
                <td> {{$old_product['units'] ??null}}</td>
                <td> {{$old_product['packages'] ??null}}</td>
                <td> {{$old_product['unit_per_package'] ??null}}</td>
                <td> {{$old_product['quantity'] ??null}}</td>
                <td>
                    <button onClick="$(this).closest('tr').remove();" class="removeRow btn btn-danger">حذف</button>
                </td>
                <input type="hidden" name="products[{{$key}}][product_id]" value="{{$old_product['product_id']}}">
                <input type="hidden" name="products[{{$key}}][quantity]" value="{{$old_product['quantity']}}">
                <input type="hidden" name="products[{{$key}}][package]" value="{{$old_product['package']}}">
                <input type="hidden" name="products[{{$key}}][units]" value="{{$old_product['units']}}">
                <input type="hidden" name="products[{{$key}}][unit_per_package]"
                       value="{{$old_product['unit_per_package']}}">
                <input type="hidden" name="products[{{$key}}][product_name]" value="{{$old_product['product_name']??null }}">
            </tr>'
        @endforeach
        </tbody>

    </table>
</div>
@push('scripts')
    <script>
        $('#add-product').on('click', function () {
            var product_id = $('#product_id').val();
            var selected_product = $('#product_id').find('option:selected');
            var product_name = selected_product.text();
            var product_quantity = selected_product.data('quantity');
            var product_unit_per_package = parseFloat(selected_product.data('unit'));
            var quantity = parseFloat($('#product_unit').val() || 0) +
                (parseFloat($('#product_package').val() || 0) * product_unit_per_package);
            if (product_id == "" || product_id == null || product_id == undefined) {
                alert('برجاء إختيار منتج قبل إضافته');
            } else if (quantity >= 1 && product_quantity < quantity) {
                alert("برجاء اختيار كميه مناسبه  قبل إضافة الصنف");
            } else {
                selected_product.data('quantity', product_quantity - quantity);
                var key = $('#tableBody').children().length
                $('#tableBody').append('' +
                    '<tr>\n' +
                    '<td>' + product_name + '</td>\n' +
                    '<td>' + $('#product_unit').val() + '</td>\n' +
                    '<td>' + $('#product_package').val() + '</td>\n' +
                    '<td>' + product_unit_per_package + '</td>\n' +
                    '<td>' + quantity + '</td>\n' +
                    '<td><button onClick="$(this).closest(\'tr\').remove();" class="removeRow btn btn-danger">حذف</button></td>\n' +
                    '<input type="hidden" name="products[' + key + '][product_id]" value="' + product_id + '">' +
                    '<input type="hidden" name="products[' + key + '][quantity]" value="' + quantity + '">' +
                    '<input type="hidden" name="products[' + key + '][package]" value="' + $('#product_package').val() + '">' +
                    '<input type="hidden" name="products[' + key + '][units]" value="' + $('#product_unit').val() + '">' +
                    '<input type="hidden" name="products[' + key + '][unit_per_package]" value="' + product_unit_per_package + '">' +
                    '<input type="hidden" name="products[' + key + '][product_name]" value="' + product_name + '">' +
                    '</tr>');
                $('#product_quantity').val("");

            }
        });

    </script>
@endpush
