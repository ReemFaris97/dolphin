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
    <label> اختر الفرع  </label>
    {!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر الفروع '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>كود الخزنة </label>
    {!! Form::text("code",null,['class'=>'form-control','placeholder'=>' كود الخزنة   '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> عهده الخزنه  </label>
    {!! Form::text("financial_custody",null,['class'=>'form-control','placeholder'=>'  عهده الخزنه   '])!!}
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

@endsection