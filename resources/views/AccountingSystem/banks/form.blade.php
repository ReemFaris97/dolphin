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

{{--<div class="form-group col-md-6 pull-left">--}}
{{--    <label>اسم الحساب </label>--}}

{{--    {!! Form::text("account_name",null,['class'=>'form-control','placeholder'=>' اسم الحساب  '])!!}--}}
{{--</div>--}}
{{--<div class="form-group col-md-6 pull-left">--}}
{{--    <label>    كودالحساب  </label>--}}
{{--    {!! Form::text("account_num",null,['class'=>'form-control','placeholder'=>'   كود  الحساب  '])!!}--}}
{{--</div>--}}
<div class="form-group col-md-6 pull-left">
    <label>  العملة </label>
    {!! Form::select("currency_id",$currencies,null,['class'=>'form-control js-example-basic-single currency_id','id'=>'currency_id','placeholder'=>' اختر العملة '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>  الصلاحيات </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single branch_id','id'=>'branch_id','multiple'])!!}

</div>

<div class="form-group col-xs-6 pull-left  ">
    <label > </label>

    <div class="form-line new-radio-big-wrapper">
                <span class="new-radio-wrap">
                    <label for="active">مفعل </label>
                        {!! Form::radio("active",1,['class'=>'form-control','id'=>'active'])!!}
                </span>
             <span class="new-radio-wrap">
                    <label for="dis_active"> غير مفعل </label>
                     {!! Form::radio("active",0,['class'=>'form-control','id'=>'dis_active'])!!}
                </span>
    </div>
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
