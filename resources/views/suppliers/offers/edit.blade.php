@extends('suppliers.layouts.app')
@section('title') تعديل عرض رقم {!!$supplieroffer->id!!}
@endsection

@section('header')
@endsection

@section('breadcrumb')
@php($breadcrumbs=['العروض'=>route('supplier.home'),'تعديل'=>route('supplier.offers.edit',$supplieroffer->id)])
    @includeWhen(isset($breadcrumbs),'suppliers.layouts._breadcrumb',
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
                                    تعديل عرض{!! $supplieroffer->id!!}
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->

                {!! Form::model($supplieroffer,['method'=>'put','route'=>['supplier.offers.update',$supplieroffer->id],'files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}
               @include('suppliers.offers._form')

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
