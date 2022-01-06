@extends('admin.layouts.app')
@section('title') اضافه مهمه
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المهمات'=>route('admin.tasks.index'),'اضافه'=>route('admin.tasks.create')])
    @includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')


<div class="m-content">

    <div class="row">
        <div class="col-md-12">

            <!--begin::Portlet-->
            <div class="m-portlet m-portlet--tab">
               {{--  <div class="m-portlet__head belong-to-aform">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                اضافه مهمه
                            </h3>
                        </div>
                    </div>
                </div>
 --}}
            <div class="static-tabs">
                <a  href="{!! route('admin.tasks.index') !!}">كل مهمات النظام</a>
                <a class="links-tabs-active" href="{!! route('admin.tasks.create') !!}">اضافة مهمة جديدة  </a>
            </div>
                <!--begin::Form-->

                {!! Form::open(['method'=>'post','route'=>'admin.tasks.store','files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right form-relative-white'])!!}
    @include('admin.tasks._form')

                <div class="m-portlet__foot m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary">إسناد مهمة</button>
                    </div>
                </div>

                {!!Form::close()!!}
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
@endsection

@section('owl')
    <script>

        $(document).ready(function(){
	$('.datepicker').on('changeDate', function(ev){
    $(this).datepicker('hide');
});


            $("#threee-emps .one-single-emp-wrapper:nth-child(2) , #threee-emps .one-single-emp-wrapper:nth-child(3)").toggleClass('shown');
            $(".the-checklabel").on('click' , function(){
                $(this).parents('.checker-wrapper').next(".will-be-toggled").toggleClass('shown')
            });

            $(".the-big-checklabel").on('click' , function(){
                $("#threee-emps .one-single-emp-wrapper:nth-child(2) , #threee-emps .one-single-emp-wrapper:nth-child(3)").toggleClass('shown');
            })
        })

    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            $('#clauses').change(function () {
                var id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.getAjaxClauseAmount') }}',
                    data: {id: id},
                    dataType: 'json',

                    success: function (data) {
                        $('#clause_amount').val(data.data);
                    }
                });
            });

            //            **************************************
        });
    </script>

@endsection

