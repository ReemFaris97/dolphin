@extends('admin.layouts.app')
@section('title') تعديل بيانات {!!$user->name!!}
@endsection
@section('header')
@endsection
@section('breadcrumb')
@php($breadcrumbs=['الاعضاء'=>route('admin.home'),'تعديل'=>route('admin.users.edit',$user->id)])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb',
['breadcrumbs' =>$breadcrumbs ])
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
                                تعديل {!! $user->name!!}
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                {!! Form::model($user,['method'=>'put','route'=>['admin.users.update',$user->id],'files'=>'true','class'=>'parsley-validate-form m-form m-form--fit m-form--label-align-right'])!!}
                @include('admin.users._form')
                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary">حفظ</button>
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