@extends('distributor.layouts.app')
@section('title') تعديل شريحة {!!$client_class->name!!}
@endsection

@section('header')
@endsection

@section('breadcrumb')
@php($breadcrumbs=['شرائح العملاء'=>route('distributor.client-classes.index'),'تعديل'=>route('distributor.client-classes.edit',$client_class->id)])
    @includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb',
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
                                تعديل {!! $client_class->name!!}
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->

                {!! Form::model($client_class,['method'=>'put','route'=>['distributor.client-classes.update',$client_class->id],'files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}
             @include('distributor.client_classes._form')

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
