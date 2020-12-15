<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>إسم المندوب</label>
        <select name="user_id" class="form-control  m-input select2" id="user_id">
            <option disabled selected>إختار المندوب المرسل</option>
            @foreach($users as $user)
{{--                @if(isset($transaction)) {{$transaction->sender_id == $user->id ? 'selected' :'' }} @endif --}}
                <option value="{{$user->id}}"  >{{$user->name}}</option>
            @endforeach
        </select>

    </div>

    <div class="form-group m-form__group">
        <label>اسم المستودع</label>
        <select id="store_id" class="form-control  m-input select2">
            <option disabled selected>اسم المستودع</option>

        </select>
    </div>


    <div class="form-group m-form__group">
        <label>المبالغ النقدية</label>
        {!! Form::number('cash',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label>قيمة المصروفات</label>
        {!! Form::number('expenses',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label> الصوره </label>
        @if(isset($dailyReport))
            <img src="{!! url($dailyReport->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>

    @include('distributor.dailyReports._attach_product',['products'=>[]])

</div>

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#user_id').change(function () {
            var id = $(this).val();

            $.ajax({
                type: 'get',
                url: '/distributor/getAjaxStores/'+id,
                // data: {id: id},
                dataType: 'json',
                success: function (data) {
                    $('#store_id').html(data.data);
                }
            });
        });
        $('#store_id').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('distributor.getAjaxstoreProducts') }}',
                data: {
                    store_id: id
                },
                success: function (data) {
                    $('select[name="product_id"]').html(data.data);
                }
            });
        });

    </script>

@endpush
