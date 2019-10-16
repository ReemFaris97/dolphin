@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--<div class="form-group col-md-6 pull-left">--}}
    {{--<label> اسم الفرع التابع له الوجه </label>--}}
    {{--{!! Form::select("branch_id",$branches,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الفرع التابع له الوجه '])!!}--}}
{{--</div>--}}

<div class="form-group col-md-6 pull-left">
    <label>اسم المنتج  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم المنتج  '])!!}
</div>

{{--<div class="form-group col-md-6 pull-left">--}}
{{--<label>النوع  </label>--}}
{{--{!! Form::select("name",null,['class'=>'form-control','placeholder'=>'  اسم المنتج  '])!!}--}}
{{--</div>--}}
<div class="form-group col-md-6 pull-left">
    <label>وصف المنتج  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::textarea("name",null,['class'=>'form-control','placeholder'=>'  وصف المنتج  '])!!}
</div>

<div class="clearfix">
</div>

<div class="form-group col-md-6 pull-left">
    <label>مفعل  </label>
    {!! Form::radio("is_active",1,['class'=>'form-control'])!!}

    <label>غير مفعل  </label>
    {!! Form::radio("is_active",0,['class'=>'form-control'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>الوحدة الاساسية </label><span style="color: #ff0000; margin-right: 15px;">[جرام -كيلو-لتر]</span>
    {!! Form::text("main_unit",null,['class'=>'form-control','placeholder'=>'  الوحدة الاساسية '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>الباركود  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' الباركود '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label>سعر البيع  </label>
    {!! Form::text("selling_price",null,['class'=>'form-control','placeholder'=>'  سعر البيع   '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>سعر الشراء  </label>
    {!! Form::text("purchasing_price",null,['class'=>'form-control','placeholder'=>'سعر الشراء  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>الحد الادنى من الكمية </label>
    {!! Form::text("min_quantity",null,['class'=>'form-control','placeholder'=>'الحد الادنى  من الكمية'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الحد الاقصى من الكمية  </label>
    {!! Form::text("max_quantity",null,['class'=>'form-control','placeholder'=>' الحد الاقصى من الكمية '])!!}
</div>




<div class="form-group col-md-6 pull-left">
    <label> الحجم   </label><span style="color: #ff0000; margin-right: 15px;">  اختيارى ويكون بالسنتمتر المكعب</span>
    {!! Form::text("size",null,['class'=>'form-control','placeholder'=>' الحجم  '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label> اللون   </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("color",null,['class'=>'form-control','placeholder'=>'  اللون '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> الارتفاع   </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر</span>
    {!! Form::text("height",null,['class'=>'form-control','placeholder'=>'الارتفاع  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> العرض   </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر المربع</span>
    {!! Form::text("width",null,['class'=>'form-control','placeholder'=>'  العرض '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> تاريخ الانتهاء   </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::date("expired_at",null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>عدد أيام فترة الركود</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::number("num_days_recession",null,['class'=>'form-control'])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
