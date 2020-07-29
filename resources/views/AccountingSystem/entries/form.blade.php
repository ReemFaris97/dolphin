@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>تاريخ العملية  </label>
    {!! Form::date("date",null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>مصدر  العمليه  </label>
    {!! Form::text("source",'قيد يدوى',['class'=>'form-control','readonly'])!!}
</div>
{{--<div class="form-group col-sm-6 col-xs-12 pull-left">--}}
    {{--<label>الكود  </label>--}}
    {{--{!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  الكود   '])!!}--}}
{{--</div>--}}
<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> نوع  العمليه  </label>
    {!! Form::text("type",'يدوى',['class'=>'form-control','placeholder'=>'  يدوى   ','readonly'])!!}
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>   المبلغ  </label>
    {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>' المبلغ  ',])!!}
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> نوع  العملة  </label>
    {!! Form::select("currency",currency(),null,['class'=>'form-control','placeholder'=>'اختر العملة',])!!}
</div>
@if(!isset($entry))
<div class="form-group col-sm-6 col-xs-12 pull-left accounts">
    <label>  من حساب </label>
    {!! Form::select("from_account_id",$accounts,null,['class'=>'form-control selectpicker ','id'=>'from_account_id'])!!}
</div>
@else
    <div class="form-group col-sm-6 col-xs-12 pull-left accounts">
        <label>  من حساب </label>
        {!! Form::select("from_account_id",$accounts,$entryAccount->from_account_id,['class'=>'form-control selectpicker ','id'=>'from_account_id'])!!}
    </div>
    @endif


@if(!isset($entry))
<div class="toAccounts">
    <div class="form-group col-sm-6 col-xs-12 pull-left accounts">
        <label>  الى حساب </label>
        {!! Form::select("to_account_id",$accounts,null,['class'=>'form-control  ',])!!}
    </div>
</div>
@else
    <div class="form-group col-sm-6 col-xs-12 pull-left accounts">
        <label>  الى حساب </label>
        {!! Form::select("to_account_id",$accounts,$entryAccount->to_account_id,['class'=>'form-control selectpicker ','id'=>'to_account_id'])!!}
    </div>
@endif

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label>   التفاصيل  </label>
    {!! Form::textarea("details",null,['class'=>'form-control','placeholder'=>' التفاصيل  '])!!}
</div>
<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-single').select2();



        });

        $("#from_account_id").on('change', function() {

                var id = $(this).val();
                console.log(id);
                $('.toAccounts').empty();
                $.ajax({
                    url:"/accounting/entries/toAccounts/"+id,
                    type:"get",
                    data:{'ids':id,}

                }).done(function (data) {

                    $('.toAccounts').html(data.data);
                }).fail(function (error) {
                    console.log(error);
                });
        })
    </script>

@endsection
