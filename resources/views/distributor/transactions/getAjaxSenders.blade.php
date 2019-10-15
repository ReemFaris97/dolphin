@foreach($users as $user)
    <option value="{{$user->id}}" @if(isset($transaction)) {{$transaction->receiver_id == $user->id ? 'selected' :'' }} @endif   >{{$user->name}}</option>
@endforeach