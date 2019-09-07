@extends('admin.layouts.app')
@section('title') تقارير الموظف
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['التقارير'=>"",])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')



    <div class="col-md-12">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head belong-to-aform">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
												<span class="m-portlet__head-icon m--hide">
													<i class="la la-gear"></i>
												</span>
                        <h3 class="m-portlet__head-text">
                           تقارير الموظف
                        </h3>
                    </div>
                </div>
            </div>

            <!--begin::Form-->
            {!! Form::open(['method'=>'get','route'=>'admin.workerReport','files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}


                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">إختار الموظف</label>
                        {!! Form::select('user_id',$users,null,['class'=>'form-control m-input select2 required','placeholder'=>'ادخل اسم الموظف'])!!}

                    </div>

                    <div class="form-group m-form__group width-50">
                        <label for="exampleInputPassword1">الفترة من : </label>
                        {!! Form::text('from',null,['class'=>'form-control m-input datepicker','placeholder'=>'الفترة من','autocomplete'=>'off'])!!}
                    </div>
                    <div class="form-group m-form__group width-50">
                        <label for="exampleSelect1">الفترة إلى : </label>
                        {!! Form::text('to',null,['class'=>'form-control m-input datepicker','placeholder'=>'الفترة إلى','autocomplete'=>'off'])!!}
                    </div>
                </div>
                <div class="m-portlet__foot m-portlet__foot--fit mar-t-115">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-metal">بحث</button>
                        <button type="reset" class="btn btn-secondary">اعادة ادخال</button>
                    </div>
                </div>

            {!!Form::close()!!}
            <!--end::Form-->
        </div>
    </div>

@endsection

@section('owl')
<script>
	$('.datepicker').on('changeDate', function(ev){
    $(this).datepicker('hide');
});
</script>
@endsection
