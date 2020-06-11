@foreach($branches as $value)
<div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
<input type="checkbox" name="permission[]" value="{{$value->id}}" class="switchery" id="branch-{{$value->id}}" >
<label style="margin-left: 20px;"  for={{$value->id}}>
{{ $value->name }}
</label>
</div>
@endforeach