<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>المندوب</label>
        <select name="user_id" class="form-control  m-input select2">
            <option disabled selected>إختار المندوب</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" @if(isset($car)) {{$car->user_id == $user->id ? 'selected' :'' }} @endif  >{{$user->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group m-form__group">
        <label>إسم السيارة</label>
        {!! Form::text('car_name',null,['class'=>'form-control m-input','placeholder'=>'إسم السيارة'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>موديل السيارة</label>
        {!! Form::text('car_model',null,['class'=>'form-control m-input','placeholder'=>'موديل السيارة'])!!}
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
