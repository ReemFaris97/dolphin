<table class="table">
    <th> اسم الصنف</th>

    <th> سعر الشراء</th>
    <th> سعر البيع</th>
    <th>  الكمية </th>

    <th>  التكلفة</th>
    <th>  الاجمالى</th>

    <tbody>
    @foreach ($products as $product)

        @php($store_product=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$product->id)->where('store_id',$store->id)->first())
    <tr class="parent-tr">
        <td>{{$product->name}}

        </td>
        <input type="hidden" name="product_ids[{{$product->id}}]"  value="{{$product->id}}"  >

        <td ><input type="text" name="purchasing_price[{{$product->id}}]"  value="{{$product->purchasing_price}}"  class="form-control buy-price" ></td>
        <td ><input type="text" name="selling_price[{{$product->id}}]"  value="{{$product->selling_price}}"  class="form-control sell-price" ></td>
        <td ><input type="text" name="quantity[{{$product->id}}]" value="{{$product->quantity}}"  class="form-control quantity" ></td>
        <td><input type="text"  name="cost[{{$product->id}}]"  class="form-control cost" readonly></td>
        <td><input type="text"  name="price[{{$product->id}}]"  class="form-control vaaal" readonly></td>
    </tr>
    </tbody>

    @endforeach
</table>


<!-- Modal -->
<div id="alert" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>الكمية المطلوبة اكبر من الكميه بالمستودع
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">إغلاق</button>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        // function taklefa() {
        //     var quantity = $(this).
        // }

        $(".quantity").change(function () {


            var maxlength = $(".quantity").attr('max');

            if ($(".quantity").val() > parseInt($('.quantity').attr('max'))) {

                $("#alert").modal('show');
            }else {
                var quantity = $(this).val();
                var buy = $(this).parents('.parent-tr').find('.buy-price').val();
                var sell = $(this).parents('.parent-tr').find('.sell-price').val();
                var cost = $(this).parents('.parent-tr').find('.cost').val();
                var vaaal = $(this).parents('.parent-tr').find('.vaaal').val();
                cost = Number(quantity) * Number(buy);
                $(this).parents('.parent-tr').find('.cost').val(Number(cost));
                vaaal = Number(quantity) * Number(sell);
                $(this).parents('.parent-tr').find('.vaaal').val(Number(vaaal));
            }
        });

    })
</script>