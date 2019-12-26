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


<div class="form-group col-md-6 pull-left">
    <label>العمولة   </label>
    {!! Form::text("commission",null,['class'=>'form-control','placeholder'=>'العمولة '])!!}
</div>


<div class="form-group col-md-4 pull-left">
    <label>  اختر اسم الصنف  </label>
    {!! Form::select("product_id[]",$products,null,['class'=>'form-control selectpicker ','multiple','placeholder'=>' اختر اسم الصنف  '])!!}
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script>
    $(document).ready(function () {
    $('.js-example-basic-single').select2();


    });
    </script>

@endsection