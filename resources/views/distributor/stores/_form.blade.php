<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name[ar]',(isset($store) ? $store: new \App\Models\Store)->getTranslation('name',
        'ar'),['class'=>'form-control m-input','placeholder'=>'ادخل الاسم بالعربية'])!!}
    </div>
    <div class="form-group m-form__group">
        <label> الاسم باللغة الانجليزية</label>
        {!! Form::text('name[en]',(isset($store) ?$store: new \App\Models\Store)->getTranslation('name',
        'en'),['class'=>'form-control m-input','placeholder'=>'ادخل الاسم بالانجليزية'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> نوع المستودع</label>
        {!! Form::select('store_category_id',$store_categories,null,['class'=>'form-control m-input
        select2','placeholder'=>'إختار نوع المستودع'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>طبيعه المستودع
        </label>
        {!! Form::select('for_distributor',[
        'مستودع داخلى',
        'مستودع خارجى',
        ],null,['class'=>'form-control m-input select2','placeholder'=>'إختار طبيعه
        المستودع','onChange'=>'showDistributor(this.value)'])!!}
    </div>

    <div
        class="distributor-section form-group m-form__group col-md-12 @if(
        isset($store)&& $store->for_distributor == 1) d-block  @else d-none @endif ">
        <label>المندوبين</label>
        {!! Form::select('distributor_id',$distributor,null,['id'=>'distributor_id','class'=>'form-control m-input
        select2','placeholder'=>'إختار المندوب'])!!}
    </div>


    <div class="form-group m-form__group distributor-section @if(
        isset($store)&& $store->for_distributor == 1) d-block  @else d-none @endif">
        <div class="m-checkbox-inline">
            <label class="m-checkbox">
                <input class="md-check" name="has_car" value="" type="checkbox">يوجد
                <span></span>
            </label>
        </div>
    </div>
    <div class="form-group m-form__group col-md-12 distributor-section @if(
        isset($store)&& $store->for_distributor == 1) d-block  @else d-none @endif">
        <label>سيارت المندوب</label>
        <select id="car_id" class="form-control  m-input select2">
            <option disabled selected>إختار سيارة المندوب</option>
        </select>
    </div>

    <div class="form-group m-form__group col-md-12">
        <label>الملاحظات</label>
        {!! Form::textarea('notes',null,['class'=>'form-control m-input ','placeholder'=>'ملاحظات'])!!}
    </div>
</div>
@push('scripts')
<script>
    $('#check-all').change(function () {
        $("input:checkbox").prop("checked", $(this).prop("checked"))
    })

    function showDistributor(value) {
        if (value == 1) {
            $('.distributor-section').addClass('d-block')
            $('.distributor-section').removeClass('d-none')
            $('.car_id').addClass('d-block')
            $('.car_id').removeClass('d-none')
        } else {
            $('.distributor-section').removeClass('d-block')
            $('.distributor-section').addClass('d-none')
            $('#car_id').removeClass('d-block')
            $('#car_id').addClass('d-none')

        }
    }

</script>

<script>

    $(document).on('change', 'select[name="distributor_id"]', function () {
        var id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '{{ route('distributor.getAjaxCars') }}',
            data: {
                id: id
            },
            success: function (data) {
                $('#car_id').html(data.data);
            }
        });
    });
    </script>

        @endpush
