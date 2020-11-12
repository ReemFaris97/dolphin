<option disabled selected> إختار المستودع</option>
@forelse($stores as $store)
<option value="{{$store->id}}" >{{$store->name}}</option>
@empty

@endforelse
