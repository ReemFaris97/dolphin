<option disabled selected >إختار صنف </option>
@foreach($products as $product)
<option value="{{$product->id}}">{{$product->name}}</option>
@endforeach
