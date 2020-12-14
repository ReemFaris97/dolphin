@foreach($clauses as $clause)
    <option value="{{$clause->id}}" >{{$clause->name}}</option>
@endforeach
