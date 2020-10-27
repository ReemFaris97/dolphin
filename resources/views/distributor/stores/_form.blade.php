    
    <div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label> المندوب المسئول </label>
        {!! Form::select('distributor_id',$distrbiutors,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار المندوب المسئول '])!!}
    </div>
    
    </div>

<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> نوع المخزن</label>
        {!! Form::select('store_category_id',$store_categories,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار نوع المخزن'])!!}
    </div>
</div>

@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
