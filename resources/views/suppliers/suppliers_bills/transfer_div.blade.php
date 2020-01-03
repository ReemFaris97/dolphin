<div id="transfer" style="display: none;">

    <div class="form-group m-form__group">
        <label>تاريخ التحويل</label>
        {!! Form::text('transfer_date',isset($bill)?old('transfer_date')??optional($bill->transfer_date)->format('m-d-Y'):old('transfer_date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>رقم التحويل</label>
        {!! Form::number('transfer_number',isset($bill)?$bill->transfer_number:0,['class'=>'form-control m-input','placeholder'=>'رقم التحويل'])!!}
    </div>

</div>
