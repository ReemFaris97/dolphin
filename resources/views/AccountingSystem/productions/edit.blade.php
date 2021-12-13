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
            {!!Form::model($production, ['route' => ['accounting.productions.update' ,$production->id] ,'class'=>'phone_validate parsley-validate-form','method' => 'PATCH','files'=>true ,'x-data'=>'ProductionForm']) !!}

            @include('AccountingSystem.productions.form')

            {!!Form::close() !!}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
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
        document.addEventListener('alpine:init', () => {
            Alpine.data('ProductionForm', () => ({
                product: {
                    product_id: null,
                    unit_id: null,
                    quantity: null,
                },
                products: @json($products),

                row_products: @json($production->items),

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
        })
    </script>
@endpush
