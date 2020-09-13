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
                        <label for="client">عميل</label>
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
                        <label for="client">عميل</label>
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
                        <label for="client">عميل</label>
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()" >

                    </span>

            <span class="new-radio-wrap-sanad">
                        <label for="supplier">مورد</label>
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()"  >
                </span>
            <span class="new-radio-wrap-sanad">
                            <label >عام</label>
                <input type="radio" name="concerned" class="styled type" value="general" onclick="myFunction3()" checked="checked">

            </span>
        </div>

    @endif
    @else
    <div class="form-group col-md-4 col-sm-4 col-xs-4 pull-left  form-line sanads ">
					<span class="new-radio-wrap-sanad">
                        <label for="client">عميل</label>
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


<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label>نوع السند [قبض-صرف]</label>
    {!! Form::select("type",['revenue'=>'قبض','expenses'=>'صرف','check_revenue'=>'شيك قبض ','check_expenses'=>' شيك صرف '],null,['class'=>'form-control','placeholder'=>' نوع السند  ','id'=>'type'])!!}
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label> التاريخ</label>
    {!! Form::date("date",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label>المبلغ </label>
    {{-- {!! Form::number("amount",null,['class'=>'form-control','placeholder'=>' المبلغ','id'=>'amount','pattern'=>'^\d+(\.|\,)\d{2}$'])!!} --}}
    <input type="number"  name="amount"min="0" step="0.01"  class="form-control" />
</div>
<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left">
    <label> العمله   </label>
    {!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله '])!!}
</div>

{{-- <div class="form-group col-md-9 col-sm-9 col-xs-9  pull-left ">
    <label>البيان </label>
    {!! Form::text("description",null,['class'=>'form-control','placeholder'=>' البيان  '])!!}
</div> --}}

<div class="form-group col-md-3 col-sm-3 col-xs-3  pull-left check">
    <label> رقم الشيك</label>
    {!! Form::text("num",null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-xs-6 pull-left payments ">
    <label>  اختر طريقةالدفع</label>
    {!! Form::select("payment_id",$payments,null,['class'=>'form-control js-example-basic-single','id'=>'payment_id','placeholder'=>' اختر طريقةالدفع   '])!!}
</div>



<div class="form-group col-xs-6 pull-left revenue_accounts">
    <label>  اختر طريقة القبض</label>
    {!! Form::select("revenue_account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر طريقة القبض   '])!!}
</div>

<div class="form-group col-xs-6 pull-left accounts">
    <label>  اختر الحساب الفرعى</label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
</div>
<div class="form-group col-xs-6 pull-left client_accounts">
    <label>  اختر حساب العميل</label>
    {!! Form::select("account_id",$client_accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>'  اختر  حساب العميل ','disablePlaceholder' => true])!!}
</div>
<div class="form-group col-xs-6 pull-left supplier_accounts">
    <label>  اختر الحساب المورد</label>
    {!! Form::select("account_id",$supplier_accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>'  اختر  حساب المورد','disablePlaceholder' => true])!!}
</div>
<div class="form-group col-xs-6 pull-left">
    <label>   ارفاق صورة</label>
    {!! Form::file("image",null,['class'=>'file-styled'])!!}
</div>
@if( isset($clause))
    <div class="form-group col-md-6 pull-left">
        <label>الصوره  الحالية : </label>
        <img src="{{getimg($clause->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>
@endif

<div class="clearfix"></div>
    <div class="form-group checkbox checkbox-left  col-xs-3 " >
     <label for=""></label>
        <input type="checkbox" name="cost_center" value="1"  style="margin-right: 20px;" onclick="cost_center()" id="cost_center" >
        <label  for="cost_center">
            تعين مركز تكلفه
        </label>
    </div>
<div class="form-group col-xs-6 pull-left centers">
    <label>  اختر مركز التكلفة</label>
    {!! Form::select("center_id",$centers,null,['class'=>'form-control js-example-basic-single','id'=>'center_id','placeholder'=>' اختر مركز التكلفة   '])!!}
</div>


<div class="form-group col-xs-12  pull-left">
    <label> ملاحظات</label>
   {!! Form::textarea("notes",null,['class'=>'form-control'])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

<script>
    $(document).ready(function() {
          $('.js-example-basic-single').select2();
          $('.centers').hide();
          $('.revenue_accounts').hide();
          $('.payments').hide();
          $('.check').hide();
          $(".client_accounts").hide();
        $(".supplier_accounts").hide();
        $(".accounts").hide();
    });
</script>

<script>
  function cost_center(){
    $('.centers').show();

  }

  $("#type").on('change', function() {

            var type=$('#type').val();

            if (type=='revenue'||type=='check_revenue') {

                $('.revenue_accounts').show();
                $('.payments').hide();


              }else{
               $('.revenue_accounts').hide();
               $('.payments').show();
            }


            if (type=='check_revenue'||type=='check_expenses') {
                $('.check').show();

            }else{
                $('.check').hide();

            }

  });

  $('input[type=checkbox][name=cost_center]').change(function() {
    if (this.checked ==true) {
        $('.centers').show();
    }
    else if (this.checked == false) {
        $('.centers').hide();
    }
});


function myFunction() {
        $(".client_accounts").show();
        $(".supplier_accounts").hide();
        $(".accounts").hide();
        $('.benods').hide();
    }
    function myFunction2() {
        $(".client_accounts").hide();
        $(".supplier_accounts").show();
        $(".accounts").hide();
        $(".benods").hide();

    }
    function myFunction3() {
        $(".client_accounts").hide();
        $(".supplier_accounts").hide();
        $(".accounts").show();
        $(".benods").show();
    }


</script>

@endsection
