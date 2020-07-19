<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>الاسم</label>

        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>
    <div class="form-group m-form__group">
        <label>البريد الالكترونى</label>

        {!! Form::email('email',null,['class'=>'form-control m-input','placeholder'=>'ادخل البريد الالكترونى'])!!}
    </div>
    <div class="form-group m-form__group">
        <label>الهاتف</label>

        {!! Form::text('phone',null,['class'=>'form-control m-input','placeholder'=>'ادخل الهاتف'])!!}
    </div>


    <div class="form-group m-form__group">
        <label> اسم المورد</label>
        {!! Form::select('parent_user_id',$suppliers,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المورد'])!!}
    </div>

    <div class="form-group m-form__group">
        <label> الصوره </label>
        @if(isset($user))

            <img src="{!! url($user->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>
    <div class="form-group m-form__group">
        <label>كلمه المرور</label>
        {!! Form::password('password',['class'=>'form-control  m-input','placeholder'=>'ادخل كلمه المرور'])!!}
    </div>
    <div class="form-group m-form__group">
        <label> تأكيد كلمه المرور </label>

        {!! Form::password('password_confirmation',['class'=>'form-control   m-input','placeholder'=>'ادخل تأكيد كلمه المرور'])!!}
    </div>
</div>


@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
