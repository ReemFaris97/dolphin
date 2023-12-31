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
    <label>اسم التصنيف باللغة العربية  </label>
    {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>' اسم التصنيف باللغة العربية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم التصنيف باللغة الانجليزية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم التصنيف باللغة الانجليزية    '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>وصف التصنيف باللغة العربية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("ar_description",null,['class'=>'form-control','placeholder'=>' وصف التصنيف باللغة العربية    '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>وصف التصنيف باللغة الانجليزية  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("en_description",null,['class'=>'form-control','placeholder'=>' وصف التصنيف باللغة الانجليزية    '])!!}
</div>

@if( isset($category))

    <div class="form-group col-md-6 pull-left">
        <label>صوره القسم الحالية : </label>
        <img src="{{getimg($category->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>

@endif


<div class=" media-body">
    <label>صوره القسم  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'file-styled'])!!}

</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
