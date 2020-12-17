<div class="m-portlet__body a-smaller-input-wrapper">
    <div class="form-group m-form__group">
        <label> اسم المسار</label>
        {!! Form::text('name',null,['class'=>'form-control m-input','placeholder'=>'ادخل اسم المسار'])!!}
    </div>


    <div class="form-group m-form__group">
        <label>اسم المندوب</label>
        {!! Form::select('user_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم المندوب'])!!}
    </div>

    {{--<div class="form-group m-form__group">--}}
        {{--<label> الانتهاء</label>--}}
        {{--{!! Form::select('is_finished',['1'=>'منتهى ','0'=>'غير منتهى'],null,['class'=>'form-control select2'])!!}--}}
    {{--</div>--}}


{{--    <div class="form-group m-form__group">--}}
{{--        <label> التفعيل</label>--}}
{{--        {!! Form::select('is_active',['1'=>'مفعل ','0'=>'غير مفعل'],null,['class'=>'form-control select2'])!!}--}}
{{--    </div>--}}
</div>

@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
