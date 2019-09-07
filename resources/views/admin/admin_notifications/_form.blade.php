<div class="m-portlet__body">

    <div class="form-group m-form__group">
        <label>إسم الاعضاء</label>

        {{--        {!! Form::select('users[]',$users,null,['class'=>'form-control m-input select2','placeholder'=>'اتركه فارغا فى حاله الارسال لكل الاعضاء','multiple'])!!}--}}
        <select name="users[]" class="form-control m-input select2" multiple>
            <option value="" selected>الكل</option>

            @forelse($users as $key=> $value)
                <option value="{{$key}}">{{$value}}</option>
            @empty
                <option selected disabled>لا يوجد مستخدمين حالياً</option>
            @endforelse

        </select>

    </div>

    <div class="form-group m-form__group">
        <label>إسم العنوان</label>

        {!! Form::text('title',null,['class'=>'form-control m-input','placeholder'=>'ادخل العنوان'])!!}
    </div>
    <div class="form-group m-form__group">
        <label>إسم الموضوع</label>

        {!! Form::text('body',null,['class'=>'form-control m-input','placeholder'=>'ادخل الموضوع'])!!}
    </div>

</div>
