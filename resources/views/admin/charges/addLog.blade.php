@extends('admin.layouts.app')
@section('title') اضافه تحديث
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['العهد'=>route('admin.charges.index'),'اضافه تحديث'=>route('admin.charges.create')])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')


    <div class="m-content">
        <div class="row">
            <div class="col-md-12">

                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                                <h3 class="m-portlet__head-text">
                                    اضافه تحديث
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','route'=>['admin.charges.AddLog',$charge->id],'files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}

                    <div class="m-portlet__body">

                        <div class="form-group m-form__group">
                            <label>الموظف</label>
                            {!! Form::select('worker_id',$users,null,['class'=>'form-control m-input select2','placeholder'=>'ادخل اسم الموظف'])!!}
                        </div>

                        <div class="form-group m-form__group">
                            <label>النوع</label>
                            {!! Form::select('type',['transfer'=>'ارسال','receive'=>'استقبال'],null,['class'=>'form-control m-input select2','placeholder'=>'اختار النوع'])!!}
                        </div>



                        <div class="form-group m-form__group">
                            <label> الصور </label>
                            {{--@if(isset($charge->images))--}}
                                {{--@foreach($charge->images as $image)--}}
                                    {{--<img src="{!! url($image->image)!!}" width="250" height="250">--}}
                                {{--@endforeach--}}
                            {{--@endif--}}
                            <input type="file" class="form-control m-input" name="images[]" multiple>
                        </div>

                    </div>


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
