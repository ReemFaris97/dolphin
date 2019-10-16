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
    <label> اسم الفرع التابع له الوجه </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع له الوجه '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم الوجه  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الوجه  '])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
