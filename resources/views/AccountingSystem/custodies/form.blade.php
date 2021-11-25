@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<input type="hidden" name="type"  value="custdoy"  >

<div class="form-group col-md-6 pull-left">
    <label> اسم  العهدة   </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'   اسم  العهدة'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>  العملة </label>
    {!! Form::select("currency_id",$currencies,null,['class'=>'form-control js-example-basic-single currency_id','id'=>'currency_id','placeholder'=>' اختر العملة '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>قيمة العهدة </label>
    {!! Form::text("purchase_price",null,['class'=>'form-control','placeholder'=>'قيمة العهده'])!!}
</div>



<div class="form-group col-md-6 pull-left">
    <label> اختر الحساب </label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر الحساب'])!!}
</div>

<div class="form-group col-md-6 pull-left ">
    <label>تاريخ العهدة  </label>
    {!! Form::date("purchase_date",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-6 pull-left ">
    <label>  اختر طريقةالدفع</label>
    {!! Form::select("payment_id",$payments,null,['class'=>'form-control js-example-basic-single','id'=>'payment_id','required','placeholder'=>' اختر طريقةالدفع   '])!!}
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')
    <script>
    $(document).ready(function () {
    $('.js-example-basic-single').select2();
    $('.fixed_installment').hide();
    });

    $('#payment_id').change(function() {
        var type = $('#payment_id').val();
        if (type == 'fixed_installment') {
            $('.fixed_installment').show();
        }
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
