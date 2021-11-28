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
    {{--'target', 'affiliate', 'address', 'notes'--}}

    <div class="form-group m-form__group">
        <label> الهدف (التارجت) </label>

        {!! Form::number('target',null,['class'=>'form-control   m-input','placeholder'=>'ادخل الهدف (التارجت) '])!!}
    </div>

    <div class="form-group m-form__group">
        <label> نسبه العموله </label>

        {!! Form::number('affiliate',null,['class'=>'form-control   m-input','placeholder'=>'ادخل العموله '])!!}
    </div>
    <div class="form-group m-form__group">
        <label> عملة تصفيف الرفوف </label>

        {!! Form::number('ordering_coin',null,['class'=>'form-control   m-input','placeholder'=>'ادخل عملة تصفيف الرفوف '])!!}
    </div>
    <div class="form-group m-form__group">
        <label> العنوان </label>

        {!! Form::text('address',null,['class'=>'form-control   m-input','placeholder'=>'ادخل العنوان '])!!}
    </div>
    <div class="form-group m-form__group">
        <label> الملاحظات </label>

        {!! Form::textarea('notes',null,['class'=>'form-control   m-input','placeholder'=>'ادخل الملاحظات '])!!}
    </div>
   <div class="form-group m-form__group clearfix ">
       <h5> طرق السداد</h3>
       <!-- select all boxes -->
       <div class="m-form__group form-group ">

        <div class="m-checkbox-inline" style="flex:100%;width:100%">
            {{Form::checkbox('is_cash',1,null,['id'=>'check-visa'])}}
               <label class="m-checkbox" for="check-visa" style="padding-right: 0">
                   الدفع الكاش
               </label>
           </div>


           <div class="m-checkbox-inline" style="flex:100%;width:100%">
            {{Form::checkbox('is_deffered',1,null,['id'=>'check-differed'])}}
               <label class="m-checkbox" for="check-differed" style="padding-right: 0">
                   الدفع اجل
               </label>
           </div>

           <div class="m-checkbox-inline" style="flex:100%;width:100%">
            {{Form::checkbox('is_visa',1,null,['id'=>'check-cash'])}}
               <label class="m-checkbox" for="check-cash" style="padding-right: 0">
                   الدفع شبكة
               </label>
            </div>

        </div>



</div>

    <div class="form-group m-form__group">
        <label> الصوره </label>
        @if(isset($user))

            <img src="{!! url($user->image)!!}" width="250" height="250">
        @endif
        <input type="file" class="form-control m-input" name="image">
    </div>
    <div class="form-group m-form__group">
        <label>السيارة</label>
        <select name="car_id" class="form-control  m-input select2">
            <option disabled selected>إختار السيارة</option>
            @foreach($cars as $car)
                <option
                    value="{{$car->id}}" @if(isset($user)) {{$user->car_store->car_id == $car->id ? 'selected' :'' }} @endif >{{$car->car_name}}</option>
            @endforeach
        </select>
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
