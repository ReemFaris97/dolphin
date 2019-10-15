<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>المرسل</label>
        <select name="sender_id" class="form-control  m-input select2" id="sender_id">
            <option disabled selected>إختار المندوب المرسل</option>
            @foreach($users as $user)
                <option value="{{$user->id}}" @if(isset($transaction)) {{$transaction->sender_id == $user->id ? 'selected' :'' }} @endif  >{{$user->name}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group m-form__group">
        <label>المرسل إليه</label>
        <select name="receiver_id" class="form-control  m-input select2" id="receiver_id">
            <option disabled selected>إختار المندوب المرسل اليه</option>
            {{--@foreach($users as $user)--}}
            {{--<option value="{{$user->id}}" @if(isset($transaction)) {{$transaction->receiver_id == $user->id ? 'selected' :'' }} @endif   >{{$user->name}}</option>--}}
            {{--@endforeach--}}
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

    <script>

        $('#sender_id').change(function () {
            var id = $(this).val();
            console.log(id);
            $.ajax({
                type: 'POST',
                url: '{{ route('distributor.getAjaxSender') }}',
                data: {id: id},
                dataType: 'json',

                success: function (data) {
                    $('#receiver_id').html(data.data);
                }
            });
        });

        // var sender_id = $('#sender_id').find("option:selected").val();


    </script>


@endpush
