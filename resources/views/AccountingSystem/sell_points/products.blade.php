
<div class="form-group block-gp">
    <label>اسم الصنف </label>
    <select class=" form-control js-example-basic-single"  name="product_id" placeholder="اختر المنتج" id="selectID">
        <option value="" > اختر الصنف</option>
        @foreach ($products as $product)
        <?php
        $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
        $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();
        $subunits= collect($units);
        $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
        dd($allunits);
        // $new=$subunits,ENT_NOQUOTES);
     ?>
    <option value="{{$product->id}}"
       data-name="{{$product->name}}"
       data-price="{{$product->selling_price -(($product->selling_price*$product->total_discounts)/100)}}"
       data-main-unit="{{$product->	main_unit}}"
       data-bar-code="{{$product->bar_code}}"
       data-price-has-tax="{{isset($producttax)? $producttax->price_has_tax : 'hasnotaxes' }}"
       data-total-taxes="{{ isset($producttax)? $product->total_taxes : 'hasnotaxes'}}"
       data-subunits="{{$allunits}}"
       data-total_discounts="{{$product->total_discounts}}"
       >
        {{$product->name}}
       </option>
        @endforeach
    </select>
    </div>
