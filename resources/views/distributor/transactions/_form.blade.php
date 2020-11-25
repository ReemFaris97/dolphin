<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="form-group m-form__group">
        <label>المرسل</label>
        {{Form::select('sender_id',$users,null,['class'=>'form-control  m-input select2','placeholder'=>'اختر اسم المرسل'])}}
       

    </div>

    <div class="form-group m-form__group">
        <label>المرسل إليه</label>
        {{Form::select('receiver_id',$users,null,['class'=>'form-control  m-input select2','placeholder'=>'اختر اسم المرسل الية'])}}

    </div>


    <div class="form-group m-form__group">
        <label>المبلغ المحول</label>
        {!! Form::number('amount',null,['class'=>'form-control m-input','placeholder'=>'ادخل المبلغ'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>التوقيع</label>
        {!! Form::number('signature',null,['class'=>'form-control m-input','placeholder'=>'ادخل التوقيع'])!!}
    </div>





</div>

