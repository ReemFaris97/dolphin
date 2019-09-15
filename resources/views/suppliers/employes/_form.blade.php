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
        <label> اسم البنك</label>
        {!! Form::select('bank_id',$banks,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم البنك'])!!}
    </div>

    <div class="form-group m-form__group">
        <label>رقم الحساب</label>

        {!! Form::text('bank_account_number',null,['class'=>'form-control m-input','placeholder'=>'ادخل رقم الحساب'])!!}
    </div>
    @if(isset($user))
        <div class="form-group m-form__group">
            <label>كلمه المرور القديمه</label>
            {!! Form::password('old_password',['class'=>'form-control  m-input','placeholder'=>'ادخل كلمه المرور القديمه فى حاله تغير كلمه المرور'])!!}
        </div>
    @endif
    <div class="form-group m-form__group">
        <label>كلمه المرور</label>
        {!! Form::password('password',['class'=>'form-control  m-input','placeholder'=>'ادخل كلمه المرور'])!!}
    </div>
    <div class="form-group m-form__group">
        <label> تأكيد كلمه المرور </label>

        {!! Form::password('password_confirmation',['class'=>'form-control   m-input','placeholder'=>'ادخل تأكيد كلمه المرور'])!!}
    </div>


    <div class="form-group m-form__group">
        <label> الصوره </label>
        @if(isset($user))

            <img src="{!! url($user->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>

{{--    @can('edit_workers')--}}
{{--        <div class="form-group m-form__group">--}}
{{--            <label> الجنسيه</label>--}}

{{--            {!! Form::select('nationality',getNationalities(),null,['class'=>'form-control   m-input select2','placeholder'=>'ادخل الجنسية'])!!}--}}
{{--        </div>--}}
{{--        <div class="form-group m-form__group">--}}
{{--            <label> الوظيفه</label>--}}

{{--            {!! Form::text('job',null,['class'=>'form-control   m-input','placeholder'=>'ادخل الوظيفة'])!!}--}}
{{--        </div>--}}
{{--        <div class="form-group m-form__group">--}}
{{--            <label> إسم الشركة</label>--}}

{{--            {!! Form::text('company_name',null,['class'=>'form-control   m-input','placeholder'=>'ادخل اسم الشركه'])!!}--}}
{{--        </div>--}}
{{--        <div class="form-group m-form__group">--}}
{{--            <label> نوع العضويه</label>--}}

{{--            {!! Form::select('is_admin',['عضو','مدير'],null,['class'=>'form-control   m-input select2','placeholder'=>'اختر نوع العضويه'])!!}--}}
{{--        </div>--}}
{{--    @endcan--}}
</div>

<!--<<<<<<< HEAD-->
<!--<div class="form-group m-form__group clearfix ">-->
    <!-- select all boxes -->
<!--    <div class="m-form__group form-group ">-->
<!--=======-->
{{--@can('edit_workers')--}}

{{--    <div class="form-group m-form__group clearfix ">--}}
{{--        <!-- select all boxes -->--}}
{{--        <div class="m-form__group form-group ">--}}

{{--            <div class="m-checkbox-inline" style="flex:100%;width:100%">--}}
{{--                <label class="m-checkbox">--}}
{{--                    <input id="check-all" type="checkbox">--}}
{{--                    تحديد الكل--}}
{{--                    <span></span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        --}}{{--@foreach($permissions as  $permission)--}}

{{--        --}}{{--<div class="col-lg-4">--}}

{{--        --}}{{--<input name="permissions[]" value="{{ $permission->id }}" {{ (collect(old('permissions'))->contains($permission->name)) ? 'checked':'' }} required id="checkbox{{ $permission->id }}"--}}
{{--        --}}{{--type="checkbox" class="form-control"--}}
{{--        --}}{{-->--}}
{{--        --}}{{--<label for="checkbox{{ $permission->id }}">--}}
{{--        --}}{{--{{ $permission->ar_name }}--}}
{{--        --}}{{--</label>--}}


{{--        --}}{{--</div>--}}

{{--        --}}{{--@endforeach--}}
{{--        @if(isset($user))--}}

{{--            @if($user->permissions->count()  > 0)--}}
{{--                <div class="m-form__group form-group ">--}}
{{--                    @foreach($permissions as  $permission)--}}
{{--                        <div class="m-checkbox-inline fixed-width-checks">--}}
{{--                            <label class="m-checkbox">--}}
{{--                                <input class="md-check" id="check-all" name="permissions[]"--}}
{{--                                       value="{{$permission->name}}" type="checkbox"--}}
{{--                                       @if($user->hasPermissionTo($permission->name)) checked @endif >{{$permission->ar_name}}--}}
{{--                                <span></span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}

{{--            @else--}}
{{--                <div class="m-form__group form-group --}}{{----}}{{--pos-rel--}}{{----}}{{--">--}}
{{--                    @foreach($permissions as  $permission)--}}
{{--                        <div class="m-checkbox-inline">--}}
{{--                            <label class="m-checkbox">--}}
{{--                                <input class="md-check" name="permissions[]" value="{{$permission->name}}"--}}
{{--                                       type="checkbox">{{$permission->ar_name}}--}}
{{--                                <span></span>--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            @endif--}}


{{--        @else--}}
{{--            <div class="m-form__group form-group ">--}}
{{--                @foreach($permissions as  $permission)--}}
{{--                    <div class="m-checkbox-inline">--}}
{{--                        <label class="m-checkbox">--}}
{{--                            <input class="md-check" name="permissions[]" value="{{$permission->name}}"--}}
{{--                                   type="checkbox">{{$permission->ar_name}}--}}
{{--                            <span></span>--}}
{{--                        </label>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}

{{--@endcan--}}
@push('scripts')
    <script>
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>

@endpush
