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
    <label>اسم العميل  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم العميل  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>جوال   </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'جوال '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>ايميل   </label>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  الايميل  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>الفاكس  </label>
    {!! Form::text("fax",null,['class'=>'form-control','placeholder'=>' الفاكس  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>رقم ضريبى  </label>
    {!! Form::text("tax_number",null,['class'=>'form-control','placeholder'=>' رقم ضريبى  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> رقم السجل التجارى  </label>
    {!! Form::text("tax_number",null,['class'=>'form-control','placeholder'=>'  رقم السجل التجارى  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> طريقة اصدار الفاتورة  </label>
    {!! Form::select("type_bills",['via_email'=>'ارسال  عبر  الايميل','via_message'=>'ارسال  عبر  الرسائل النصية','via_whats_up'=>'ارسال  عبر  الايميل',],null,['class'=>'form-control','placeholder'=>' انواع السعر '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> انواع السعر  </label>
    {!! Form::select("type_price",['wholesale'=>'سعر التجزئة','sale'=>'سعر البيع'],null,['class'=>'form-control','placeholder'=>' انواع السعر '])!!}
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