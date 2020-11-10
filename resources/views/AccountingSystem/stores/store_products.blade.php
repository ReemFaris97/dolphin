<div class="form-group col-md-4 pull-left">
    <label>اختر الصنف </label>
    {!! Form::select("product_id[]",$products,null,['class'=>'form-control selectpicker product_id','multiple','id'=>'product_id','placeholder'=>' اختر  الصنف'])!!}
</div>
