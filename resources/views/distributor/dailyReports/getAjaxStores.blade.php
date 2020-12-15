@foreach($stores as $store)
    <option value="{{$store->id}}" >{{$store->name}}</option>
@endforeach
