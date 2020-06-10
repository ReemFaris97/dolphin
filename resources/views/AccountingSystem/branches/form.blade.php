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
    <label> اسم الشركة التابع لها الفرع: </label>
    <div class="btn-group">
        <a href="{{route('accounting.companies.create')}}" class="btn btn-success">
            <span class="m-l-5"><i class="fa fa-plus"></i></span>
        </a>
    </div>
    {!! Form::select("company_id",$companies,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الشركة التابع لها الفرع '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>اسم الفرع:  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الفرع  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>جوال الفرع : </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'  جوال الفرع  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> إيميل الفرع: </label><span style="color: #ff0000; margin-right: 15px;"></span>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  إيميل الفرع'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>باسورد :</label>
    <input type="password" class="form-control" name="password" placeholder="اكتب هنا الباسورد" >
</div>

<div class="form-group col-md-6 pull-left">
    <label>كود الفرع:  </label>
    {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  كود الفرع  '])!!}
</div>
@if( isset($branch))

    <div class="form-group col-md-6 pull-left">
        <label>صوره الفرع الحالية : </label>
        <img src="{{getimg($branch->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>

/
@endif


<div class=" media-body">
    <label>صوره الفرع  </label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">اختيارى</span>
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
            $('.js-example-basic-single').select2();
        });

    </script>
@endsection