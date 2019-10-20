<select class="form-control js-example-basic-single" name="store_id">
<option disabled selected> إختار المخزن</option>
@forelse($stores as $store)
<option value="{{$store->id}}" >{{$store->ar_name}}</option>
@empty

@endforelse
</select>