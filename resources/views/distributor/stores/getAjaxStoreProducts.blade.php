<option disabled selected >اختر الصنف </option>
@foreach($quantities as $quantity)
    <option  value="{{$quantity->product_id}}"
        data-quantity="{{$quantity->total_quantity}}"
        data-unit="{{$quantity->product->quantity_per_unit}}"
        >
        {{$quantity->product->name}}</option>
@endforeach
