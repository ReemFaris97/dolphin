<div class="form-group m-form__group">
    <label>إختار المنتج والكمية </label>
    {!! Form::select('product_id',$products??[],null,['id'=>'product_id','class'=>'form-control m-input select2','placeholder'=>'اختر المنتج']) !!}
</div>

<div class="form-group m-form__group">
    <label>كمية المنتج</label>
    {!! Form::number('quantity',null,['class'=>'form-control m-input','id'=>'product_quantity'])!!}
</div>

<div class="form-group m-form__group">
    <button id="add-product" type="button" class="btn btn-primary">إضافة المنتج</button>
</div>

<div class="form-group m-form__group">
    <table class="table table-striped- table-bordered table-hover table-checkable">
        <thead>
        <tr>
            <th>المنتج</th>
            <th>الكمية</th>
            <th>حذف</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>

    </table>
</div>
@push('scripts')
    <script>
        $('#add-product').on('click', function () {
            debugger
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').selected().text();

            var quantity = $('#product_quantity').val();
            debugger;
            if (product_id == "") {
                alert('برجاء إختيار منتج قبل إضافته');
            } else if (quantity == '') {
                alert("برجاء اختيار الكمية قبل إضافة المنتج");
            } else {
                $('#tableBody').append('' +
                    '<tr>\n' +
                    '<td>' + product_name + '</td>\n' +
                    '<td>' + quantity + '</td>\n' +
                    '<td><button onClick="$(this).closest(\'tr\').remove();" class="removeRow btn btn-danger">حذف</button></td>\n' +
                    '<input type="hidden" name="product_id[]" value="' + product_id + '">' +
                    '<input type="hidden" name="quantity[]" value="' + quantity + '">' +
                    '</tr>');
                $('#product_quantity').val("");
            }
        });

    </script>
@endpush
