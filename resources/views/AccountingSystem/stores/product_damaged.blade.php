<table class="table">
    <th> اسم الصنف</th>


    <th>  الكمية الحالية بالمستودع</th>
    <th>  الكمية التالفه</th>
    <th>  الكمية بالمستودع بعد التلف</th>


    <tbody>
    @foreach ($products as $product)

        @php($store_product=\App\Models\AccountingSystem\AccountingProductStore::where('product_id',$product->id)->where('store_id',$store->id)->first())
    <tr class="parent-tr">
        <td>{{$product->name}}

        </td>


        <td ><input type="text" value="{{$store_product->quantity}}"  class="form-control all" readonly></td>

        <td><input type="number"  name="quantity[{{$product->id}}]"  min="0" max="{{$store_product->quantity}}" class="form-control quantity" placeholder="ادخل الكمية"  require></td>
        <td><input type="text"  name="cost[{{$product->id}}]"  class="form-control reminder" readonly></td>

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
                <p>الكمية التالفه اكبر من الكميه بالمستودع
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
                var all = $(this).parents('.parent-tr').find('.all').val();

                var reminder = $(this).parents('.parent-tr').find('.reminder').val();

                reminder = Number(all) - Number(quantity);
                $(this).parents('.parent-tr').find('.reminder').val(Number(reminder));


            }
        });

    })
</script>