<div class="m-portlet__body">

    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>

    <div class="form-group m-form__group" style="padding-top:0">
        <label>الموظف</label>
        {!! Form::select('worker_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم الموظف'])!!}
    </div>
        <div class="form-group m-form__group">
            <label> صور العهدة </label>
            @if(isset($charge->images))
                    @foreach($charge->images as $image)
                <img src="{!! url($image->image)!!}" width="250" height="250">
                    @endforeach
            @endif
            <input type="file" class="form-control m-input" name="images[]" multiple>
        </div>

        
    <div class="form-group m-form__group" style="flex: 1 0 100%;">
        <label>الوصف</label>
        {!! Form::textarea('description',null,['class'=>'form-control m-input','placeholder'=>'ادخل الوصف'])!!}
    </div>




    </div>
