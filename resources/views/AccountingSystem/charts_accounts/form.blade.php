@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>اسم الحساب باللغة العربية   </label>
    {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>'  اسم الحساب باللغة العربية  '])!!}
</div>
<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>اسم الحساب باللغة الانجليزية   </label>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>'  اسم الحساب باللغة الانجليزية  '])!!}
</div>
@if(isset($account))
 <div class="form-group col-sm-6 col-xs-12 pull-left">
 <label>الكود  </label>
   {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  الكود   '])!!}
</div>
@endif
<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> نوع  الحساب  </label>
    {!! Form::select("kind",['main'=>'حساب رئيسى','sub'=>'حساب فرعى','following_main'=>' حساب رئيسى تابع'],Null,['class'=>'form-control','id'=>'kind'])!!}
</div>


<div class="form-group col-sm-6 col-xs-12 pull-left accounts">
    <label>  اختر الحساب الرئيسى </label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
</div>
@if(isset($account))
@if($account->kind=='following_main'||$account->kind=='sub')


<div class="form-group col-sm-6 col-xs-12 pull-left ">
    <label>  اختر الحساب الرئيسى </label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
</div>



@endif

@endif


<div class="form-group col-xs-6 pull-left  ">
    <label>طبيعة الحساب  </label>
    <div class="form-line new-radio-big-wrapper">
	<span class="new-radio-wrap">
		<label for="Creditor">دائن </label>
			{!! Form::radio("status",'Creditor',['class'=>'form-control','id'=>'Creditor'])!!}
    </span>
    <span class="new-radio-wrap">
		<label for="debtor"> مدين </label>
	     {!! Form::radio("status",'debtor',['class'=>'form-control','id'=>'debtor'])!!}
	</span>
    </div>
</div>

<div class="form-group col-xs-6 col-xs-12 ">
    <label> مركزتكلفه  </label>
    <div class="form-line new-radio-big-wrapper">
	<span class="new-radio-wrap">
		<label for="yes">نعم </label>
			{!! Form::radio("cost_center",'1',['class'=>'form-control','id'=>'yes'])!!}
    </span>
    <span class="new-radio-wrap">
		<label for="no"> لا </label>
	     {!! Form::radio("cost_center",'0',['class'=>'form-control','id'=>'no'])!!}
	</span>
    </div>
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left centers">
    <label>   مراكز التكلفة </label>
    {!! Form::select("center_id[]",$centers,null,['class'=>'form-control selectpicker ','multiple','id'=>'center_id'])!!}
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left openning_balance">
    <label>الرصيد الافتتاحى  </label>
      {!! Form::text("openning_balance",null,['class'=>'form-control','placeholder'=>'  الرصيد الافتتاحى    '])!!}
   </div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $('.accounts').hide();
            $(".centers").hide();
            $('.openning_balance').hide();

        });
    </script>
    <script>


        $('#kind').change(function() {
             var kind = $('#kind').val();
             if (kind=='main'){
                 $('.accounts').hide();
                 $('.openning_balance').hide();

             }else if(kind=='sub') {
                 $('.accounts').show();
            $('.openning_balance').show();
             }else if(kind=='following_main') {
                 $('.accounts').show();
                 $('.openning_balance').hide();
             }
        });

        $('input[type=radio][name=cost_center]').change(function() {
    if (this.value == 1) {
        $(".centers").show();
    }
    else if (this.value ==0) {
        $(".centers").hide();

    }
});

    </script>
@endsection
