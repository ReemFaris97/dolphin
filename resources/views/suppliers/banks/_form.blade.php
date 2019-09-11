<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>اسم البنك</label>

        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل اسم البنك'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> رقم الحساب</label>

        {!! Form::text('bank_account_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل رقم الحساب'])!!}
    </div>

</div>

@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
