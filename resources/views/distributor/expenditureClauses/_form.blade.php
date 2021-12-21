<div x-data="{
    type:0,
    payable_id:null,
    get  payable_type(){
        return [
      @js(\App\Models\ExpenditureType::class),
      @js(\App\Models\AccountingSystem\AccountingSupplier::class),
       ][this.type]
    },
}" x-init="
select_type = $($refs.type_select).select2();
select_type.on('select2:select', (event) => {
    type = event.target.value;
  });
  $watch('type', (value) => {
    select_type.val(value).trigger('change');

    if(value==1){
        select_supplier = $($refs.supplier_select).select2();
        select_supplier.on('select2:select', (event) => {
        payable_id = event.target.value;
  });

}
if(value==0){
    expenditure_type = $($refs.expenditure_type).select2();
    expenditure_type.on('select2:select', (event) => {
    payable_id= event.target.value;
});

}

});

">
<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>


    <div class="form-group m-form__group" >
        <label>مصدر الصرف</label>
        {!! Form::select('type',['من مندوب','من مورد'],null,['class'=>'form-control m-input ','placeholder'=>'ادخل مصدر الصرف','x-model'=>'type','x-ref'=>'type_select'])!!}
    </div>
    <input name="payable_type" type="hidden"
    x-model="payable_type"/>
    <template x-if="type==0">

    <div class="form-group m-form__group" >
        <label>نوع الصرف</label>
        {!! Form::select('expenditure_type_id',$expenditure_types,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل نوع الصرف','x-model'=>'payable_id','x-ref'=>'expenditure_type'])!!}
    </div>
    </template>
    <template x-if="type==1">

        <div class="form-group m-form__group" >
            <label>نوع المورد</label>

            {!! Form::select('supplier_id',\App\Models\AccountingSystem\AccountingSupplier::pluck('name','id'),null,['class'=>'form-control m-input','placeholder'=>'ادخل نوع الصرف','x-ref'=>'supplier_select','x-model'=>'payable_id'])!!}
        </div>

    </template>

    <input name="payable_type" type="hidden"
    x-model="payable_type"/>

    <input name="payable_id" type="hidden"
    x-model="payable_id"/>
</div>
</div>
@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
