<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label>بند الصرف</label>
        {!! Form::select('expenditure_clause_id',$expenditure_clauses,null,['class'=>'form-control  select2','placeholder'=>'ادخل بند الصرف'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>نوع الصرف</label>
        {!! Form::select('expenditure_type_id',$expenditure_types,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل نوع الصرف'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>اسم المستخدم</label>
        {!! Form::select('user_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المستخدم'])!!}
    </div>



    <div class="form-group m-form__group">
        <label>تاريخ الصرف</label>
        {!! Form::date('date',null,['class'=>'form-control m-input'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>وقت الصرف</label>
        {!! Form::time('time',null,['class'=>'form-control m-input'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>المبلغ المصروف</label>
        {!! Form::text('amount',null,['class'=>'form-control m-input','placeholder'=>'ادخل  المبلغ المصروف'])!!}

    </div>
    <div class="form-group m-form__group">
        <label> ملاحظات نصية</label>
        {!! Form::text('notes',null,['class'=>'form-control m-input','placeholder'=>'ادخل  الملاحظات النصية'])!!}

    </div>

    <div class="form-group m-form__group">
        <label> صوره الفاتورة  </label>
        @if(isset($expense))

            <img src="{!! url($expense->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>


    <div class="form-group m-form__group">
        <label>اسم  العداد</label>
        {!! Form::text('reader_name',null,['class'=>'form-control m-input','placeholder'=>'ادخل  اسم العداد'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>  اصل  قراءه العداد</label>
        {!! Form::text('reader_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل اصل  قراءه العداد'])!!}
    </div>


    <div class="form-group m-form__group">
        <label> صوره العداد </label>
        @if(isset($expense))

            <img src="{!! url($expense->reader_image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="reader_image">
    </div>
</div>

@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
