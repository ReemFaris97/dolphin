<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>تحويل بنكى</label>
        {!! Form::radio('type','bank_transaction',true,['onclick'=>'showBank(this.value)'])!!}
        <label> مبلغ مباشر</label>
        {!! Form::radio('type','direct_amount',false,['onclick'=>'showBank(this.value)'])!!}
    </div>

    <div class="form-group m-form__group clearfix"></div>

    <div class="form-group m-form__group bank">
        <label>رقم الايداع</label>
        {!! Form::text('deposit_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل رقم الايداع']) !!}
    </div>
    <div class="form-group m-form__group">
        <label>تاريخ الايداع</label>
        {!! Form::text('deposit_date',null,['class'=>'form-control m-input inlinedatepicker inline-control','placeholder'=>'ادخل تاريخ الايداع']) !!}
    </div>
    <div class="form-group m-form__group bank">
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
    <script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>
<script>
    $(document).ready(function() {
        // For initializing now date
        $('.inlinedatepicker').datetimepicker({defaultDate :new Date()});
        $('.inlinedatepicker').text(new Date().toLocaleString());
        $('.inlinedatepicker').val(new Date().toLocaleString());

    });

    function showBank(val) {

        if (val =='bank_transaction' ) {

            $('.bank').removeClass('d-none')
        } else {
            $('.bank').addClass('d-none')
        }
    }
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
