<table class="table">
    <th> اسم الصنف</th>

    <th> سعر الشراء</th>
    <th> سعر البيع</th>
    <th>  الكمية</th>
    <th>  التكلفة</th>
    <th>  القيمة</th>

    <tbody>
    @foreach ($products as $product)

    <tr class="parent-tr">
        <td>{{$product->name}}</td>
        <td ><input type="text" value="{{$product->purchasing_price}}"  class="form-control buy-price" readonly></td>
        <td ><input type="text" value="{{$product->selling_price}}"  class="form-control sell-price" readonly></td>
        <td><input type="text"  name="quantity[{{$product->id}}]"  class="form-control quantity" placeholder="ادخل الكمية"></td>
        <td><input type="text"  name="cost[{{$product->id}}]"  class="form-control cost" readonly></td>
        <td><input type="text"  name="price[{{$product->id}}]"  class="form-control vaaal" readonly></td>
    </tr>
    </tbody>

    @endforeach
</table>

<script>
    $(document).ready(function () {
        // function taklefa() {
        //     var quantity = $(this).
        // }

        $(".quantity").change(function () {
            var quantity = $(this).val();
            var buy = $(this).parents('.parent-tr').find('.buy-price').val();
            var sell = $(this).parents('.parent-tr').find('.sell-price').val();
            var cost = $(this).parents('.parent-tr').find('.cost').val();
            var vaaal = $(this).parents('.parent-tr').find('.vaaal').val();
            cost = Number(quantity) * Number(buy);
            $(this).parents('.parent-tr').find('.cost').val(Number(cost));
            vaaal = Number(quantity) * Number(sell);
            $(this).parents('.parent-tr').find('.vaaal').val(Number(vaaal));
        })
    })
</script>
