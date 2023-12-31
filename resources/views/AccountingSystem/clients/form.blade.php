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
    <label>اسم العميل  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم العميل  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>جوال   </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'جوال '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>ايميل   </label>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  الايميل  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>الفاكس  </label>
    {!! Form::text("fax",null,['class'=>'form-control','placeholder'=>' الفاكس  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>رقم ضريبى  </label>
    {!! Form::text("tax_number",null,['class'=>'form-control','placeholder'=>' رقم ضريبى  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> رقم السجل التجارى  </label>
    {!! Form::text("tax_number",null,['class'=>'form-control','placeholder'=>'  رقم السجل التجارى  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> طريقة اصدار الفاتورة  </label>
    {!! Form::select("type_bills",['via_email'=>'ارسال  عبر  الايميل','via_message'=>'ارسال  عبر  الرسائل النصية','via_whats_up'=>'ارسال  عبر  الواتس اب',],null,['class'=>'form-control','placeholder'=>'طريقة اصدار الفاتورة'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> انواع السعر  </label>
    {!! Form::select("type_price",['wholesale'=>'سعر التجزئة','sale'=>'سعر البيع'],null,['class'=>'form-control','placeholder'=>' انواع السعر '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> العمله الافتراضية  </label>
    {!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}
</div>

@if (getsetting('automatic_clients')==0)
    <div class="form-group col-md-6 pull-left">
        <label> اختر الحساب </label>
        {!! Form::select("account_id",accounts(),null,['class'=>'form-control','placeholder'=>' اختر الحساب'])!!}
    </div>
    @else

    <div class="clearfix ">

    </div>
@endif

<div class="form-group col-md-4 pull-left ">

<div class="form-group col-md-4 pull-left credit ">
    <label>السياسة الائتمانية </label>
    <span class="new-radio-wrap">
    <label for="amount">حد دين </label>
    {!! Form::radio("credit","1",['class'=>'form-control credit','id'=>'amount','value'=>"1" ])!!}
    </span>
    <span class="new-radio-wrap">
    <label for="period">فترة دين </label>
    {!! Form::radio("credit","0",['class'=>'form-control credit', 'id'=>'period','value'=>"0"])!!}
    </span>
</div>
<div class="form-group col-md-6  amount">
     <label>حد الدين</label>
    {!! Form::text("amount",null,['class'=>'form-control'])!!}
</div>
    <div class="form-group col-md-6  period">
    <label>فتره الدين  </label>
    {!! Form::text("period",null,['class'=>'form-control'])!!}
</div>
</div>



<div class="form-group col-md-4 pull-left  ">
    <label> التعاملات الضربية </label>
    <span class="new-radio-wrap">
    <label for=""> معفى من الضريبة </label>
    {!! Form::radio("taxes_status",0,['class'=>'form-control','value'=>0 ])!!}
    </span>
    <span class="new-radio-wrap">
    <label>خاضع للضريبة </label>
    {!! Form::radio("taxes_status",1,['class'=>'form-control','value'=>1])!!}
    </span>
</div>




{{--<div class="form-group col-md-4 pull-left credit ">--}}
    {{--<label> التصنيف </label>--}}
    {{--<span class="new-radio-wrap">--}}
    {{--<label> افراد </label>--}}
    {{--{!! Form::radio("category",0,['class'=>'form-control','value'=>0 ])!!}--}}
    {{--</span>--}}
    {{--<span class="new-radio-wrap">--}}
    {{--<label>شركات </label>--}}
    {{--{!! Form::radio("category",1,['class'=>'form-control','value'=>1])!!}--}}
    {{--</span>--}}
{{--</div>--}}

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $(".amount").hide();
            $(".period").hide();


        });
    </script>
    <script>

                $(function(){
                    $('.credit').on('click', function(e){
                        if ($(this).is(':checked'))
                        {
                            var id=$(this).val();

                            if (id=='1'){

                                $(".amount").show();
                                $(".period").hide();

                            }else if (id=="0"){
                                $(".period").show();
                                $(".amount").hide();
                            }
                        }
                    });
                });

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
