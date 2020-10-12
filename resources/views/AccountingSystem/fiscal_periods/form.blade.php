@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="form-group col-xs-6 pull-left ">
    <label> السنة المالية </label>
    {!! Form::select("year_id",$years,null,['class'=>'form-control js-example-basic-single','id'=>'year_id','placeholder'=>' اختر السنة المالية  '])!!}
    </div>



    <div class="form-group col-xs-6 pull-left type ">
        <label> نوع الفترة  </label>
        <div class="form-line new-radio-big-wrapper">
        <span class="new-radio-wrap">
            <label for="manual">محدده </label>
                {!! Form::radio("type",'manual',['class'=>'form-control','id'=>'manual'])!!}
        </span>
        <span class="new-radio-wrap">
            <label for="automatic"> الية </label>
             {!! Form::radio("type",'automatic',['class'=>'form-control','id'=>'automatic'])!!}
        </span>
        </div>
    </div>



<div class="form-group col-xs-6  pull-right period">
    <label>اسم الفتره المالية   </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم الفتره الماليه  '])!!}
</div>
<div class="clearfix">
</div>
<div class="form-group col-md-6 pull-left period">
    <label>من </label>
    {!! Form::date("from",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-6 pull-left period">
    <label>إلى </label>
    {!! Form::date("to",null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-sm-6 col-xs-12 pull-left duration">
    <label>   مدة الفتره   </label>
    {!! Form::select("duration",['monthly'=>'شهريا','quarterly'=>' ربع سنويا','half'=>'نص سنويا','yearly'=>'سنويا'],Null,['class'=>'form-control','placeholder'=>' اختر المدة'])!!}
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
    $(".period").hide();

    });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script>
$('input[type=radio][name=type]').change(function() {
    if (this.value == 'manual') {
        $(".period").show();
        $(".duration").hide();


    }
    else if (this.value == 'automatic') {

        $(".period").hide();
        $(".duration").show();

    }
});
</script>
@endsection
