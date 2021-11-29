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
    <label> اسم الشركة التابع لها خط الانتاج: </label>
    <div class="btn-group adding-new-comp">
        <a href="{{route('accounting.companies.create')}}" class="btn btn-success" target="_blank">
            <span class="m-l-5">
				إضافة شركة
				<i class="fa fa-plus"></i>
			</span>
        </a>
    </div>
    {!! Form::select("accounting_company_id",$companies,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر اسم الشركة التابع لها خط الانتاج '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم الخط:  </label>
    {!! Form::text("name",null,['class'=>'form-control','required','placeholder'=>'  اسم الخط  '])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
