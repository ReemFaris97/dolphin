<option disabled selected> إختار المخزن</option>
@forelse($stores as $store)
<option value="{{$store->id}}" >{{$store->name}}</option>
@empty

@endforelse
