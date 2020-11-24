@extends('distributor.layouts.app')
@section('title') اضافه اتلاف
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
                                    اتلاف اصناف </h3>
                            </div>
                        </div>
                    </div>

                    <!--begin::Form-->

                    {!! Form::open(['method'=>'post','class'=>'clearfix m-form m-form--fit m-form--label-align-right'])!!}

                    <div class="m-portlet__body a-smaller-input-wrapper">

                        <div class="form-group m-form_group ">
                            <label> المندوب</label>
                            {!!
                            Form::select('user_id',$users,old('user_id')??$store->distributor_id??null,['id'=>'userSelect','class'=>'form-control
                            m-input select2','placeholder'=>'اختر
                            المندوب','onChange'=>"getUserStore('select[name=\"store_id\"]', this.value)"]) !!}

                        </div>

                        <div class="form-group m-form_group ">
                            <label>من المخزن </label>

                            {!!
                            Form::select('store_id',[],old('store_id')??$store->id??null,['class'=>'form-control
                            m-input select2','placeholder'=>'اختر المخزن ',
                            'onChange'=>'getStoreProducts(this.value)'
                            ]) !!}

                        </div>


                        @include('distributor.stores._attach_product',['products'=>[]])
                    </div>


                    <div class="m-portlet__foot m-portlet__foot--fit full--width">
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

        </script>

    @endpush
@endsection