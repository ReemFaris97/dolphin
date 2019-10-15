<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>الكمية</label>
        {!! Form::number('quantity',null,['class'=>'form-control m-input '])!!}
    </div>


    <div class="form-group m-form_group ">
        <label>النوع:</label>
        {!! Form::select('type',['in'=>'داخل المخزن','out'=>'خارج المخزن'],['class'=>'form-control m-input select2','placeholder'=>'إختار النوع']) !!}
    </div>

    <div class="form-group m-form_group col-lg-3">
        <label>إضافة موزع</label>
        <input type="checkbox" id="checkUser" name="check_user" class="form-control m-input">
    </div>

    <div id="userPanel" style="display: none;" class="form-group m-form_group ">
                <select id="userSelect"  class="form-control m-input select2">
                    <option disabled selected>إختار المندوب</option>
                    @forelse($users as $user)
                        <option value="{{$user->id}}" >{{$user->name}}</option>
                    @empty

                    @endforelse
                </select>
    </div>

</div>

@push('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#store_category').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('distributor.getAjaxStores') }}',
                data: {id: id},
                dataType: 'json',
                success: function (data) {
                    $('#store_id').html(data.data);
                }
            });
        });

        $('#checkUser').change(function(){
            if(this.checked){
                $('#userPanel').show();
                $('#userSelect').attr('name','user_id');
            }else{
                $('#userPanel').hide();
                $('#userSelect').removeAttr('name');
            }

        });
    </script>

@endpush
