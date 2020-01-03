<div class="m-portlet__body ">
    <div class="form-group m-form__group">
        <label>المورد </label>
        {!! Form::select('supplier_id',$suppliers,null,['id'=>'supplier_id','class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>سبب الإرجاع</label>
        {!! Form::text('reason',null,['class'=>'form-control m-input','placeholder'=>'ادخل سبب الإرجاع','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>التاريخ</label>
        {!! Form::text('date',isset($discard)?old('date')??optional($discard->date)->format('m-d-Y'):old('date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off','required'=>'required'])!!}
    </div>


    <div class="form-group m-form__group">
        <label>سداد قيمة المرتجع</label>
        <select name="return_type" id="return_type" class="form-control m-input select2" required>
            <option disabled selected >إختار نوع السداد </option>
            <option value="cash">كاش</option>
            <option value="switch">بدل</option>
            <option value="decrease">إنقاص من المديونية</option>
        </select>
    </div>

@include('suppliers.discards.discards_section')

<div id="switch_products_section" style="display: none;">
@include('suppliers.discards.switched_section')
</div>

<div id="receivables_sections" style="display: none;">
    @include('suppliers.discards.receivables_section')
</div>






</div>
