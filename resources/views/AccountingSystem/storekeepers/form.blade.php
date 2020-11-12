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
    <label>اسم الامين:  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الامين  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>جوال الامين : </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'  جوال الامين  ','required'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> إيميل الامين: </label>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  إيميل الامين'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>باسورد </label>
    <input type="password" class="form-control" name="password" placeholder="اكتب هنا الباسورد" >
</div>


{{--<div class="form-group col-md-6 pull-left branches">--}}
    {{--<label> اسم   المخزن التابع له: </label>--}}
    {{--{!! Form::select("store_id",$stores,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر  اسم   المخزن التابع له '])!!}--}}
{{--</div>--}}

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