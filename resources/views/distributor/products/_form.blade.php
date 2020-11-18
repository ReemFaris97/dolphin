<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>
    {{--   @if(isset($product))
           <div class="form-group m-form__group">
               <label>نوع المستودع</label>
               --}}{{--            {!! Form::select('store_category_id',$categories,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار نوع المستودع','id'=>'store_category'])!!}--}}{{--
               <select name="store_category_id" class="form-control m-input select2">
                   <option disabled selected>إختار نوع المستودع</option>
                   @forelse($categories as $cat)
                       <option value="{{$cat->id}}" @if($product->store->category->id == $cat->id) selected @endif >{{$cat->name}}</option>
                   @empty

                   @endforelse

               </select>
           </div>

           <div class="form-group m-form__group">
               <label>المستودع</label>
               --}}{{--        {!! Form::select('store_id',null,['class'=>'form-control  m-input select2','placeholder'=>'إختار المستودع','id'=>'store_id'])!!}--}}{{--
               <select name="store_id" class="form-control  m-input select2" id="store_id">
                   <option disabled selected>إختار المستودع</option>
                   @forelse($stores as $store)
                       <option value="{{$store->id}}" @if($product->store->id == $store->id) selected @endif >{{$store->name}}</option>
                   @empty

                   @endforelse
               </select>
           </div>

       @else
           <div class="form-group m-form__group">
               <label>نوع المستودع</label>
               {!! Form::select('store_category_id',$categories,null,['class'=>'form-control   m-input select2','placeholder'=>'إختار نوع المستودع','id'=>'store_category'])!!}
           </div>


           <div class="form-group m-form__group">
               <label>المستودع</label>
               --}}{{--        {!! Form::select('store_id',null,['class'=>'form-control  m-input select2','placeholder'=>'إختار المستودع','id'=>'store_id'])!!}--}}{{--
               <select name="store_id" class="form-control  m-input select2" id="store_id">

               </select>
           </div>
       @endif
   --}}

    <div class="form-group m-form__group">
        <label>الكود</label>
        {!! Form::text('code',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الكمية بالحبة</label>
        {!! Form::number('quantity_per_unit',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الحد الأدنى للكمية</label>
        {!! Form::number('min_quantity',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الحد الأقصى للكمية</label>
        {!! Form::number('max_quantity',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label>السعر</label>
        {!! Form::number('price',null,['class'=>'form-control m-input '])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الباركود</label>
        {!! Form::text('bar_code',null,['class'=>'form-control m-input','placeholder'=>'الباركود'])!!}
    </div>

    @if(isset($product))
        <div class="form-group m-form__group">
            <label> شكل الباركود </label>
            @if(isset($product))
                <?php echo \Milon\Barcode\DNS1D::getBarcodeHTML($product->bar_code, "C39", 1) ?>
            @endif
        </div>

    @endif


    <div class="form-group m-form__group">
        <label> الصوره الرئيسة للمنتج </label>
        @if(isset($product))

            <img src="{!! url($product->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>


    <div class="form-group m-form__group">
        <label>تاريخ الصلاحية</label>
        {!! Form::text('expired_at',isset($product)?old('expired_at')??optional($product->expire_at)->format('m-d-Y'):old('expired_at'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
    </div>


    <div class="form-group m-form__group">
        <label>صور المنتج </label><span style="color: red"> ارفع اكتر من صورة</span>
        <input type="file" name="images[]" class="form-control m-input" multiple>
    </div>


</div>

{{--
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
    </script>

@endpush
--}}
