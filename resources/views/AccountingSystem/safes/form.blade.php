@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if( isset($safe))
    @if($safe->model_type=='App\Models\AccountingSystem\AccountingBranch')
        <div class="form-group r-group">
            <label class="display-block text-semibold">الخزنية تابع الى</label>
            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" class="styled" id="company"  onclick="myFunction()" disabled>
                شركة
            </label>

            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" checked="checked"disabled >
                فرع
            </label>
        </div>
        @elseif($safe->model_type=='App\Models\AccountingSystem\AccountingCompany')
        <div class="form-group r-group">
            <label class="display-block text-semibold">الخزنة تابع الى</label>
            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()" disabled>
                شركة
            </label>

            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" disabled>
                فرع
            </label>
        </div>
        @endif
    @else
    <div class="form-group r-group">
        <label class="display-block text-semibold">الخزنة تابع الى</label>
        <label class="radio-inline">
            <input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()">
            شركة
        </label>

        <label class="radio-inline">
            <input type="radio" name="radio-inline-left" id="branch1" class="styled" onclick="myFunction2()">
            فرع
        </label>
    </div>
    @endif





@if(isset($safe))
@if($safe->model_type=='App\Models\AccountingSystem\AccountingBranch')
    <div class="form-group col-xs-6 pull-left branches">
        <label> اسم الفرع التابع لها الخزنية: </label>
        {{-- @dd($safe->model_id) --}}
        {!! Form::select("branch_id",$branches,$safe->model_id,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها الخزنية '])!!}
    </div>
@elseif($safe->model_type=='App\Models\AccountingSystem\AccountingCompany')
    <div class="form-group col-xs-6 pull-left companies">
        <label> اسم الشركة التابع لها الخزنية: </label>
        {!! Form::select("company_id",$companies,$safe->model_id,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الشركة التابع لها الخزنية '])!!}
    </div>
@endif
    @else
    <div class="form-group col-xs-6 pull-left companies">
        <label> اسم الشركة التابع لها الخزنية: </label>
        {!! Form::select("company_id",$companies,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع لها الخزنية '])!!}
    </div>
    <div class="form-group col-xs-6 pull-left branches">
    <label> اسم الفرع التابع لها الخزنية: </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','id'=>'branch_id','placeholder'=>' اختر اسم الفرع التابع لها الخزنية '])!!}
    </div>

@endif
@if( isset($safe))
    @if ($safe->type==1)

        <div class="form-group">
            <label class="display-block text-semibold r-group">  نوع الخزنة</label>
            <label class="radio-inline">
                <input type="radio" name="type" class="styled type"  value="1"   checked="checked" disabled >
                رئيسى
            </label>

            <label class="radio-inline">
                <input type="radio" name="type"  class="styled type" value="0"  disabled >
                    فرعية
            </label>
        </div>
    @else
        <div class="form-group r-group">
            <label class="display-block text-semibold"> نوع الخزنة</label>
            <label class="radio-inline">
                <input type="radio" name="type" class="styled type"  value="1" disabled>
                رئيسى
            </label>

            <label class="radio-inline">
                <input type="radio" name="type"  class="styled type" value="0" checked="checked" disabled>
                فرعى
            </label>
        </div>
    @endif
    @else
    <div class="form-group col-xs-12 pull-left r-group">
        <label class="display-block text-semibold">  نوع الخزنة</label>
        <label class="radio-inline">
            <input type="radio" name="type" class="styled type" id="basic"   value="1">
            رئسى
        </label>
        <label class="radio-inline">
            <input type="radio" name="type"  class="styled type" id="part"    value="0">
            فرعى
        </label>
    </div>
@endif


<div class="devices">

</div>


<div class="form-group col-md-6 pull-left">
    <label>اسم  الخزنة </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' اسم الخزنة   '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>  عهده الخزنه </label>
    {!! Form::text("custody",null,['class'=>'form-control','placeholder'=>'  عهده الخزنه   '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>الرصيد الحالى الخزنه  </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' الرصيد الحالى الخزنه     '])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')

<script>

    $(document).ready(function() {

        $('.companies').show();
        $('.branches').hide();
        $(".rent").hide();

        $('.js-example-basic-single').select2();





    });

</script>

<script>
    function myFunction() {


        $(".companies").show();
        $(".branches").hide();

    }

    function myFunction2() {

        $(".companies").hide();
        $(".branches").show();
    }


        @if( isset($safe))

        if ($('#company').is(':checked')) {
            $(".companies").show();
        }elseif ($('#branch').is(':checked')); {{
            $(".branches").show();
        }

        @endif

</script>
 <script>

$(".type").on('change', function() {
    var idddd = $(this).val();

    if (idddd == 0) {
        if ($('#company').is(':checked')) {
            var company_id = $('#company_id').val();
            $.ajax({
                url: "/accounting/company_devices/" + company_id,
                type: "GET",
            }).done(function (data) {
                $('.devices').empty();
                $('.devices').append(data.data);
            }).fail(function (error) {
                console.log(error);
            });
        }
        if ($('#branch1').is(':checked')) {
             branch_id = $('#branch_id').val();

            $.ajax({
                url: "/accounting/branch_devices/" + branch_id,
                type: "GET",

            }).done(function (data) {

                $('.devices').empty();
                $('.devices').append(data.data);

            }).fail(function (error) {
                console.log(error);
            });
        }

    }else if (idddd == 1) {
        $('.devices').empty();


    }
});
</script>
@endsection
