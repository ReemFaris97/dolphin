<table class="table">
    <th> اسم الصنف</th>
    <th> الكمية الحالية المشترى</th>
    <th> السعر</th>
    <th> الكمية بعد الارجاع </th>
    <tbody>
        @foreach ($products as $product)

        <tr class="parent-tr">
            <td>{{$product->product->name}}</td>
            <td><input type="text" value="{{$product->quantity}}" class="form-control all" readonly></td>
            <td class="one-pr"> {{$product->product->selling_price}} </td>
            <td><input type="number" data-id="{{$product->product->id}}" name="quantity[{{$product->id}}]" min="0" max="{{$product->quantity}}" class="form-control quantity" placeholder="ادخل الكمية" value="0"></td>
            
        </tr>
         @endforeach
    </tbody>

   
</table>


<!------------ Start returns table ------------->
<table class="table table-r">
    <thead>
        <tr>
            <th> الكمية المرتجعة</th>
            <th> السعر </th>
        </tr>
    </thead>

    <tbody>
        @foreach ($products as $product)
            <tr class="parent-tr">
                <td>{{$product->product->name}}</td>
                <td class="price_for" id="{{$product->product->id}}"></td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td>المجموع</td>
            <td id="result-total"></td>
        </tr>
    </tfoot>

</table>
<!------------ End returns table ------------->

<!-- Modal -->


<script>
    $(document).ready(function() {
//        $(".quantity").change(function() {
//            var maxlength = $(".quantity").attr('max');
//            if ($(".quantity").val() > parseInt($('.quantity').attr('max'))) {
//                $("#alert").modal('show');
//            } else {
//                var quantity = $(this).val();
//                var all = $(this).parents('.parent-tr').find('.all').val();
//                var reminder = $(this).parents('.parent-tr').find('.reminder').val();
//                reminder = Number(all) - Number(quantity);
//                $(this).parents('.parent-tr').find('.reminder').val(Number(reminder));
//            }
//        });
    });
</script>


<!---------------- Keydown input ------------>
<!--
<script>
    $("input").keydown(function(){
  $("input").css("background-color", "yellow");
});
</script>
-->
