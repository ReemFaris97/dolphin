<div class="form-group block-gp">
<label>اسم الصنف </label>

<select class="form-control js-example-basic-single" name="product_id" placeholder="اختر المنتج">
    @foreach ($products as $product)
    <?php
    $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
    $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();
    $subunits= collect($units);
    $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
    // $new=$subunits,ENT_NOQUOTES);
 ?>

<option value="{{$product->id}}" data-name="{{$product->name}}" data-price="{{$product->selling_price}}" data-bar_code="{{$product->bar_code}}"
    data-price_has_tax="{{isset($producttax)? $producttax->price_has_tax: '' }}"
     data-totalTaxes="{{ isset($producttax)? $product->total_taxes : ''}}"
data-subunits="{{$allunits}}">
    {{$product->name}}</option>

    @endforeach

</select>

</div>

