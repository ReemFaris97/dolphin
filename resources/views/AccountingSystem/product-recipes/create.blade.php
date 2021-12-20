@extends('AccountingSystem.layouts.master')
@section('title','إنشاء مكونات التصنيع  ')
@section('parent_title','إدارة التصنيع ')
@section('action', URL::route('accounting.product-recipes.index'))

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة مكونات التصنيع </h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.product-recipes.store' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true,'x-data'=>'ProductionForm' ]) !!}
            @include('AccountingSystem.product-recipes.form')
            {!!Form::close() !!}
        </div>
    </div>


@endsection
@push('scripts')
    <script>
        async function getProductUnits(product_id) {
            const response = await fetch(`/accounting/product-units/${product_id}`);
            return response.json();
        }
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('ProductionForm', () => ({
                product_id: null,
                unit_id: null,

                row_products: [],
                product_units: [],

                setProduct(e, index, name) {
                    this.row_products[index][name] = e.target.value
                },
                deleteItem(i) {
                    this.row_products.splice(i, 1)
                },
                addItem() {
                    this.row_products.push(Object.assign({}, this.product))
                },

                init() {
                    let select2 = $(this.$refs.product_id).select2(
                        {
                            ajax: {
                                delay: 250,
                                url: "/accounting/products-creation-by-ajax",
                                data: function (params) {
                                    return {
                                        search: params.term,
                                        page: params.page || 1
                                    };
                                },
                                processResults: function (data, params) {
                                    params.page = params.page || 1;
                                    results = data.data.data;
                                    return {
                                        results: results,
                                        pagination: {
                                            more: data.has_more
                                        }
                                    };
                                },
                                cache: true
                            },
                            placeholder: 'ابحث عن الاصناف',
                            minimumInputLength: 1,
                        }
                    );
                    select2.on('select2:select', (event) => {
                        this.product_id = event.target.value;
                    });
                    this.$watch('product_id', (value) => {
                        select2.val(value).trigger('change');
                        getProductUnits(value).then(units => this.product_units = units)
                    });

                }
            }))


            Alpine.data('recipe', () => ({
                selectedPro: '',
                product_units: [],

                init() {
                    let select2 = $(this.$refs.select).select2(
                        {
                            ajax: {
                                delay: 250,
                                url: "/accounting/products-by-ajax",
                                data: function (params) {
                                    return {
                                        search: params.term,
                                        page: params.page || 1
                                    };
                                },
                                processResults: function (data, params) {
                                    params.page = params.page || 1;

                                    results = data.data.data;
                                    return {
                                        results: results,
                                        pagination: {
                                            more: data.has_more
                                        }
                                    };
                                },
                                cache: true
                            },
                            placeholder: 'ابحث عن الاصناف',
                            minimumInputLength: 1,
                        }
                    );
                    select2.on('select2:select', (event) => {
                        this.selectedPro = event.target.value;
                    });
                    this.$watch('selectedPro', (value) => {
                        select2.val(value).trigger('change');
                        getProductUnits(value).then(units => this.product_units = units)
                    });
                },
            }))

        })
    </script>
@endpush

