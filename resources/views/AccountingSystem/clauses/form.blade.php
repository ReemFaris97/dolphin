@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if( isset($clause))
    @if ($clause->concerned==1)

        <div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					<span class="new-radio-wrap">
                        <label>عميل</label>
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()"  checked="checked" disabled >
                    </span>

					<span class="new-radio-wrap">
                            <label>مورد</label>
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()" disabled >

            </span>
            <span class="new-radio-wrap">
                            <label>عام</label>
                <input type="radio" name="concerned" class="styled type" value="general" onclick="myFunction2()"
                       disabled>

            </span>
        </div>
    @else

            <div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					<span class="new-radio-wrap">
                        <label>عميل</label>
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()" disabled>

                    </span>

                <span class="new-radio-wrap">
                        <label>مورد</label>
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()" checked="checked" disabled>
                </span>
                <span class="new-radio-wrap">
                            <label>عام</label>
                <input type="radio" name="concerned" class="styled type" value="general" onclick="myFunction2()"
                       disabled>

            </span>
        </div>
    @endif
    @else
    <div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					<span class="new-radio-wrap">
                        <label>عميل</label>
            <input type="radio" name="concerned" class="styled type" id="basic" onclick="myFunction()"  value="client">

                    </span>
        <span class="new-radio-wrap">
                        <label>مورد</label>
            <input type="radio" name="concerned"  class="styled type" id="part"  onclick="myFunction2()"   value="supplier">

        </span>
        <span class="new-radio-wrap">
                            <label>عام</label>
                <input type="radio" name="concerned" class="styled type" value="general">

            </span>
    </div>
@endif


{{--<div class="form-group col-md-6 pull-left clients">--}}
{{--<label>   اختر  العميل</label>--}}
{{--{!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>' اختر  العميل'])!!}--}}
{{--</div>--}}

{{--<div class="form-group col-md-6 pull-left suppliers">--}}
{{--<label>   اختر المورد </label>--}}
{{--{!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control','placeholder'=>'  اختر المورد '])!!}--}}
{{--</div>--}}

<div class="clearfix"></div>

<div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left">
    <label> اسم الشركة </label>
    {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة  '])!!}
</div>


<div class="form-group col-md-4 pull-left">
    <label>نوع السند </label>
    {!! Form::select("type",['revenue'=>'قبض','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع السند  '])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label>   اسم  البند </label>
    {!! Form::select("benod_id",$benods,null,['class'=>'form-control','placeholder'=>' اختر  اسم البند '])!!}
</div>
<div class="form-group col-md-4 pull-left">
    <label>المكرم /السيد </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' الاسم    '])!!}
</div>


<div class="form-group col-md-4 pull-left">
    <label> العمله الافتراضية  </label>
    {!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label>المبلغ </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ    '])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label>  خزينة الدفع</label>
    {!! Form::select("safe_id",$safes,null,['class'=>'form-control','placeholder'=>' خزينة الدفع '])!!}
</div>



<div class="form-group col-md-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper">
    <label>طريقه الدفع</label>
    <span class="new-radio-wrap">
        <label for="cash">نقدى</label>
        <input type="radio" name="payment" class="styled type" value="cash" id="cash">
     </span>

    <span class="new-radio-wrap">
     <label for="network">شبكة</label>
        <input type="radio" name="payment" class="styled type" value="network" id="network">
    </span>


    <span class="new-radio-wrap">
     <label for="bank_translation">تحويل بنكى</label>
        <input type="radio" name="payment" class="styled type" value="bank_translation" id="bank_translation">
    </span>

    <span class="new-radio-wrap">
     <label for="check">شيك</label>
        <input type="radio" name="payment" class="styled type" value="check" id="check">
    </span>
</div>
        <div class="banks">
            <div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left">
                <label> اسم البنك </label>
                {!! Form::select("bank_id",companies(),null,['class'=>'form-control js-example-basic-single bank_id','id'=>'bank_id','placeholder'=>' اختر البنك '])!!}
            </div>


            <div class="form-group col-md-4 pull-left">
                <label>رقم  التحويل او الشيك </label>
                {!! Form::text("num_transaction",null,['class'=>'form-control','placeholder'=>' رقم  التحويل او الشيك    '])!!}
            </div>

            <div class="form-group col-md-4 pull-left">
                <label>صورة التحويل</label>
                {!! Form::file("image",null,['class'=>'form-control'])!!}
            </div>

        </div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')

<script>

    $(document).ready(function() {

        $('.clients').hide();
        $('.banks').hide();
        $(".suppliers").hide();
        $('.js-example-basic-single').select2();

    });

</script>

<script>
    if (document.getElementById("bank_translation").checked == true){
        alert("uyuyuy");
    }
    function myFunction() {
        $(".clients").show();
        $(".suppliers").hide();
    }
    function myFunction2() {
        $(".clients").hide();
        $(".suppliers").show();
    }
    function f() {
        if (document.getElementById("bank_translation").checked == true){
            alert("uyuyuy");
        }
    }

    </script>
@endsection
