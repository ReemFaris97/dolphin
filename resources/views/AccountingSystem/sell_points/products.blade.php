<select class="selectpicker form-control js-example-basic-single" data-live-search="true" name="product_id" placeholder="اختر المنتج">
    @foreach ($products as $product)
    <?php
    $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
    $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();
    $subunits= collect($units);
    $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
    // $new=$subunits,ENT_NOQUOTES);
 ?>
 @dd({{$product->total_discounts}});
<option value="{{$product->id}}"
   data-name="{{$product->name}}"
   data-price="{{$product->	selling_price}}"
   data-main-unit="{{$product->	main_unit}}"
   data-bar-code="{{$product->bar_code}}"
   data-price-has-tax="{{isset($producttax)? $producttax->price_has_tax : 'hasnotaxes' }}"
   data-total-taxes="{{ isset($producttax)? $product->total_taxes : 'hasnotaxes'}}"
data-total_discounts="{{$product->total_discounts}}"
   data-subunits="{{$allunits}}">
    {{$product->name}}
   </option>
    @endforeach
</select>
