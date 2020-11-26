<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name[ar]',(isset($store) ? $store: new \App\Models\Store)->getTranslation('name', 'ar'),['class'=>'form-control m-input','placeholder'=>'ادخل الاسم بالعربية'])!!}
    </div>
    <div class="form-group m-form__group">
        <label>  الاسم باللغة الانجليزية</label>
        {!! Form::text('name[en]',(isset($store) ?$store: new \App\Models\Store)->getTranslation('name', 'en'),['class'=>'form-control m-input','placeholder'=>'ادخل الاسم بالانجليزية'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> نوع المستودع</label>
        {!! Form::select('store_category_id',$store_categories,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار نوع المستودع'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>طبيعه المستودع
        </label>
        {!! Form::select('for_distributor',[
            'مستودع داخلى',
            'مستودع خارجى',
        ],null,['class'=>'form-control   m-input select2','placeholder'=>'إختار طبيعه المستودع','onChange'=>'showDistributor(this.value)'])!!}
    </div>


    <div id="distributor-section"
         class="form-group m-form__group col-md-12 @if(isset($store)&& $store->for_distributor==1) d-block  @else d-none @endif ">
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

        function showDistributor(value) {
            if (value == 1) {
                $('#distributor-section').addClass('d-block')
                $('#distributor-section').removeClass('d-none')
            } else {
                $('#distributor-section').removeClass('d-block')
                $('#distributor-section').addClass('d-none')

            }
        }
    </script>

@endpush
