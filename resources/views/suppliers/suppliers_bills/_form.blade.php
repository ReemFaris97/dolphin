<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label> اسم المورد</label>
        {!! Form::select('supplier_id',$suppliers,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>رقم الفاتورة</label>
        {!! Form::number('bill_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل رقم الفاتورة','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>تاريخ الفاتورة</label>
        {!! Form::text('date',isset($bill)?old('date')??optional($bill->date)->format('m-d-Y'):old('date'),['class'=>'form-control m-input datepicker','autocomplete'=>'off','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> نوع السداد</label>
        {!! Form::select('payment_method',["cash"=>"كاش","postpaid"=>"آجل"],null,['class'=>'form-control m-input select2','placeholder'=>'إختر نوع السداد','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>المبلغ المدفوع</label>
        {!! Form::number('amount_paid',isset($bill)?$bill->amount_paid:0,['id'=>'amount_input','class'=>'form-control m-input','placeholder'=>'المبلغ المدفوع','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>المبلغ المتبقي</label>
        {!! Form::number('amount_rest',isset($bill)?$bill->amount_rest:0,['id'=>'rest_input','class'=>'form-control m-input','placeholder'=>'المبلغ المتبقي','required'=>'required'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>قيمة الضريبة</label>
        {!! Form::number('vat',isset($bill)?$bill->vat:0,['id'=>'vat_input','class'=>'form-control m-input','placeholder'=>'قيمة الضريبة','required'=>'required'])!!}
    </div>


    <div class="form-group m-form__group">
        <label>الإجمالي(للعرض فقط)</label>
        {!! Form::number('',isset($bill)? ($bill->amount_paid+$bill->amount_rest+$bill->vat) :0,['id'=>'total_input','class'=>'form-control m-input','placeholder'=>'لعرض القيمة فقط','readonly'=>'readonly'])!!}
    </div>






</div>


@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })

        $('#amount_input').on('keyup',function () {
            var amount =$(this).val();
            var rest = $('#rest_input').val();
            var vat =  $('#vat_input').val();
            var total = parseInt(amount) + parseInt(rest) + parseInt(vat);
            $('#total_input').val(total);
        });

        $('#rest_input').on('keyup',function () {
            var amount = $('#amount_input').val();
            var rest = $(this).val();
            var vat = $('#vat_input').val();
            var total = parseInt(amount) + parseInt(rest) + parseInt(vat);
            $('#total_input').val(total);
        });

        $('#vat_input').on('keyup',function () {
            var amount = $('#amount_input').val();
            var rest =  $('#rest_input').val();
            var vat = $(this).val();
            var total = parseInt(amount) + parseInt(rest) + parseInt(vat);
            $('#total_input').val(total);
        });
    </script>

@endpush
