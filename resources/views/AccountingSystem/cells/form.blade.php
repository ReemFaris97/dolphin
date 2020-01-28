@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
    <label> اسم الفرع  </label>
    {!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','multiple','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
</div>
<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
    <label> اسم الوجه </label>
    {!! Form::select("face_id",faces(),null,['class'=>'form-control selectpicker face_id','id'=>'face_id','placeholder'=>' اختر وجه للمنتج '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> اسم العمود التابع له الخلية </label>

    {!! Form::select("column_id",colums(),null,['class'=>'form-control selectpicker column_id','id'=>'column_id','placeholder'=>' اختر عمود للمنتج '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم الخلية  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الخلية  '])!!}
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


        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="{{asset('admin/assets/js/get_faces_by_branch.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_cells_by_column.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_columns_by_face.js')}}"></script>

@endsection
