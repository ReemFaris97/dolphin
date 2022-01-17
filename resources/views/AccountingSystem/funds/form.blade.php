@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




<div class="form-group col-md-6 pull-left">
    <label>اسم  الخزنة </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' اسم الخزنة   '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> اسم  الخزنة بالانجليزية </label>
    {!! Form::text("name_en",null,['class'=>'form-control','placeholder'=>' اسم الخزنة بالانجلزية'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الشركة </label>
    {!! Form::select("company_id",$companies,null,['class'=>'form-control select2','placeholder'=>'اختر الشركة'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>الفرع </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control select2','placeholder'=>'اختر الفرع'])!!}
</div>
<div x-data="{is_bank:{{isset($fund)?$fund->is_bank:0}} }">
<div class="form-group col-md-6 pull-left">
    <label>نوع الحساب </label>
    {!! Form::select("is_bank",['خزنة','حساب بنكى'],isset($fund)?$fund->is_bank:0,['class'=>'form-control',
    'x-model'=>'is_bank',
    'placeholder'=>'اختر نوع الحزنية'])!!}
</div>

<div class="form-group col-md-6 pull-left" x-show="is_bank=='1'">
    <label>رقم الحساب </label>
    {!! Form::text("bank_account_number",null,['class'=>'form-control','placeholder'=>'رقم الحساب'])!!}
</div>
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit"  class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
<script defer>


getBranchesOfCompany(company_id){

    $.ajax({
    url:`/accounting/ajax/branches/${company_id}`,
    success:function(data){
        var options=`<option disabled value=" ">اختر الفرع</option>`;
        data.forEach(function(value){
            options+=`<option value="${value.id}">${value.name}</option>`
        })
        $("select[name='branch_id']").html(options);
    }
})
}
$("select[name='company_id']").change(function(){
getBranchesOfCompany(this.value){

})
</script>
