@extends('AccountingSystem.layouts.master')
@section('title','تعديل  أمر تصنيع')
@section('parent_title','إدارة     التصنيع')
@section('action', URL::route('accounting.productions.index'))
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
            {!!Form::model($production, ['route' => ['accounting.productions.update' ,$production->id] ,'class'=>'phone_validate parsley-validate-form','method' => 'PATCH','files'=>true ,'x-data'=>'production_form']) !!}

            @include('AccountingSystem.productions.form')

            {!!Form::close() !!}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('change', '#company_id', function () {
            let productionLineSelect = $('#production_line_id');
            $.ajax({
                url: `{{ url('accounting/ajax/production-lines') }}/${$(this).val()}`,
                type: "get",
                success (data) {
                    //   console.log(data)
                    productionLineSelect.empty();
                    productionLineSelect.append('<option value="">اختر خط الانتاج</option>');
                    data.forEach( line => {
                        productionLineSelect.append(`
                                <option value="${line.id}">${line.name}</option>
                            `);
                    });
                    productionLineSelect.selectpicker('refresh');
                },
                error (error) {
                    console.log(error)
                }
            })
        })
    </script>
    <script>
        async function getProductUnits(product_id) {
            const response = await fetch(`/accounting/product-units/${product_id}`);
            return response.json();
        }
    </script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('production_form', () => ({
                product_id: null,
                unit_id: null,
                quantity: null,
                recipe_id:null,

                row_products: @json($production->items),
                product_units: [],

                creationProducts:@json($creationProducts),

                setProduct(e, index, name) {
                    this.row_products[index][name] = e.target.value
                },
                deleteItem(i) {
                    this.row_products.splice(i, 1)
                },
                addItem() {
                    this.row_products.push(Object.assign({}, this.product))
                },
            }))


            Alpine.data('recipe', () => ({
                selectedPro: '',
                product_units: [],

                init() {
                    let select2 = $(this.$refs.select).select2(
                        // {
                        //     ajax: {
                        //         delay: 250,
                        //         url: "/accounting/products-recipes-by-ajax",
                        //         data: function (params) {
                        //             return {
                        //                 search: params.term,
                        //                 page: params.page || 1
                        //             };
                        //         },
                        //         processResults: function (data, params) {
                        //             params.page = params.page || 1;
                        //
                        //             results = data.data.data;
                        //             return {
                        //                 results: results,
                        //                 pagination: {
                        //                     more: data.has_more
                        //                 }
                        //             };
                        //         },
                        //         cache: true
                        //     },
                        //     placeholder: 'ابحث عن الاصناف',
                        //     minimumInputLength: 1,
                        // }
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
