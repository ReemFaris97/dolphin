<label>إختار المستودع</label>
<select class="form-control js-example-basic-single" name="store_id">
{{-- <option disabled selected> إختار المستودع</option> --}}
{{-- @dd($stores) --}}
@foreach($stores as $store)
<option value="{{$store->id}}">{{$store->ar_name}}</option>
@endforeach
</select>
