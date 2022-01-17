@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="devices">

</div>


<div class="form-group col-md-6 pull-left">
    <label>اسم  الخزنة </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' اسم الخزنة   '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> اسم  الخزنة بالانجليزية </label>
    {!! Form::text("name_en",null,['class'=>'form-control','placeholder'=>' اسم الخزنة بالانجلزية   '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الشركة </label>
    {!! Form::select("company_id",$companies,null,['class'=>'form-control','placeholder'=>'اختر الشركة'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>الفرع </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control','placeholder'=>'اختر الفرع'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>نوع الحساب </label>
    {!! Form::select("is_bank",['خزنة','حساب بنكى'],0,['class'=>'form-control','placeholder'=>'اختر نوع الحزنية'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>رقم الحساب </label>
    {!! Form::text("bank_account_number",null,['class'=>'form-control','placeholder'=>'رقم الحساب'])!!}
</div>





<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit"  class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
