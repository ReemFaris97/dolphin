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
    </div>
@endif



<div class="form-group col-md-6 pull-left clients">
    <label>   اختر  العميل</label>
    {!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>' اختر  العميل'])!!}
</div>

<div class="form-group col-md-6 pull-left suppliers">
    <label>   اختر المورد </label>
    {!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control','placeholder'=>'  اختر المورد '])!!}
</div>

<div class="clearfix"></div>


<div class="form-group col-md-6 pull-left">
    <label>   اسم  البند </label>
    {!! Form::select("benod_id",$benods,null,['class'=>'form-control','placeholder'=>' اختر  اسم البند '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> العمله الافتراضية  </label>
    {!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>' العمله الافتراضية'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>المبلغ </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>  خزينة الدفع</label>
    {!! Form::select("safe_id",$safes,null,['class'=>'form-control','placeholder'=>' خزينة الدفع '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>نوع السند </label>
    {!! Form::select("type",['revenue'=>'ايراد','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع البند  '])!!}
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
        $(".suppliers").hide();
        $('.js-example-basic-single').select2();

    });

</script>

<script>
    function myFunction() {
        $(".clients").show();
        $(".suppliers").hide();
    }
    function myFunction2() {
        $(".clients").hide();
        $(".suppliers").show();
    }
    </script>
@endsection
