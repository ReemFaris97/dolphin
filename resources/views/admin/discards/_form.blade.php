<div class="m-portlet__body ">
    <div class="form-group m-form__group">
        <label>المورد </label>
        {!! Form::select('supplier_id',$suppliers,null,['id'=>'supplier_id','class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد'])!!}
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
    </div>

@include('admin.discards.switched_section')

@include('admin.discards.discards_section')



</div>
