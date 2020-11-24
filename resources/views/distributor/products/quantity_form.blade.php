<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>الكمية</label>
        {!! Form::number('quantity',null,['class'=>'form-control m-input '])!!}
    </div>


    <div class="form-group m-form__group ">
        <label>النوع:</label>
        {!! Form::select('type',['in'=>'داخل المستودع','out'=>'خارج المستودع'],null,['class'=>'form-control m-input select2 ','placeholder'=>'إختار النوع']) !!}
    </div>

    <div id="userPanel" {{--style="display: none;"--}} class="form-group m-form_group ">
        <label>المندوب</label>

        {!! Form::select('user_id',$users,null,['id'=>'userSelect','class'=>'form-control m-input select2','placeholder'=>'اختر المندوب']) !!}

    </div>

    <div id="userPanel" {{--style="display: none;"--}} class="form-group m-form_group ">
        <label>المستودع</label>

        {!! Form::select('store_id',$stores??[],null,['id'=>'userStores','class'=>'form-control m-input select2','placeholder'=>'اختر المستودع']) !!}

    </div>

</div>

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#userSelect').on('change', function () {
            var id = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('distributor.getDistributorStores') }}',
                data: {user_id: id},

                success: function (data) {
                    $('#userStores').html(data.data);
                }
            });
        });
        /*
                $('#checkUser').change(function () {
                    if (this.checked) {
                        $('#userPanel').show();
                        $('#userSelect').attr('name', 'user_id');
                    } else {
                        $('#userPanel').hide();
                        $('#userSelect').removeAttr('name');
                    }

                });*/
    </script>

@endpush
