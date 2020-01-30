<table class="table">
    <th> اسم الصنف</th>
    <th>  الكمية الحالية المشترى</th>
    <th>  الكمية  المرجعة</th>



    <tbody>
    @foreach ($products as $product)

          <tr class="parent-tr">
        <td>{{$product->product->name}}

        </td>


        <td ><input type="text" value="{{$product->quantity}}"  class="form-control all" readonly></td>

        <td><input type="number"  name="quantity[{{$product->id}}]"  min="0" max="{{$product->quantity}}" class="form-control quantity" placeholder="ادخل الكمية"></td>
        {{-- <td><input type="text"  name="cost[{{$product->id}}]"  class="form-control reminder" readonly></td> --}}

    </tr>
    </tbody>

    @endforeach
</table>


<!-- Modal -->


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
