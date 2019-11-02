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
    <label>التاريخ</label>
    {!! Form::date("date",null,['class'=>'form-control'])!!}
</div>
<div class="form-group col-md-6 pull-left">
    <label>اسم البند  </label>
    {!! Form::select("clause_id",$clauses,null,['class'=>'form-control','placeholder'=>' اختر اسم البند     '])!!}
</div>



<div class="form-group col-md-6 pull-left">
    <label>رقم السند </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::text("sanad_num",null,['class'=>'form-control','placeholder'=>' رقم السند  '])!!}
</div>

<div class="form-group col-md-6 pull-left">
    <label>البيان  </label>
    {!! Form::textarea("desc",null,['class'=>'form-control','placeholder'=>' وصف البند باللغة الانجليزية    '])!!}
</div>




<div class="form-group col-md-6 pull-left">
    <label>نوع البند </label>
    {!! Form::select("type",['revenue'=>'ايراد','expenses'=>'مصروف'],null,['class'=>'form-control','placeholder'=>' نوع البند  '])!!}
</div>


@if( isset($band))

    <div class="form-group col-md-6 pull-left">
        <label>صوره المرفقة : </label>
        <img src="{{getimg($band->image)}}" style="width:100px; height:100px" class="file-styled">
    </div>


@endif


<div class="form-group col-md-6 pull-left ">
    <label>ارفاق صوره </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
    {!! Form::file("image",null,['class'=>'file-styled'])!!}
</div>


<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
