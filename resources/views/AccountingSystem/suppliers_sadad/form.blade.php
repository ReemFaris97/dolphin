@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<input type="hidden" name="concerned"   value="supplier">

<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
    <label> اسم الشركة </label>
    {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له المنتج '])!!}
</div>
<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
    <label> اسم الفرع التابع </label>
    {!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
</div>

<div class="form-group col-md-6 pull-left suppliers">
    <label>اختر المورد </label>
    {!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control','placeholder'=>'  اختر المورد ','id'=>'supplier_id'])!!}
</div>
<div class="form-group col-md-6 pull-left suppliers">
    <label>رصيد المورد </label>
<input type="text" id="balance" class="form-control" readonly>
</div>

<div class="clearfix"></div>


<div class="form-group col-md-6 pull-left">
    <label> اسم البند </label>
    {!! Form::select("benod_id",$benods,null,['class'=>'form-control','placeholder'=>' اختر  اسم البند '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> العمله الافتراضية </label>
    {!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>المبلغ </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ    ' ,'id'=>'amount'])!!}
</div>

<div class="form-group col-md-6 pull-left suppliers">
    <label> الرصيد الجديد </label>
    <input type="text" id="new_balance" class="form-control" readonly>
</div>
<div class="form-group col-md-6 pull-left">
    <label> خزينة الدفع</label>
    {!! Form::select("safe_id",$safes,null,['class'=>'form-control','placeholder'=>' خزينة الدفع '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>نوع السند </label>
    {!! Form::select("type",['revenue'=>'ايراد','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع البند  '])!!}
</div>



       <div class="form-group col-md-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper">
           <label>طريقه الدفع</label>
					<span class="new-radio-wrap">
                              <label for="cash">نقدى</label>
                  <input type="radio" name="payment" class="styled type" value="cash" id="cash" >
                    </span>

                 <span class="new-radio-wrap">
                        <label for="network">شبكة</label>
                <input type="radio" name="payment" class="styled type" value="network" id="network" >
                </span>
        </div>

<div class="form-group col-md-12 pull-left">
    <label> ملاحظات </label>
    {!! Form::textarea("notes",null,['class'=>'form-control','placeholder'=>' ملاحظات'])!!}
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i>
        </button>
    </div>
</div>
@section('scripts')
    <script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
    <script>
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
        });

        $("#amount").on('change', function() {
            var amount= $(this).val();
           var balance=  $('#balance').val();
            $('#new_balance').val(balance-amount);
        });
    </script>
@endsection
