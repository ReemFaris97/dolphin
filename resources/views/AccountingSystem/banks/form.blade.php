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
    <label> رمز البنك</label>
    {!! Form::text("bank_number",null,['class'=>'form-control','placeholder'=>'  رمز البنك   '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم البنك  باللغه العربيه  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'اسم البنك  باللغه العربيه '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>اسم البنك  باللفه الانجليزيه </label>
    {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>' اسم البنك  باللفه الانجليزيه '])!!}
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
