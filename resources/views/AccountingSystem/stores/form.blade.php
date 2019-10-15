@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="form-group">
    <label class="display-block text-semibold">المخزن تابع الى</label>
    <label class="radio-inline">
        <input type="radio" name="radio-inline-left" class="styled" id="company" checked="checked" onclick="myFunction()">
       شركة
    </label>

    <label class="radio-inline">
        <input type="radio" name="radio-inline-left" id="branch" class="styled" onclick="myFunction2()">
     فرع
    </label>
</div>

<div class="form-group col-md-6 pull-left companies">
    <label> اسم الشركة التابع لها المخزن: </label>
    {!! Form::select("company_id",$companies,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الشركة التابع لها المخزن '])!!}
</div>
<div class="form-group col-md-6 pull-left branches">
    <label> اسم الفرع التابع لها المخزن: </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها المخزن '])!!}
</div>

@if( isset($store))
@if($store->model_type=='App\Models\AccountingSystem\AccountingBranch')

    <div class="form-group col-md-6 pull-left branches">
        <label> اسم الفرع التابع لها المخزن: </label>
        {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع لها المخزن '])!!}
    </div>
@endif

@endif

<div class="form-group col-md-6 pull-left">
    <label>اسم المخزن باللغة العربية:  </label>
    {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>'  اسم المخزن باللغة العربية '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم المخزن باللغة الانجليزية:  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم المخزن باللغة الانجليزية  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>عنوان المخزن:  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("address",null,['class'=>'form-control','placeholder'=>' عنوان المخزن   '])!!}
</div>


@if( isset($store))

    <div class="form-group col-md-6 pull-left">
        <label>صوره المخزن الحالية : </label>
        <img src="{{getimg($store->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>


@endif


<div class="form-group col-md-6 pull-left ">
    <label>صوره المخزن  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'file-styled'])!!}
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

    </script>

    {{--<script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/styling/uniform.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/styling/switchery.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('admin/assets/js/plugins/forms/styling/switch.min.js')}}"></script>--}}
    {{--<script type="text/javascript" src="{{asset('admin/assets/js/pages/form_checkboxes_radios.js')}}"></script>--}}

@endsection