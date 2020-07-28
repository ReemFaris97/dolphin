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
    <label>اسم المورد  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم المورد  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>جوال   </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'جوال '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>البريد الالكترونى   </label>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  البريد الالكترونى  '])!!}
</div>
{{--@if (getsetting('automatic_supplier')==0)--}}
{{--    <div class="form-group col-md-6 pull-left">--}}
{{--        <label> اختر الحساب  التابع له حساب المورد</label>--}}
{{--        {!! Form::select("account_id",accounts(),null,['class'=>'form-control','placeholder'=>' اختر الحساب'])!!}--}}
{{--    </div>--}}

{{--@endif--}}

<div class="form-group col-md-6 pull-left">
    <label>كلمه المرور</label>
    {!! Form::password('password',['class'=>'form-control  m-input','placeholder'=>'ادخل كلمه المرور'])!!}
</div>

<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
    <label> اسم الشركة </label>
    {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له المنتج '])!!}
</div>
<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
    <label> اسم الفرع التابع </label>
    {!! Form::select("branch_id",branches(),null,['class'=>'form-control  branch_id','id'=>'branch_id','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
</div>

@if( isset($supplier))

    <div class="form-group col-md-6 pull-left">
        <label>صوره المورد الحالية : </label>
        <img src="{{getimg($supplier->image)}}" style="width:100px; height:100px">
    </div>
@endif


<div class="form-group col-md-12 pull-left">
    <label>صوره المورد  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'form-control'])!!}
</div>
<div class="clearfix"></div>

<div class="form-group col-md-6 pull-left ">

    <div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper  credit">
        <label>السياسة الائتمانية </label>
        <span class="new-radio-wrap">
         <label for="amount">حد دين </label>
        {!! Form::radio("credit","1",['class'=>'form-control','id'=>'amount','value'=>"1" ])!!}
        </span>

        <span class="new-radio-wrap">
        <label for="period">فترة دين </label>
        {!! Form::radio("credit","0",['class'=>'form-control', 'id'=>'period','value'=>"0"])!!}
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

<div class="clearfix"></div>

<div class="form-group col-md-4 pull-left">
<label>  اختر اسم البنك   </label>
{!! Form::select("bank_id",$banks,null,['class'=>'form-control selectpicker ', 'placeholder'=>' اختر اسم البنك  '])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label>  رقم  الحساب </label>
    {!! Form::text("bank_account_number",null,['class'=>'form-control','placeholder'=>' رقم  الحساب '])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label>  الرقم  الضريبى </label>
    {!! Form::text("tax_number",null,['class'=>'form-control','placeholder'=>' الرقم  الضريبى '])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label> اختر  شركات  التورديد   </label>
    {!! Form::select("company_id[]",$companies,null,['class'=>'form-control selectpicker ' ,'multiple'])!!}
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
        $(".amount").hide();
        $(".period").hide();

    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="{{asset('admin/assets/js/get_branch_by_company_without_all.js')}}"></script>

    <script>

        $(function(){
            $('input[type="radio"]').click(function(){

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
