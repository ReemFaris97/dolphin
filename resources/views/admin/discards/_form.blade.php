<div class="m-portlet__body ">
    <div class="form-group m-form__group">
        <label>المورد </label>
        {!! Form::select('user_id',$suppliers,null,['id'=>'supplier_id','class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>سبب الإرجاع</label>
        {!! Form::text('reason',null,['class'=>'form-control m-input','placeholder'=>'ادخل سبب الإرجاع'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>التاريخ</label>
        {!! Form::text('date',isset($discard)?old('date')??optional($discard->date)->format('m-d-Y'):old('date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
    </div>


    <div class="form-group m-form__group">
        <label>سداد قيمة المرتجع</label>
        <select name="return_type" id="return_type" class="form-control m-input select2">
            <option disabled selected >إختار نوع السداد </option>
            <option value="cash">كاش</option>
            <option value="switch">بدل</option>
            <option value="decrease">إنقاص من المديونية</option>
        </select>
        {{-- {!! Form::select('user_id',$suppliers,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد'])!!}--}}
    </div>



    <div class="checker-wrapper">
        <h4 class="the-big-checklabel">إختيار الأصناف</h4>
    </div>


    <div class="one-single-emp-wrapper">

    <div class="form-group m-form__group">
        <label> إختار الصنف</label>
        <select id="product_id" class="form-control m-input select2">
        </select>
    </div>

    <div class="form-group m-form__group">
        <label>الكمية</label>
        {!! Form::number('quantity',null,['id'=>'discard_product_quantity','class'=>'form-control m-input','placeholder'=>'الكمية'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>السعر</label>
        {!! Form::number('price',null,['id'=>'discard_product_price','class'=>'form-control m-input','placeholder'=>'السعر'])!!}
    </div>

        <div class="form-group m-form__group">
            <div class="m-portlet__foot m-portlet__foot--fit clearfix">
                <div class="m-form__actions">
                    <button id="add_discard_product" type="button" class="btn btn-primary">إضافة الصنف</button>
                </div>
            </div>
        </div>

    </div>


    <div class="checker-wrapper">
        <h4  class="the-big-checklabel">جدول الأصناف المسترجعة</h4>
    </div>

        <table class="table table-striped- table-bordered table-hover table-checkable">
            <thead>
            <tr>

                <th>الصنف</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الاعدادت</th>
            </tr>
            </thead>
            <tbody id="discards_products">

            </tbody>

        </table>


</div>
