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

{{--    <div class="form-group m-form__group">--}}
{{--        <label>المرسل إليه</label>--}}
{{--        <select name="distributor_id" class="form-control  m-input select2">--}}
{{--            <option disabled selected>إختار المندوب المرسل اليه</option>--}}
{{--            @foreach($users as $user)--}}
{{--                <option value="{{$user->id}}"  >{{$user->name}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}

{{--    </div>--}}
    <div class="form-group m-form__group">
        <label>إختار المنتج والكمية </label>
        <select id="product_id" class="form-control  m-input select2">
            <option disabled selected>إختار المنتج</option>
        </select>
    </div>

    <div class="form-group m-form__group">
        <label>كمية المنتج</label>
        {!! Form::number('quantity',null,['class'=>'form-control m-input','id'=>'product_quantity'])!!}
    </div>

    <div class="form-group m-form__group">
        <button id="addProduct" type="button" class="btn btn-primary">إضافة المنتج</button>
    </div>

    <div class="form-group m-form__group">
        <table class="table table-striped- table-bordered table-hover table-checkable" >
            <thead>
            <tr>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>

        </table>
    </div>
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
                type: 'POST',
                url: '{{ route('distributor.getAjaxProducts') }}',
                data: {id: id},
                dataType: 'json',
                success: function (data) {
                    $('#product_id').html(data.data);
                }
            });
        });

        $('#addProduct').click(function () {
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').selected().text();

            var quantity = $('#product_quantity').val();

            if(product_id == ""){
                alert('برجاء إختيار منتج قبل إضافته');
            }
             else if(quantity == ''){
                alert("برجاء اختيار الكمية قبل إضافة المنتج");
            }
             else{
                $('#tableBody').append('' +
                    '<tr>\n' +
                    '<td>'+product_name+'</td>\n' +
                    '<td>'+quantity+'</td>\n' +
                    '<td><button onClick="$(this).closest(\'tr\').remove();" class="removeRow btn btn-danger">حذف</button></td>\n' +
                    '<input type="hidden" name="product_id[]" value="'+product_id+'">' +
                    '<input type="hidden" name="quantity[]" value="'+quantity+'">' +
                    '</tr>');
                $('#product_quantity').val("");
            }
        });
    </script>

@endpush
