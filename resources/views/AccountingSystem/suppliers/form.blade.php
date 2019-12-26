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


<div class="form-group col-md-4 pull-left">
    <label>  اختر الفرع  </label>
    {!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker ','placeholder'=>' اختر اسم الفرع  '])!!}
</div>

<div class="form-group col-md-4 pull-left">
    <label>  اختر اسم الصنف  </label>
    {!! Form::select("product_id[]",$products,null,['class'=>'form-control selectpicker ','multiple','placeholder'=>' اختر اسم الصنف  '])!!}
</div>


<div class="form-group col-md-6 pull-left ">

    <div class="form-group col-md-6 pull-left credit ">
        <label>السياسة الائتمانية </label>

        <label>حد دين </label>
        {!! Form::radio("credit","1",['class'=>'form-control','id'=>'amount','value'=>"1" ])!!}

        <label>فترة دين </label>
        {!! Form::radio("credit","0",['class'=>'form-control', 'id'=>'period','value'=>"0"])!!}
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