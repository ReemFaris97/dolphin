<div class="m-portlet__body">

    <div class="form-group m-form__group">
        <label>الاسم</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل الاسم'])!!}
    </div>
    <div class="form-group m-form__group">
        <label>الكمية</label>
        {!! Form::number('amount',null,['class'=>'form-control m-input','placeholder'=>'الكمية'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الكمية الإفتراضية</label>
        {!! Form::number('default_amount',null,['class'=>'form-control m-input','placeholder'=>'الكمية الإفتراضية'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>الموظف</label>
        {!! Form::select('user_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم الموظف'])!!}
    </div>


</div>
