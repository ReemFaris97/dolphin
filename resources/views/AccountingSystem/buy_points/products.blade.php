<select class="form-control js-example-basic-single col-md-4 col-sm-6 col-xs-12 pull-right" name="product_id" placeholder="اختر المنتج">
    @foreach ($products as $product)
            <option value="{{$product->id}}" >{{$product->name}}</option>

    @endforeach

</select>
