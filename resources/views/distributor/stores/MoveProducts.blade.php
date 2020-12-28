@extends('distributor.layouts.app')
@section('title')نقل منتج من مستودع لاخر
@endsection

@section('header')
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
                                نقل مخزون من مندوب لآخر
                            </h3>
                        </div>
                    </div>
                </div>

                <!--begin::Form-->

                {!! Form::open(['method'=>'post','class'=>'clearfix m-form m-form--fit m-form--label-align-right'])!!}

                <div class="">
                    <div class="form-group m-form__group">
                        <label>نوع المستودع </label>
                        {!! Form::select('for_distributor',[
                        'مستودع داخلى',
                        'مستودع خارجى',
                        ],$store->for_distributor,['class'=>'form-control m-input select2','placeholder'=>'إختار نوع
                        المستودع','onChange'=>'showDistributor(this.value)'])!!}
                    </div>


                    <div class="form-group m-form_group distributor-section @if($store->for_distributor) d-block @else d-none @endif ">
                        <label> من المندوب</label>
                        {!! Form::select('from[user_id]',$users,old('from[user_id]')??$store->distributor_id??null,['id'=>'userSelect','class'=>'form-control select2  m-input select2','placeholder'=>'اختر  المندوب','onChange'=>"getUserStore('select[name=\"from[store_id]\"]', this.value)"]) !!}

                    </div>

                    <div class="form-group m-form_group ">
                        <label>من المستودع </label>

                        {!! Form::select('from[store_id]',$stores,old('from[store_id]')??$store->id??null,['class'=>'form-control
                        m-input select2','placeholder'=>'اختر المستودع المنقوله منه',
                        'onChange'=>'getStoreProducts(this.value)']) !!}

                    </div>

                    <div class="row m-2">

                    <div class="form-group m-form_group col-md-6">
                        <label> الى المندوب</label>
                        {!!
                        Form::select('to[user_id]',$users,old('to[user_id]')??$store->distributor_id??null,['class'=>'form-control
                        m-input select2','placeholder'=>'اختر
                        المندوب','onChange'=>"getUserStore('select[name=\"to[store_id]\"]', this.value)"]) !!}

                    </div>

                    <div class="form-group m-form_group  col-md-6">
                        <label>الى المستودع </label>

                        {!!
                        Form::select('to[store_id]',[],old('to[store_id]')??$store->id??null,['class'=>'form-control
                        m-input select2','placeholder'=>'اختر المستودع']) !!}

                    </div>
            </div>
                    <div class="form-group m-form__group">
                        <label> كود التسليم </label>
                        {!! Form::text('signature',null,['class'=>'form-control m-input','id'=>'signature'])!!}
                    </div>

                    @include('distributor.stores._attach_product',['products'=>$products])
                </div>


                <div class="m-portlet__foot m-portlet__foot--fit full--width">
                    <div class="m-form__actions">
                        <button type="submit" class="btn btn-primary">نقل</button>
                    </div>
                </div>
                {!!Form::close()!!}
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#check-all').change(function () {
        $("input:checkbox").prop("checked", $(this).prop("checked"))
    })

</script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    function getUserStore(store_name, user_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('distributor.getDistributorStores') }}',
            data: {
                user_id: user_id
            },

            success: function (data) {
                $(store_name).html(data.data);
            }
        });
    }

    function getStoreProducts(store_id) {
        $.ajax({
            type: 'get',
            url: '{{ route('distributor.getAjaxstoreProducts') }}',
            data: {
                store_id: store_id
            },
            success: function (data) {
                $('select[name="product_id"]').html(data.data);
            }
        });
    }


    function showDistributor(value) {
        if (value == 1) {
            $('.distributor-section').addClass('d-block')
            $('.distributor-section').removeClass('d-none')
            $('select[name="from[store_id]"]').html(
                "<option selected disabled> اختر</option>"
                );
            $('select[name="from[user_id]"]').prop('disabled',false)
        } else {
            $('.distributor-section').removeClass('d-block')
            $('.distributor-section').addClass('d-none')
            getUserStore('select[name="from[store_id]"]',null)
            $('select[name="from[user_id]"]').prop('disabled',true)
        }
    }


</script>

@endpush
@endsection
