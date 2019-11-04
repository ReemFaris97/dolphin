<select class="form-control js-example-basic-single pull-right" name="clause_id">
<option disabled selected> إختار اسم البند</option>
@forelse($clauses as $clause)
<option value="{{$clause->id}}" >{{$clause->ar_name}}</option>
@empty

@endforelse
</select>

