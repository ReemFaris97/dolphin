@extends('AccountingSystem.layouts.master')
@section('title','تعديل    مكونات التصنيع')
@section('parent_title','إدارة     التصنيع')
@section('action', URL::route('accounting.product-recipes.index'))
@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">

            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::model($product, ['route' => ['accounting.product-recipes.update' ,$product->id] ,'class'=>'phone_validate parsley-validate-form','method' => 'PATCH','files'=>true ,'x-data'=>'ProductionForm']) !!}
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
                product_id: {{$product->product_id}},
                unit_id: null,
product:{
                    product_id:null,
                    unit_id:null,
                    quantity:null,
},
                row_products: @json($product->items),
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
                    getProductUnits(this.product_id).then(units => this.product_units = units)

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

            Alpine.data('recipe', (product) => ({
                selectedPro: product.product_id,
                unit_id:product.unit_id,
                quantity:product.quantity,
                product_units: [],

                init() {

                    if(this.selectedPro!==''){
                        getProductUnits(this.selectedPro).then(units => this.product_units = units)

                    }
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
