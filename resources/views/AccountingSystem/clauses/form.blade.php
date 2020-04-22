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
    @if ($clause->concerned=='client')

        <div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left  form-line sanad ">
					<span class="new-radio-wrap-sanad">
                        <label>عميل</label>
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()"  checked="checked" disabled >
                    </span>

					<span class="new-radio-wrap-sanad">
                            <label>مورد</label>
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()"  >

            </span>
            <span class="new-radio-wrap-sanad">
                            <label>عام</label>
                <input type="radio" name="concerned" class="styled type" value="general" onclick="myFunction3()" >

            </span>
        </div>
    @elseif ($clause->concerned=="supplier")


        <div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left  form-line sanads ">
					<span class="new-radio-wrap-sanad">
                        <label>عميل</label>
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()" disabled>

                    </span>

                <span class="new-radio-wrap-sanad">
                        <label>مورد</label>
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()" checked="checked" disabled>
                </span>
                <span class="new-radio-wrap-sanad">
                            <label>عام</label>
                <input type="radio" name="concerned" class="styled type" value="general" onclick="myFunction2()"
                       disabled>

            </span>
        </div>
        @else
        <div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left  form-line sanads ">
					<span class="new-radio-wrap-sanad">
                        <label>عميل</label>
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()" >

                    </span>

            <span class="new-radio-wrap-sanad">
                        <label>مورد</label>
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()"  >
                </span>
            <span class="new-radio-wrap-sanad">
                            <label>عام</label>
                <input type="radio" name="concerned" class="styled type" value="general" onclick="myFunction3()" checked="checked">

            </span>
        </div>

    @endif
    @else
    <div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left  form-line sanads ">
					<span class="new-radio-wrap-sanad">
                        <label>عميل</label>
            <input type="radio" name="concerned" class="styled type"  onclick="myFunction()" id="client"  value="client">

                    </span>
        <span class="new-radio-wrap-sanad">
                        <label for="supplier">مورد</label>
            <input type="radio" name="concerned"  class="styled type"   onclick="myFunction2()"  id="supplier"  value="supplier">

        </span>
        <span class="new-radio-wrap-sanad">
                            <label for="general">عام</label>
                <input type="radio" name="concerned" class="styled type"  onclick="myFunction3()" id="general" value="general">

            </span>
    </div>
@endif
<div class="clearfix"></div>

