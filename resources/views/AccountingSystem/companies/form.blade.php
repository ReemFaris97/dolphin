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
    <label>اسم الشركة:  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الشركة  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>جوال الشركة:  </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'  جوال الشركة  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> إيميل الشركة: </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  إيميل الشركة'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>باسورد </label>
    <input type="password" class="form-control" name="password" placeholder="اكتب هنا الباسورد" >
</div>

@if( isset($company))

    <div class="form-group col-md-6 pull-left">
        <label>صوره الشركة الحالية : </label>
        <img src="{{getimg($company->image)}}" style="width:100px; height:100px">
    </div>


@endif


<div class="form-group col-md-6 pull-left">
    <label>صوره الشركة:  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'form-control'])!!}
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
