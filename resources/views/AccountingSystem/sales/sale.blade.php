<div class="form-group block-gp">
    <label>بحث بإسم الصنف أو الباركود</label>
    <select class=" form-control js-example-basic-single"  name="product_id" placeholder="اختر المنتج" id="selectID">
        <option value="" > اختر الصنف</option>
        @foreach ($products as $product)
            <?php
            $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
            $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();
            $subunits= collect($units);
            $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
            $mainunits=json_encode(collect([['id'=>'main-'.$product->id,'name'=>$product->main_unit , 'selling_price'=>$product->purchasing_price]]),JSON_UNESCAPED_UNICODE);
            $merged = array_merge(json_decode($mainunits), json_decode($allunits));
            $lastPrice=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->latest()->first();
            $sumQuantity=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->sum('quantity');
            $sumPrice=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->sum('price');
            if($sumPrice){
                $average= $sumQuantity/$sumPrice;
            }else{
                $average=0;
            }

            ?>
            <option value="{{$product->id}}"
                    data-name="{{$product->name}}"
                    data-price="{{$product->selling_price -(($product->selling_price*$product->total_discounts)/100)}}"
                    data-bar-code="{{$product->bar_code}}"
                    data-link= "{{route('accounting.products.show',['id'=>$product->id])}}"
                    data-price-has-tax="{{isset($producttax)? $producttax->price_has_tax : '0' }}"
                    data-total-taxes="{{ isset($producttax)? $product->total_taxes : '0'}}"
                    data-subunits="{{json_encode($merged)}}"
                    data-total_discounts="{{$product->total_discounts}}"
                    data-last-price="{{($lastPrice)? $lastPrice->price:'0' }}"
                    data-average="{{($average)? $average:'0' }}"
            >
                {{$product->name}} - {{$product->bar_code}}
            </option>
        @endforeach
    </select>
</div>


