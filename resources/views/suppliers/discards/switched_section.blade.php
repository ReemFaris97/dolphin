<div class="checker-wrapper">
    <h4 class="the-big-checklabel">إختيار الأصناف</h4>
</div>


<div class="one-single-emp-wrapper">

    <div class="form-group m-form__group">
        <label> إختار الصنف</label>
        <select id="switch_product_id" class="form-control m-input select2">
        </select>
    </div>

    <div class="form-group m-form__group">
        <label>الكمية</label>
        {!! Form::number('',null,['id'=>'switch_product_quantity','class'=>'form-control m-input','placeholder'=>'الكمية'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>السعر</label>
        {!! Form::number('',null,['id'=>'switch_product_price','class'=>'form-control m-input','placeholder'=>'السعر'])!!}
    </div>

    <div class="form-group m-form__group">
        <div class="m-portlet__foot m-portlet__foot--fit clearfix">
            <div class="m-form__actions">
                <button id="add_switch_product" type="button" class="btn btn-primary">إضافة الصنف</button>
            </div>
        </div>
    </div>

</div>


<div class="checker-wrapper">
    <h4  class="the-big-checklabel">جدول الأصناف المستبدله</h4>
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
    <tbody id="switch_products">

    </tbody>

</table>
