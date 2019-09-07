<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>المرسل</label>
        <select name="sender_id" class="form-control  m-input select2">
            <option disabled selected>إختار المندوب المرسل</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" @if(isset($transaction)) {{$transaction->sender_id == $user->id ? 'selected' :'' }} @endif  >{{$user->name}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group m-form__group">
        <label>المرسل إليه</label>
        <select name="receiver_id" class="form-control  m-input select2">
            <option disabled selected>إختار المندوب المرسل اليه</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" @if(isset($transaction)) {{$transaction->receiver_id == $user->id ? 'selected' :'' }} @endif   >{{$user->name}}</option>
            @endforeach
        </select>

    </div>


    <div class="form-group m-form__group">
        <label>المبلغ المحول</label>
        {!! Form::number('amount',null,['class'=>'form-control m-input','placeholder'=>'ادخل المبلغ'])!!}
    </div>





</div>

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    </script>

@endpush
