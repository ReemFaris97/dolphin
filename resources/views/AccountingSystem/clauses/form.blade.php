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

        <div class="form-group">
            {{-- <label class="display-block text-semibold"> الجهة</label> --}}
            <label class="radio-inline">
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()"  checked="checked" disabled >
                عميل
            </label>

            <label class="radio-inline">
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()" disabled >
                مورد
            </label>
        </div>
    @else
        <div class="form-group">
            {{-- <label class="display-block text-semibold">  الجهة </label> --}}
            <label class="radio-inline">
                <input type="radio" name="concerned" class="styled type"  value="client" onclick="myFunction()" disabled>
                عميل
            </label>

            <label class="radio-inline">
                <input type="radio" name="concerned"  class="styled type" value="supplier" onclick="myFunction2()" checked="checked" disabled>
                مورد
            </label>
        </div>
    @endif
    @else
    <div class="form-group col-xs-12 pull-left">
        {{-- <label class="display-block text-semibold"> الجهة</label> --}}
        <label class="radio-inline">
            <input type="radio" name="concerned" class="styled type" id="basic" onclick="myFunction()"  value="client">
            عميل
        </label>
        <label class="radio-inline">
            <input type="radio" name="concerned"  class="styled type" id="part"  onclick="myFunction2()"   value="supplier">
             مورد
        </label>
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



{{-- <div class="form-group col-md-6 pull-left">
    <label>اسم السند باللغة العربية  </label>
    {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>' اسم السند باللغة العربية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم السند باللغة الانجليزية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم السند باللغة الانجليزية    '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>وصف السند باللغة العربية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("ar_description",null,['class'=>'form-control','placeholder'=>' وصف السند باللغة العربية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>وصف السند باللغة الانجليزية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("en_description",null,['class'=>'form-control','placeholder'=>' وصف السند باللغة الانجليزية    '])!!}
</div> --}}
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
