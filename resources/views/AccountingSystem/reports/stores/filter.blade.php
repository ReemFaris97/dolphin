@if (count($errors) > 0)
    {{--@php popup('error',$errors->all()) @endphp--}}
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group col-sm-3">
    <label> الشركة </label>
    {!! Form::select("company_id",companies(),null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الشركة','data-live-search'=>'true','id'=>'company_id'])!!}
</div>
<div class="form-group col-sm-3">
    <label> الفرع </label>
    {!! Form::select("branch_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الفرع','data-live-search'=>'true','id'=>'branch_id'])!!}
</div>

<div class="form-group col-sm-3">
    <label> المستودع </label>
    {!! Form::select("store_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر المستودع','data-live-search'=>'true','id'=>'store_id'])!!}
</div>
<div class="form-group col-sm-3">
    <label> الصنف </label>
    {!! Form::select("product_id",[],null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر الصنف','data-live-search'=>'true','id'=>'product_id'])!!}
</div>
<div class="form-group col-sm-4">
    <label> من </label>
    {!! Form::date("from",null,['class'=>'form-control','placeholder'=>'من','id'=>'example-date'])!!}
</div>
<div class="form-group col-sm-4">
    <label> الى </label>
    {!! Form::date("to",null,['class'=>'form-control','placeholder'=>'الى','id'=>'example-date'])!!}
</div>
<div class="form-group col-sm-4">
    <label>  </label>
    <input type="submit" value="بحث" class="btn btn-success">
</div>