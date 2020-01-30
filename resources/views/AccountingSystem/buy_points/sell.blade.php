<select class="form-control js-example-basic-single pull-right" name="product_id" placeholder="اختر المنتج">
    @foreach ($products as $product)
            <option value="{{$product->id}}" >{{$product->name}}</option>

    @endforeach

</select>
