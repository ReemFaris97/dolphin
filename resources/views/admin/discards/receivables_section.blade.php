<div class="checker-wrapper">
    <h4 class="the-big-checklabel">الخصم من المديونية</h4>
</div>


<div class="one-single-emp-wrapper">

    <div class="form-group m-form__group">
        <label>جمالي المديونية للمورد</label>
        <input type="number" id="receivable_amount"  name="receivable_amount" class="form-control m-input"  placeholder="إجمالي المديونية للمورد" disabled>

    </div>

    <div class="form-group m-form__group">
        <label>قيمة الخصم من المديونية</label>
        <input type="number" name="paid_amount" value=0 id="paid_amount" class="form-control m-input" placeholder="قيمة الخصم من المديونية" oninput="this.value = Math.abs(this.value)">
{{--        {!! Form::number('paid_amount',null,['id'=>'paid_amount','class'=>'form-control m-input','placeholder'=>'قيمة الخصم من المديونية','oninput'=>'this.value = Math.abs(this.value)'])!!}--}}
    </div>
    <div class="form-group m-form__group">
        <label>المديونية الحالية</label>
        {!! Form::number('',0,['id'=>'current_receivable','class'=>'form-control m-input','placeholder'=>'المديونية الحالية'])!!}
    </div>





</div>



