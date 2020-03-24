
<table class="table">

    <th> اسم الصنف</th>

    <th> سعر الشراء</th>
    <th> سعر البيع</th>
    <th>   الكمية بالمخزن</th>
    <th> الكمية المحولة </th>
    <th>  التكلفة</th>
    <th>  القيمة</th>

    <tbody>
    @foreach ($products as $product)

    <tr class="parent-tr">
        <td>{{$product->name}}</td>

        <?php
        $store_quantity=\App\Models\AccountingSystem\AccountingProductStore::where('store_id',$store->id)->where('product_id',$product->id)->first();
        ?>
        <td ><input type="text" value="{{$product->purchasing_price}}"  class="form-control buy-price" readonly></td>
        <td ><input type="text" value="{{$product->selling_price}}"  class="form-control sell-price" readonly></td>
    <td>{{$store_quantity->quantity}}</td>

        <td><input type="number"  name="quantity[{{$product->id}}]"  class="form-control quantity" min="1" max="{{$store_quantity->quantity}}" placeholder=" ادخل كميه اقل  من {{$store_quantity->quantity}}    "></td>
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
          <p>الكمية المطلوبة اكبر من الكميه بالمخزن
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
            var quantity = $(this).val();
            var buy = $(this).parents('.parent-tr').find('.buy-price').val();
            var sell = $(this).parents('.parent-tr').find('.sell-price').val();
            var cost = $(this).parents('.parent-tr').find('.cost').val();
            var vaaal = $(this).parents('.parent-tr').find('.vaaal').val();
            cost = Number(quantity) * Number(buy);
            $(this).parents('.parent-tr').find('.cost').val(Number(cost));
            vaaal = Number(quantity) * Number(sell);
            $(this).parents('.parent-tr').find('.vaaal').val(Number(vaaal));

        });

        $('input[type=number][max]:not([max=""])').on('input', function(ev) {

    var $this = $(this);
    var maxlength = $this.attr('max');
    var value = $this.val();
    var max = parseInt($('.quantity').attr('max'));
    if ($this.val() > max) {
//      $this.val(value.substr(0, maxlength));
//      $this.html(value.substr(0, maxlength));
      $this.val(max);
      $this.html(max);

        $("#alert").modal('show');
    }
  });
    })
</script>
