        @foreach ($products as $product)
        <?php


        $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
        $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();

    $subunits= collect($units);
    $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
	    $mainunits=json_encode(collect([['id'=>'main-'.$product->id,'name'=>$product->main_unit , 'purchasing_price'=>$product->purchasing_price]]),JSON_UNESCAPED_UNICODE);
    $merged = array_merge(json_decode($mainunits), json_decode($allunits));
    $i = 0;
        foreach ($merged as $key => $value) {
            if ($value->id === $selectd_unit_id )
            {

                $i = $key;
            }
        }
        $arr = rearrange_array($merged,$i);
        $lastPrice=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->latest()->first();
        $sumQuantity=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->sum('quantity');
        $arrPrice=DB::table('accounting_purchases_items')->where('product_id',$product->id)
            ->selectRaw('SUM(price_after_tax * quantity) as total')
            ->pluck('total');
        $total=0;
        foreach ($arrPrice as $price){
            $total+= $price;
        }
        if($sumQuantity!=0){
            $average= $total/$sumQuantity;
        }else{
            $average=0;
        }

        ?>
<div class="form-group block-gp col-md-12">
    <select class=" form-control js-example-basic-single"  name="product_id" placeholder="اختر المنتج" id="selectID2">
    <option value="{{$product->id}}"
       data-name="{{$product->name}}"
       data-price="{{$product->purchasing_price -(($product->purchasing_price*$product->total_discounts)/100)  }}"
       data-main-unit="{{$product->	main_unit}}"
       data-bar-code="{{$product->bar_code}}" data-link= "{{route('accounting.products.show',['id'=>$product->id])}}"
       data-price-has-tax="{{isset($producttax)? $producttax->price_has_tax : '-1' }}"
       data-total-taxes="{{ isset($producttax)? $product->total_taxes : '0'}}"
       data-subunits="{{json_encode($arr,JSON_UNESCAPED_UNICODE)}}"
       data-total_discounts="{{$product->total_discounts}}"
       data-unit-id="{{$selectd_unit_id}}"
       data-last-price="{{($lastPrice)? $lastPrice->price_after_tax:'0' }}"
       data-average="{{($average)? $average:'0' }}" 
       data-product_expiration="{{($product->type=='product_expiration')? '1':'0' }}"
    >
        {{$product->name}} - {{$product->bar_code}}
       </option>
    </select>
    </div>
 @endforeach
