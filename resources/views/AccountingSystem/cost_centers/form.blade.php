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
    <label>اسم  مركز التكلفة   </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم  مركز التكلفة  '])!!}
</div>
@if(isset($center))
 <div class="form-group col-sm-6 col-xs-12 pull-left">
 <label>الكود  </label>
   {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'  الكود   '])!!}
</div>
@endif
<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> نوع  المركز  </label>
    {!! Form::select("kind",['main'=>'مركز رئيسى','sub'=>'مركز فرعى','following_main'=>' مركز رئيسى تابع'],Null,['class'=>'form-control','id'=>'kind'])!!}
</div>


<div class="form-group col-sm-6 col-xs-12 pull-left centers">
    <label>  اختر المركز الرئيسى </label>
    {!! Form::select("center_id",$centers,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم المركز ','disablePlaceholder' => true])!!}
</div>
@if(isset($center))
@if($center->kind=='following_main'||$center->kind=='sub')


<div class="form-group col-sm-6 col-xs-12 pull-left ">
    <label>  اختر المركز الرئيسى </label>
    {!! Form::select("center_id",$centers,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم المركز ','disablePlaceholder' => true])!!}
</div>



@endif

@endif


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>

@section('scripts')
    <script>
    $(document).ready(function () {
    $('.js-example-basic-single').select2();
    $('.centers').hide();

    });



    $('#kind').change(function() {
             var kind = $('#kind').val();
             if (kind=='main'){
                 $('.centers').hide();

             }else if(kind=='sub') {
                 $('.centers').show();
             }else if(kind=='following_main') {
                 $('.centers').show();
             }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

@endsection
