<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>رقم الايداع</label>
        {!! Form::text('deposit_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل رقم الايداع']) !!}
    </div>
    <div class="form-group m-form__group">
        <label>تاريخ الايداع</label>
        {!! Form::text('deposit_date',null,['class'=>'form-control m-input datepicker','placeholder'=>'ادخل تاريخ الايداع']) !!}
    </div>
    <div class="form-group m-form__group">
        <label>البنك</label>
        {!! Form::select('bank_id',$banks,null,['class'=>'form-control m-input','placeholder'=>'اختر البنك']) !!}
    </div>
    <div class="form-group m-form__group">
        <label>المندوب</label>
        {!! Form::select('user_id',$users,null,['class'=>'form-control m-input','placeholder'=>'اختر المندوب']) !!}
    </div>

    <div class="form-group m-form__group">
        <label> :الرصيد</label>
        <input disabled name="wallet" value="0">
    </div>
    <div class="form-group m-form__group">
        <label>مبلغ الايداع</label>
        {!! Form::text('amount',null,['class'=>'form-control m-input ','placeholder'=>'ادخل الملغ']) !!}
    </div>
    <div class="form-group m-form__group">
        <label> صورة الإيداع</label>
        {!! Form::file('image',['class'=>'form-control m-input ']) !!}
    </div>


</div>
@push('scripts')

<script>

    $(document).on('change', 'select[name="user_id"]', function () {
        var id = $(this).val();

        $.ajax({
            type: 'get',
            url: '/distributor/getAjaxWallet/' + id,
            success: function (data) {
                $('input[name="wallet"]').val(data.wallet);

            }
        });
    });
</script>

@endpush
