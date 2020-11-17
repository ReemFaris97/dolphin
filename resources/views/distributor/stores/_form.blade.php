<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> نوع المستودع</label>
        {!! Form::select('store_category_id',$store_categories,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار نوع المستودع'])!!}
    </div>


    <div class="form-group m-form__group col-md-12">
        <label>المندوبين</label>
        {!! Form::select('distributor_id',$distributor,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار  المندوب'])!!}
    </div>
    <div class="form-group m-form__group col-md-12">
        <label>الملاحظات</label>
        {!! Form::textarea('notes',null,['class'=>'form-control   m-input ','placeholder'=>'ملاحظات'])!!}
    </div>
</div>
@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
