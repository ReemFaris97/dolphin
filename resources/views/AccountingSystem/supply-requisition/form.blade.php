@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif




<div class="form-group col-md-6 pull-left">
    <label> شركة التوريد</label>
    {!! Form::select("accounting_company_id",\App\Models\AccountingSystem\AccountingCompany::pluck('name','id'),null,['class'=>'form-control'])!!}
</div>


<div class="form-group col-md-6 pull-left">
    <label> الفرع</label>
    {!! Form::select("accounting_branch_id",\App\Models\AccountingSystem\AccountingBranch::pluck('name','id'),null,['class'=>'form-control'])!!}
</div>

<div class="form-group col-md-12 pull-left">
    <label>الموردين </label>
    {!! Form::select("accounting_supplier_id",\App\Models\AccountingSystem\AccountingSupplier::pluck('name','id'),null,['class'=>'form-control select2',
    'id'=>'supplier_id'])!!}
</div>

<div class="form-group col-md-10 pull-left">
    <label>المنتجات </label>
    <select name="products" id="product_id"></select>
</div>

<div class="col-md-2 form-group">
    <button id="add" class="btn btn-success form-control " type="button">+</button>
</div>
<div class="col-md-12">
    <table class="table finalTb table-striped table-bordered">
        <thead>
        <tr>
            <th>اسم المنتج</th>
            <th>باركود</th>
            <th>الوحدة</th>
            <th>الكمية المطلوب</th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody id="products-list"></tbody>
    </table>
</div>

<div class="text-center col-md-12">
    <div class="text-right">
        <button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i></button>
    </div>
</div>
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
            integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $('.select2').select2();

            addSelect2search('#product_id')
            /*$('#supplier_id').change(function () {
                addSelect2search('#products')
            })*/
            $('#add').click(function (){
                appendProduct($('#product_id').val());
            })
        });

        function addSelect2search(selector) {
            $(selector).select2({
                ajax: {
                    delay: 250,
                    url: "/accounting/productsAjex/",
                    data: function (params) {
                        var supplier_id = $('#supplier_id').val();
                        var query = {
                            search: params.term,
                            supplier_id,
                            page: params.page || 1
                        }
                        return query;
                    },


                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        results = _.toArray(data.data.data);
                        return {
                            results: results,
                            pagination: {
                                more: data.has_more
                            }
                        };
                    },
                    cache: true
                },
                placeholder: 'المنتجات',
                minimumInputLength: 1,
                delay: 250
            });

        }

        function appendProduct(product_id) {
            if (product_id == '' ||  product_id == null) {
                alert('يجب اختيار منتج !')
            } else {
                var index=$('#products-list').children().length;
                $.ajax({
                    url: '/accounting/supply-requisitions/product/' + product_id,
                    method: "GET",
                    data:{
                        index
                    },
                    success: function (resp) {
                        $('#products-list').append(resp.html)

                        $('#delete-'+(index+1)).click(function (e){deleteRaw(e.target)})
                    }
                })
            }

        }

        function deleteRaw(selector){
            console.log('test')
            $(selector).closest('tr').remove();
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>


@endsection