<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left">
    <label> اسم الشركة </label>
    {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة  '])!!}
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left clients">
<label>   اختر  العميل</label>
{!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>' اختر  العميل','id'=>'client_id'])!!}
</div>
<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left clients">
    <label>  رصيد العميل</label>
    <input type="text" id="client_balance" class="form-control" readonly>
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left suppliers">
<label>   اختر المورد </label>
{!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control','placeholder'=>'  اختر المورد ','id'=>'supplier_id'])!!}
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left suppliers">
    <label>   رصيد المورد </label>
    <input type="text" id="balance" class="form-control" readonly>
</div>



<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label>نوع السند [قبض-صرف]</label>
    {!! Form::select("type",['revenue'=>'قبض','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع السند  ','id'=>'type'])!!}
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left benods">
    <label>   اسم  البند </label>
    {!! Form::select("benod_id",$benods,null,['class'=>'form-control','placeholder'=>' اختر  اسم البند '])!!}
</div>
<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left name">
    <label>المكرم /السيد </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' الاسم  '])!!}
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label> التاريخ</label>
    {!! Form::date("date",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-9 col-sm-9 col-xs-9  pull-left ">
    <label>البيان </label>
    {!! Form::text("description",null,['class'=>'form-control','placeholder'=>' البيان  '])!!}
</div>
{{--<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">--}}
    {{--<label> العمله الافتراضية  </label>--}}
    {{--{!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}--}}
{{--</div>--}}

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label>المبلغ </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ    ','id'=>'amount'])!!}
</div>
<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left clients">
    <label> الرصيد الجديد للعميل</label>
    <input type="text" id="new_client_balance" class="form-control" readonly>
</div>
<div class="form-group col-md-3 col-sm-3 col-xs-3 pull-left suppliers">
    <label> الرصيد الجديد </label>
    <input type="text" id="new_balance" class="form-control" readonly>
</div>
<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label>  خزينة الدفع</label>
    {!! Form::select("safe_id",$safes,null,['class'=>'form-control','placeholder'=>' خزينة الدفع '])!!}
</div>



<div class="form-group col-md-6 col-xs-12 pull-left taxs  form-line sanads">
    <label>طريقه الدفع</label>

    <span class="new-radio-wrap-sanad">
        <label for="cash">نقدى</label>
        <input type="radio" name="payment" class="styled type" value="cash" id="cash">
     </span>

    <span class="new-radio-wrap-sanad">
     <label for="network">شبكة</label>
        <input type="radio" name="payment" class="styled type" value="network" id="network">
    </span>


    <span class="new-radio-wrap-sanad">
     <label for="bank_translation">تحويل بنكى</label>
        <input type="radio" name="payment" class="styled type" value="bank_translation" id="bank_translation">
    </span>

    <span class="new-radio-wrap-sanad">
     <label for="check">شيك</label>
        <input type="radio" name="payment" class="styled type" value="check" id="check">
    </span>

</div>
<div class="clearfix"></div>
        <div class="banks">

            <div class="form-group col-md-4  pull-left">
                <label> اسم البنك </label>
                {!! Form::select("bank_id",$banks,null,['class'=>'form-control js-example-basic-single bank_id','id'=>'bank_id','placeholder'=>' اختر البنك '])!!}
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

<div class="form-group col-md-6 col-sm-6 col-xs-12  pull-left">
    <label> ملاحظات</label>
   {!! Form::textarea("notes",null,['class'=>'form-control'])!!}
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

        $('.name').hide();
        $('.js-example-basic-single').select2();

    });

</script>

<script>



    $('#bank_translation').click(function () {
        $('.banks').show();

    });

    $('#check').click(function () {
        $('.banks').show();

    });

    $('#cash').click(function () {
        $('.banks').hide();

    });
    $('#network').click(function () {
        $('.banks').hide();

    });
    function myFunction() {
        $(".clients").show();
        $(".suppliers").hide();
        $('.name').hide();

        $('.benods').hide();
    }
    function myFunction2() {
        $(".clients").hide();
        $(".suppliers").show();
        $('.name').hide();
        $(".benods").hide();

    }
    function myFunction3() {
        $(".clients").hide();
        $(".suppliers").hide();
        $('.name').show();
        $(".benods").show();


    }

    </script>
<script>
    $("#type").on('change', function() {
        $('#new_balance').val("");
        $('#new_client_balance').val("");
        $('#amount').val("");

    });


    $("#supplier_id").on('change', function() {
        var id= $(this).val();
        $.ajax({
            url: "/accounting/getBalance/" + id,
            type: "GET",
        }).done(function (data) {

            $('#balance').val(data.data);
        }).fail(function (error) {
            console.log(error);
        });
        $("#amount").on('change', function() {
            var amount= $(this).val();
            var balance=  $('#balance').val();
            var new_balance=0;
            var type=$('#type').val();
            if (type=='revenue') {
             new_balance=Number(balance)+Number(amount);

              }else{
                new_balance=Number(balance)-Number(amount);

            }
            $('#new_balance').val(new_balance);

        });
    });



    $("#client_id").on('change', function() {
        var id= $(this).val();
        $.ajax({
            url: "/accounting/getClient/" + id,
            type: "GET",
        }).done(function (data) {

            $('#client_balance').val(data.data);
        }).fail(function (error) {
            console.log(error);
        });

        $("#amount").on('change', function() {
            var amount= $(this).val();
            var balance_client=  $('#client_balance').val();
            var new_balance=0;
            var type=$('#type').val();

            if (type=='revenue') {
                new_balance=Number(balance_client)-Number(amount);
            }else if(type=='expenses'){

                new_balance=Number(balance_client) + Number(amount);

            }
            $('#new_client_balance').val(new_balance);

        });
    });


</script>
@endsection
