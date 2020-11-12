@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



@if( isset($device))
    @if($device->model_type=='App\Models\AccountingSystem\AccountingBranch')
        <div class="form-group r-group">
            <label class="display-block text-semibold">الخزنة تابع الى</label>
            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" class="styled" id="company"  onclick="myFunction()" disabled>
                شركة
            </label>

            <label class="radio-inline">
                <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()" checked="checked"disabled >
                فرع
            </label>
        </div>
        @elseif($device->model_type=='App\Models\AccountingSystem\AccountingCompany')
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





@if(isset($device))
@if($device->model_type=='App\Models\AccountingSystem\AccountingBranch')
    <div class="form-group col-xs-6 pull-left branches">
        <label> اسم الفرع التابع لها المستودع: </label>
        <div class="btn-group adding-new-comp">
            <a href="{{route('accounting.branches.create')}}" class="btn btn-success" target="_blank">
            <span class="m-l-5">
				إضافة فرع
				<i class="fa fa-plus"></i>
			</span>
            </a>
        </div>
        {!! Form::select("branch_id",$branches,$device->model_id,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها المستودع '])!!}
    </div>
@elseif($device->model_type=='App\Models\AccountingSystem\AccountingCompany')
    <div class="form-group col-xs-6 pull-left companies">
        <label> اسم الشركة التابع لها المستودع: </label>
        <div class="btn-group adding-new-comp">
            <a href="{{route('accounting.companies.create')}}" class="btn btn-success" target="_blank">
            <span class="m-l-5">
				إضافة شركة
				<i class="fa fa-plus"></i>
			</span>
            </a>
        </div>
        {!! Form::select("company_id",$companies,$device->model_id,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الشركة التابع لها المستودع '])!!}
    </div>
@endif
    @else
    <div class="form-group col-xs-6 pull-left companies">
        <label> اسم الشركة التابع لها المستودع: </label>
        <div class="btn-group adding-new-comp">
            <a href="{{route('accounting.companies.create')}}" class="btn btn-success" target="_blank">
            <span class="m-l-5">
				إضافة شركة
				<i class="fa fa-plus"></i>
			</span>
            </a>
        </div>
        {!! Form::select("company_id",$companies,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع لها المستودع '])!!}
    </div>
    <div class="form-group col-xs-6 pull-left branches">
    <label> اسم الفرع التابع لها المستودع: </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','id'=>'branch_id','placeholder'=>' اختر اسم الفرع التابع لها المستودع '])!!}
    </div>

@endif



<div class="form-group col-md-6 pull-left">
    <label>اسم  الجهاز  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الجهاز  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>كود   الجهاز  </label>
    {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  كود الجهاز  '])!!}
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


        @if( isset($device))

        if ($('#company').is(':checked')) {
            $(".companies").show();
        }elseif ($('#branch').is(':checked')); {
            $(".branches").show();
        }

        @endif

</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
@endsection
