
    @foreach ($products as $product)
<div class="col-lg-4 col-sm-12 col-xs-6">
    <div class="prod1">
        <div class="inDetails"></div>

        <input type="checkbox" class="if-check" id="myCheckbox{{$product->id}}" data-id="{{$product->id}}" data-price="{{$product->selling_price}}"/>
        <label class="new-p" for="myCheckbox{{$product->id}}">
            <span class="price"><input type="number" class="pric-holder" value="{{$product->selling_price}}">   ر.س </span>
            <img src="{!! getimg($product->image)!!}">
            <h4 class="name">{{$product->name}} </h4>
           <?php
          $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();

            ?>
                       <h4 class="name">@if(isset($producttax)){{$producttax->price_has_tax}} @endif</h4>

            <input type="hidden" class="id" value="{{$product->id}}">
        </label>

    </div>
</div>
    @endforeach


