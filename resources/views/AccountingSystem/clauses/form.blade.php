@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
    <input type="number" value="1000" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="currency" id="c1" />
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

<div class="form-group col-xs-6 pull-left">
    <label>  اختر الحساب الفرعى</label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
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
        <input type="checkbox" name="cost_center" value="1"  style="margin-right: 20px;" onclick="myFunction()" id="cost_center" >
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
    });
</script>

<script>
  function myFunction(){
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
</script>
@endsection
