@foreach ($products as $product)
    <?php


    $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
    $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();

    $subunits= collect($units);

    $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);

    $mainunits=json_encode(collect([['id'=>'main-'.$product->id,'name'=>$product->main_unit ,
        'purchasing_price'=>$product->purchasing_price,
        'product_id'=>$product->id,
        'bar_code'=>$product->bar_code,
        'main_unit_present'=>1,
        'selling_price'=>$product->selling_price,
        'created_at'=>$product->created_at,
        'updated_at'=>$product->updated_at,
        'quantity'=>$product->quantity,
    ]]),JSON_UNESCAPED_UNICODE);
    $merged = array_merge(json_decode($mainunits), json_decode($allunits));
    $i = 0;
    foreach ($merged as $key => $value) {
        if ($value->id === $selectd_unit_id )
        {

            $i = $key;
        }
    }
    $arr = rearrange_array($merged,$i);


    ?>
    <div class="form-group block-gp col-md-12">
        <select class=" form-control js-example-basic-single"  name="product_id" placeholder="اختر المنتج" id="selectID2">

            <option class="ssID" value="{{$product->id}}"
                    data-name="{{$product->name}}"
                    data-price="{{$product->selling_price }}"
                    data-main-unit="{{$product->main_unit}}"
                    data-bar-code="@if(is_array($product->bar_code))
                        {{current($product->bar_code)}}
                        @else
                        {{$product->bar_code}}
@endif
                        " data-link= "{{route('accounting.products.show',['product'=>$product->id])}}"
                    data-price-has-tax="{{isset($producttax)? $producttax->price_has_tax : '-1' }}"
                    data-total-taxes="{{ isset($producttax)? $product->total_taxes : '0'}}"
                    data-subunits="{{json_encode($arr,JSON_UNESCAPED_UNICODE)}}"
                    data-total_discounts="{{$product->total_discounts}}"
                    data-unit-id="{{$selectd_unit_id}}"

            >
                {{$product->name}}
            </option>
        </select>
    </div>
@endforeach
