@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-sm-12 col-xs-12 ">
    <div class="form-group form-float">
        <label class="form-label">الدور</label>
        <div class="form-line">
            {{--{!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  الاسم  '])!!}--}}
            <input type="text" class="form-control" name="name" placeholder="">
        </div>
    </div>
</div>
<div class="col-sm-12 col-xs-12">
    <div class="form-group form-float">
        <strong>الصلاحيات:</strong>
        <br/>
        <div class="row flex2">
        @foreach($permission as $value)
            <div class="checkbox checkbox-left checkbox-switchery col-md-3 col-sm-6 col-xs-12">
                <input type="checkbox" name="permission[]" value="{{$value->id}}" class="switchery" id="{{$value->id}}" >
                <label style="margin-left: 20px;"  for={{$value->id}}>
                    {{ $value->name }}
                </label>
            </div>
        @endforeach
        </div>
    </div>
</div>








<div class="col-xs-12">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

