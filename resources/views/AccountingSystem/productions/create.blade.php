@extends('AccountingSystem.layouts.master')
@section('title','إنشاء أمر تصنيع')
@section('parent_title','إدارة التصنيع ')
@section('action', URL::route('accounting.productions.index'))
@section('styles')

@endsection

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">إضافة أمر تصنيع</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            {!!Form::open( ['route' => 'accounting.productions.store' ,'class'=>'form phone_validate parsley-validate-form', 'method' => 'Post','files' => true,'x-data'=>'production_form' ]) !!}
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

                row_products: [],
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


{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#removeProduct').click(function () {--}}
{{--                if ($('.productRow').length > 1) {--}}
{{--                    $('.productRow')[$('.productRow').length - 1].remove();--}}
{{--                }--}}
{{--            });--}}
{{--            $('#addProduct').click(function () {--}}
{{--                $('#production_form').find('.productRow').first().clone().insertBefore(".text-center");--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"--}}
{{--            integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="--}}
{{--            crossorigin="anonymous" referrerpolicy="no-referrer">--}}
{{--    </script>--}}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('.js-example-basic-single').select2();--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(document).on('change', '#company_id', function () {--}}
{{--            let productionLineSelect = $('#production_line_id');--}}
{{--            $.ajax({--}}
{{--                url: `{{ url('accounting/ajax/production-lines') }}/${$(this).val()}`,--}}
{{--                type: "get",--}}
{{--                success (data) {--}}
{{--                    //   console.log(data)--}}
{{--                    productionLineSelect.empty();--}}
{{--                    productionLineSelect.append('<option value="">اختر خط الانتاج</option>');--}}
{{--                    data.forEach( line => {--}}
{{--                        productionLineSelect.append(`--}}
{{--                                <option value="${line.id}">${line.name}</option>--}}
{{--                            `);--}}
{{--                    });--}}
{{--                    productionLineSelect.selectpicker('refresh');--}}
{{--                },--}}
{{--                error (error) {--}}
{{--                    console.log(error)--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $(document).on('change', '#product_id', function () {--}}
{{--            let unitSelect = $('#unit_id');--}}
{{--            $.ajax({--}}
{{--                --}}{{--url: `{{ url('accounting/ajax/production-lines') }}/${$(this).val()}`, --}}
{{--                url: `{{ url('accounting/product-units') }}/${$(this).val()}`,--}}
{{--                type: "get",--}}
{{--                success (data) {--}}
{{--                    //   console.log(data)--}}
{{--                    unitSelect.empty();--}}
{{--                    unitSelect.append('<option value="">اختر الوحدة  </option>');--}}
{{--                    data.forEach( unit => {--}}
{{--                        unitSelect.append(`--}}
{{--                                <option value="${unit.id}">${unit.name}</option>--}}
{{--                            `);--}}
{{--                    });--}}
{{--                    unitSelect.selectpicker('refresh');--}}
{{--                },--}}
{{--                error (error) {--}}
{{--                    console.log(error)--}}
{{--                }--}}
{{--            })--}}
{{--        })--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        $('#products').select2({--}}
{{--            ajax: {--}}
{{--                delay: 250,--}}
{{--                url: "/accounting/products-by-ajax",--}}
{{--                data: function (params) {--}}
{{--                    return {--}}
{{--                        search: params.term,--}}
{{--                        page: params.page || 1--}}
{{--                    };--}}
{{--                },--}}
{{--                processResults: function (data, params) {--}}
{{--                    params.page = params.page || 1;--}}
{{--                    results = _.toArray(data.data.data);--}}
{{--                    return {--}}
{{--                        results: results,--}}
{{--                        pagination: {--}}
{{--                            more: data.has_more--}}
{{--                        }--}}
{{--                    };--}}
{{--                },--}}
{{--                cache: true--}}
{{--            },--}}
{{--            placeholder: 'ابحث عن الاصناف',--}}
{{--            minimumInputLength: 1,--}}
{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}
