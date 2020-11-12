@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group col-md-4 pull-left">
    <label> اسم الشركة </label>
    <div class="btn-group adding-new-comp">
        <a href="{{route('accounting.companies.create')}}" class="btn btn-success" target="_blank">
            <span class="m-l-5">
				إضافة شركة
				<i class="fa fa-plus"></i>
			</span>
        </a>
    </div>
    {!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','required'])!!}
</div>
<div class="form-group col-md-4 pull-left">
    <label>اسم التصنيف باللغة العربية  </label>
    {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>' اسم التصنيف باللغة العربية','required'])!!}
</div>
<div class="form-group col-md-4 pull-left">
    <label>اسم التصنيف باللغة الانجليزية  </label>
    <span class="asided-hint">اختيارى</span>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم التصنيف باللغة الانجليزية'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>وصف التصنيف باللغة العربية  </label>
    <span class="asided-hint">اختيارى</span>
    {!! Form::textarea("ar_description",null,['class'=>'form-control','placeholder'=>' وصف التصنيف باللغة العربية'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>وصف التصنيف باللغة الانجليزية  </label>
    <span class="asided-hint">اختيارى</span>
    {!! Form::textarea("en_description",null,['class'=>'form-control','placeholder'=>' وصف التصنيف باللغة الانجليزية'])!!}
</div>
@if( isset($category))
    <div class="form-group col-md-6 pull-left">
        <label>صوره التصنيف الحالية : </label>
        <img src="{{getimg($category->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>
@endif
<div class="media-body">
    <label>صوره التصنيف  </label>
    <span class="asided-hint">اختيارى</span>
    {!! Form::file("image",null,['class'=>'file-styled'])!!}
</div>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();
            $("#components_button").hide();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
@endsection