@foreach($stores as $value)
<div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
<input type="checkbox" name="stores[]" value="{{$value->id}}" class="switchery store" id="store-{{$value->id}}" >
<label style="margin-left: 20px;"  for=store-{{$value->id}}>
{{ $value->ar_name }}
</label>
</div>
@endforeach