<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>نوع الصرف</label>
        {!! Form::select('expenditure_type_id',$expenditure_types,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل نوع الصرف'])!!}
    </div>
</div>

@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
