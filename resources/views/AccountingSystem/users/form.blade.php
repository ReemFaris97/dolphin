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
    <label>اسم العضو  </label>
    {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم العضو  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>جوال العضو  </label>
    {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'  جوال العضو  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label> إيميل العضو </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'  إيميل العضو'])!!}
</div>

<div class="form-group col-md-6 pull-left">
<label> الصلاحية  </label>
{!! Form::select("role",['is_admin'=>'ادمن','is_sale'=>'كاشير','is_accountant'=>'محاسب'],Null,['class'=>'form-control','placeholder'=>' اختر الصلاحيه  '])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> صلاحية حذف المنتج </label>
    {!! Form::select("delete_product",['0'=>'لا','1'=>'نعم'],Null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-6 pull-left">
<label> اسم المخزن: </label>
{!! Form::select("accounting_store_id",AllStore(),null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم المخزن '])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>كلمه المرور</label>
    {!! Form::password('password',['class'=>'form-control  m-input','placeholder'=>'ادخل كلمه المرور'])!!}
</div>

@if( isset($user))

    <div class="form-group col-md-6 pull-left">
        <label>صوره العضو الحالية : </label>
        <img src="{{getimg($user->image)}}" style="width:100px; height:100px">
    </div>


@endif


<div class="form-group col-md-6 pull-left">
    <label>صوره العضو  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'form-control'])!!}
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
