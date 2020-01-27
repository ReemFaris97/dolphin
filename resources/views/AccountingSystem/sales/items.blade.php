<table class="table">
    <th>   اسم المنتج  </th>

    <th> الكميه </th>
    <th>  السعر </th>
    <th>  الحذف </th>

    <tbody>
        @foreach($items as $row)
        <tr class="parent-tr">
        <input type="hidden" value="{{$row->id}}" name="item_id[]">
        <input type="hidden" value="{{$row->product->id}}" name="product_id[]">
            <td>{!! $row->product->name!!}</td>
            <td><input type="number" name="quantity[]" class="form-control quantity" value="{{$row->quantity}}" min="0" max="{{$row->quantity}}"></td>
            <td>{!! $row->price !!}</td>
            <td>
                <a href="javascript:;" sale-id="{{$row->id}}" class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">حذف</a>
            </td>
             </tr>
             @endforeach

    </tbody>

</table>

<script>
    $(document).ready(function () {
        $('body').on('click', '.removeProduct', function () {
            var id = $(this).attr('sale-id');
            // alert(id);
            $.ajax({
                type: "Delete",
                url:'/accounting/remove_Sale/'+id,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data)
                {

                    $('.sales_biles').html(data.data);

                },

            });

        });

    });
</script>
