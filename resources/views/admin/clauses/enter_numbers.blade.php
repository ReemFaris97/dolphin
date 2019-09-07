@extends('admin.layouts.app')
@section('title')إدخال الأرقام
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المهمات'=>route('admin.tasks.index'),'إدخال الارقام'=>''])
@includeWhen(isset($breadcrumbs),'admin.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
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
                                    إدخال الأرقام
                                </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','route'=>'admin.clauses.post.change.numbers','files'=>'true','class'=>'m-form m-form--fit m-form--label-align-right'])!!}

                    @forelse($clauses as $clause)

                        <div class="form-group m-form__group">
                            <label>{{$clause->name}}</label>

                            @if(optional(optional($clause->logs->last())->created_at)->toDateString()!=date('Y-m-d'))
                                <input type="hidden" name="ids[]" value="{{$clause->id}}" >
                                {!! Form::number('amounts[]',null,['class'=>'form-control m-input','placeholder'=>'الكمية'])!!}
                            @else
                                <input type="hidden" disabled="disabled" name="ids[]" value="{{$clause->id}}" >
                                {!! Form::number('amounts[]',$clause->amount,['class'=>'form-control m-input','placeholder'=>'الكمية','disabled'=>'disabled'])!!}
                            @endif
                        </div>

                    @empty
                        <div class="form-group m-form__group">
                            <label>لا يوجد بنود مسنده إليك الآن</label>
                        </div>
                    @endforelse

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

@section('owl')
    <script>

        $(document).ready(function(){
            $("#threee-emps .one-single-emp-wrapper:nth-child(2) , #threee-emps .one-single-emp-wrapper:nth-child(3)").toggleClass('shown');
            $(".the-checklabel").on('click' , function(){
                $(this).parents('.checker-wrapper').next(".will-be-toggled").toggleClass('shown')
            })

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
            $('#previous_user').change(function () {
                var id = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.tasks.get.allTasks') }}',
                    data: {id: id},
                    dataType: 'json',

                    success: function (data) {
                        $('#workerTasks').html(data.data);
                    }
                });
            });

            //            **************************************
        });
    </script>

@endsection
