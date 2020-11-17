@extends('distributor.layouts.app')
@section('title') اضافه منتج جديد
@endsection

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['الاصناف'=>route('distributor.storeTransfer.index'),'اضافه'=>route('distributor.storeTransfer.create')])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
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

                    {!! Form::open(['method'=>'post','route'=>'distributor.storeTransfer.store','files'=>'true','class'=>'clearfix m-form m-form--fit m-form--label-align-right'])!!}

                    <div class="m-portlet__body a-smaller-input-wrapper">
                        <div id="userPanel" {{--style="display: none;"--}} class="form-group m-form_group ">
                            <label>المندوب</label>

                            {!! Form::select('user_id',$users,null,['id'=>'userSelect','class'=>'form-control m-input select2','placeholder'=>'اختر المندوب']) !!}

                        </div>

                        <div id="userPanel" {{--style="display: none;"--}} class="form-group m-form_group ">
                            <label>المخزن</label>

                            {!! Form::select('store_id',$stores??[],null,['id'=>'userStores','class'=>'form-control m-input select2','placeholder'=>'اختر المخزن']) !!}

                        </div>
                        @include('distributor.stores._attach_product')
                        {{--
                                                <div class="form-group m-form__group">
                                                    <label>إختار المنتج والكمية </label>
                                                    {!! Form::select('product_id',$products??[],null,['id'=>'product_id','class'=>'form-control m-input select2','placeholder'=>'اختر المنتج']) !!}
                                                </div>

                                                <div class="form-group m-form__group">
                                                    <label>كمية المنتج</label>
                                                    {!! Form::number('quantity',null,['class'=>'form-control m-input','id'=>'product_quantity'])!!}
                                                </div>

                                                <div class="form-group m-form__group">
                                                    <button id="addProduct" type="button" class="btn btn-primary">إضافة المنتج</button>
                                                </div>

                                                <div class="form-group m-form__group">
                                                    <table class="table table-striped- table-bordered table-hover table-checkable">
                                                        <thead>
                                                        <tr>
                                                            <th>المنتج</th>
                                                            <th>الكمية</th>
                                                            <th>حذف</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="tableBody">
                                                        </tbody>

                                                    </table>
                                                </div>
                                           --}} </div>


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

            $('#userSelect').on('change', function () {
                var id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '{{ route('distributor.getDistributorStores') }}',
                    data: {user_id: id},

                    success: function (data) {
                        $('#userStores').html(data.data);
                    }
                });
            });

        </script>

    @endpush
@endsection
