@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<input type="hidden" name="type"  value="asset"  >

<div class="form-group col-md-6 pull-left">
    <label> اسم  الاصل   </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'   اسم الاصل '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>  العملة </label>
    {!! Form::select("currency_id",$currencies,null,['class'=>'form-control js-example-basic-single currency_id','id'=>'currency_id','placeholder'=>' اختر العملة '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>قيمة الشراء </label>
    {!! Form::text("purchase_price",null,['class'=>'form-control','placeholder'=>'قيمة الشراء'])!!}
</div>



<div class="form-group col-md-6 pull-left">
    <label> اختر الحساب </label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control','required','placeholder'=>' اختر الحساب'])!!}
</div>

<div class="form-group col-md-6 pull-left ">
    <label>تاريخ الشراء  </label>
    {!! Form::date("purchase_date",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-6 pull-left ">
    <label>  اختر طريقةالدفع</label>
    {!! Form::select("payment_id",$payments,null,['class'=>'form-control js-example-basic-single','id'=>'payment_id','required','placeholder'=>' اختر طريقةالدفع   '])!!}
</div>
    <hr>
    <p class="panel-title">  <h5><u>اضافة اهلاك</u></h5></p>
    <hr>
    <div class="form-group col-md-6 pull-left ">
        <label> تاريخ بداية الاهلاك</label>
        {!! Form::date("damage_start_date",null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-md-6 pull-left ">
        <label> تاريخ نهاية الاهلاك </label>
        {!!
        Form::date("damage_end_date",null,['class'=>'form-control'])!!}
    </div>
    <div class="form-group col-md-6 col-xs-12 pull-left">
        <label>طريقة الاهلاك </label>
        {!! Form::select("damage_type",['fixed_installment'=>'التقسيط الثابت'],Null,['class'=>'form-control','id'=>'damage_type','placeholder'=>'اختر طريقة الاهلاك '])!!}
    </div>
    <div class="form-group col-md-6 pull-left fixed_installment">
        <label> مبلغ الاهلاك </label>
        {!! Form::text("damage_price",null,['class'=>'form-control','placeholder'=>'مبلغ الاهلاك '])!!}
    </div>

    <div class="form-group col-md-6 pull-left fixed_installment">
        <label>  مدة الاهلاك </label>
        <div class="form-group col-sm-3 pull-left">
            {!! Form::text("damage_period",null,['class'=>'form-control'])!!}
        </div>

        <div class="form-group col-sm-3 pull-left">
            {!! Form::select("damage_period_type",['day'=>'يوم','week'=>'اسبوع','month'=>'شهر',],Null,['class'=>'form-control','id'=>'type'])!!}
        </div>
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

    $('#damage_type').change(function() {
    var type = $('#damage_type').val();
    if (type=='fixed_installment'){

     $('.fixed_installment').show();
    }
    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
