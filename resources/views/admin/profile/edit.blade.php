@extends('admin.layouts.app')
@section('title') تعديل بيانات {{ auth()->user()->name }}
@endsection

@section('header')
@endsection

@section('breadcrumb')
    {{--@php($breadcrumbs=['الاعضاء'=>route('admin.home'),'تعديل'=>route('admin.users.edit',$user->id)])--}}
    {{--@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb',--}}
    {{--['breadcrumbs' =>$breadcrumbs ])--}}
@endsection

@section('content')


    <div class="m-content">
        <div class="row">
            <div class="col-md-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head belong-to-aform">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    تعديل {{ auth()->user()->name }}
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::model($user,['method'=>'post','route'=>['admin.users.update.profile' ],'files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}
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

                        <div class="form-group m-form__group">
                            <label> الصوره </label>
                            @if(isset($user))

                                <img src="{!! url($user->image)!!}" width="250" height="250">
                            @endif
                            <input type="file" class="form-control m-input" name="image">
                        </div>


                    </div>


                    @push('scripts')
                        <script>
                            $('#check-all').change(function () {
                                $("input:checkbox").prop("checked", $(this).prop("checked"))
                            })
                        </script>

                    @endpush


                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions">
                            <button type="submit" class="btn btn-primary">تعديل</button>
                        </div>
                    </div>

                {!!Form::close()!!}
                <!--end::Form-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
