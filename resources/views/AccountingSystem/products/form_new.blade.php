@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="app">
    <div id="app">
        <div>
            <form-wizard shape="tab" color="#2ECC71">
                <tab-content title="Personal details" icon="fas fa-archive">

                    <div class="row">
                        <div class="form-group   col-md-6 col-xs-12 pull-left">
                            <label> <span class="text-danger">*</span> اسم المنتج باللغة العربيه </label>
                            <input name="product_name" v-model="form.product_name" class="form-control"
                                placeholder="اسم المنتج باللغة العربية" required />

                        </div>
                        <div class="form-group   col-md-6 col-xs-12 pull-left">
                            <label> <span class="text-danger">*</span> اسم المنتج باللغة الانجليزية </label>
                            <input name="en_name" v-model="form.en_name" class="form-control"
                                placeholder="اسم المنتج باللغة الانجليزية" required />

                        </div>

                        <div class="form-group  col-md-6 col-xs-12 ">
                            <label> اسم التصنيف </label>

                            <div class="row">
                                <div class="col-md-11">
                                    <v-select :options="categories" v-model="form.category_id"
                                        :reduce="(category)=>category.id" :required="!form.category_id"
                                        {{-- class="form-control" --}} placeholder="اختر اسم التصنيف التابع له المنتج " />
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-success" target="_blank"
                                        href="{{ route('accounting.categories.create') }}"><i
                                            class="fas fa-plus"></i> </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group  col-md-6 col-xs-12 ">
                            <label> اسم المورد </label>
                            <div class="row">
                                <div class="col-md-11">
                                    <v-select :options="suppliers" v-model="form.supplier_id"
                                        :reduce="(supplier)=>supplier.id" :required="!form.supplier_id"
                                        {{-- class="form-control" --}} placeholder="اختر اسم المورد للمنتج " />
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-success" target="_blank"
                                        href="{{ route('accounting.suppliers.create') }}"><i
                                            class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>


                        <div class="form-group  col-md-6 col-xs-12 ">
                            <label> نوع المنتج </label>
                            <v-select :options="product_type" v-model="form.type"
                                :reduce="(product_type)=>product_type.id" :required="!form.type" {{-- class="form-control" --}}
                                placeholder="اختر نوع للمنتج " />
                        </div>


                        <div class="form-group   col-md-6 col-xs-12 pull-left">
                            <label> <span class="text-danger">*</span> وصف المنتج </label>
                            <textarea name="description" v-model="form.description" class="form-control">
                            </textarea>
                        </div>

                        <div class="form-group  col-md-6 col-xs-12 ">
                            <label> الوحدة الاساسية </label>
                            <v-select :options="units" v-model="form.main_unit" :reduce="(main_unit)=>main_unit.label"
                                :required="!form.main_unit" {{-- class="form-control" --}} placeholder="اختر الوحدة الرئيسية " />
                        </div>


                        <div class="form-group   col-md-6 col-xs-12 pull-left">
                            <label> <span class="text-danger">*</span> اسم المنتج باللغة الانجليزية </label>
                            <input type="file" name="image" {{-- v-model="form.image" --}} class="form-control"
                                @change="(event)=>event" />

                        </div>


                        <div class="row">
                            <div
                                class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper">
                                <label>الحالة</label>
                                <span class="new-radio-wrap">
                                    <label for="active">مفعل </label>
                                    <input type="radio" name="is_active" id="active" checked :value="1"
                                        v-model="form.is_active" class="form-control" />
                                </span>
                                <span class="new-radio-wrap">
                                    <label for="dis_active">غير مفعل </label>

                                    <input type="radio" name="is_active" id="dis_active" checked :value="0"
                                        v-model="form.is_active" class="form-control" />
                                </span>
                            </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label> <span class="text-danger">*</span> سعر التكلفة</label>
                                <input type="number" name="product_purchasing_price"
                                    v-model="form.product_purchasing_price" class="form-control" />

                            </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label> <span class="text-danger">*</span> سعر البيع</label>
                                <input type="number" name="product_selling_price" v-model="form.product_selling_price"
                                    class="form-control" />

                            </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label> <span class="text-danger">*</span> الحد الادنى من الكمية</label>
                                <input type="number" name="min_quantity" v-model="form.min_quantity"
                                    class="form-control" />

                            </div>
                            <div class="form-group  col-md-6 col-xs-12 pull-left">
                                <label> <span class="text-danger">*</span> الحد الاقصى من الكمية</label>
                                <input type="number" name="max_quantity" v-model="form.max_quantity"
                                    class="form-control" />

                            </div>

                            <div class="form-group  col-md-6 col-xs-12 ">
                                <label> اسم الشركة المصنعة </label>

                                <div class="row">
                                    <div class="col-md-10">
                                        <v-select :options="industrials" v-model="form.industry_id"
                                            :reduce="(industry)=>industry.id" :required="!form.category_id"
                                            placeholder="اختر اسم الشركة المصنعة " />
                                    </div>
                                    <div class="col-md-1">
                                        <a class="btn btn-success" target="_blank"
                                            href="{{ route('accounting.industrials.create') }}"><i
                                                class="fas fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="form-group  col-md-12 col-xs-12 ">
                            <label> الباركود </label>

                            <div class="col-md-10">
                                <v-select name="barcodes[]" v-model="form.bar_code" :taggable="true" :multiple="true"
                                    :options="[]" placeholder="الباركود" />
                            </div>
                        </div>
                        <button class="btn btn-success" type="button" @click="addSubUnit">اضافة وحده فرعية</button>
                        <table class="table  finalTb table-responsive  table-border w-100">
                            <thead>
                                <tr>
                                    <th>الاسم</th>
                                    <th>الباركود</th>
                                    <th>مقدرها من الوحده الرئيسية</th>
                                    <th>سعر البيع</th>
                                    <th>سعر الشراء</th>
                                    <th>الكمية</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(sub_unit,index) in  form.sub_units">
                                    <td>
                                        <input type="text" :name="`[sub_units][${index}][name]`" class="form-control"
                                            v-model="sub_unit.name">
                                    </td>
                                    <td>
                                        <input type="text" :name="`[sub_units][${index}][bar_code]`"
                                            class="form-control" v-model="sub_unit.bar_code">
                                    </td>
                                    <td><input type="number" :name="`[sub_units][${index}][main_unit_present]`"
                                            class="form-control" v-model="sub_unit.main_unit_present"></td>
                                    <td><input type="number" :name="`[sub_units][${index}][selling_price]`"
                                            class="form-control" v-model="sub_unit.selling_price"></td>
                                    <td><input type="number" :name="`[sub_units][${index}][purchasing_price]`"
                                            class="form-control" v-model="sub_unit.purchasing_price"></td>
                                    <td><input type="number" :name="`[sub_units][${index}][quantity]`"
                                            class="form-control" v-model="sub_unit.quantity"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </tab-content>
                <tab-content title="Additional Info">
                    <div class="row">
                        <div class="form-group   col-md-6  col-xs-12 ">
                            <label> اسم الشركة </label>
                            <div class="row">
                                <div class="col-md-11">

                                    <v-select name="company_id" v-model="form.company_id" :options="companies"
                                        :reduce="company=>company.id" />
                                </div>
                                <div class="col-md-1">

                                    <div class="btn-group ">
                                        <a href="{{ route('accounting.companies.create') }}" class="btn btn-success"
                                            target="_blank">
                                            <span class="m-l-5">

                                                <i class="fa fa-plus"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group   col-md-6  col-xs-12 ">
                            <label> اسم الفرع التابع </label>

                            <div class="row">
                                <div class="col-md-11">

                                    <v-select name="branch_id" v-model="form.branch_id" :options="branches"
                                        :reduce="branch=>branch.id" />
                                </div>
                                <div class=" col-md-1 btn-group ">
                                    <a href="{{ route('accounting.branches.create') }}" class="btn btn-success"
                                        target="_blank">
                                        <span class="m-l-5">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group   col-md-6  col-xs-12 ">
                            <label> اسم المستودع </label>
                            <div class="
                            row">
                            <div class="col-md-11">

                                <v-select name="store_id" v-model="form.store" :options="stores"
                                    :reduce="store=>store.id" />
                            </div>
                            <div class="btn-group col-md-1">
                                <a href="{{ route('accounting.stores.create') }}" class="btn btn-success"
                                    target="_blank">
                                    <span class="m-l-5">

                                        <i class="fa fa-plus"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group   col-md-6  col-xs-12 ">
                        <label> اسم الوجه </label>

                        <v-select name="face_id" v-model="form.face_id" :options="faces" :reduce="face=>face.id" />
                    </div>
                    <div class="form-group   col-md-6  col-xs-12 ">
                        <label> اسم العمود التابع للوجه </label>
                        <v-select name="column_id" v-model="form.column_id" :options="columns"
                            :reduce="column=>column.id" />

                    </div>
                    <div class="form-group   col-md-6  col-xs-12 ">
                        <label> اسم الخلية التابعة للعمود </label>

                        <v-select name="cell_id" v-model="form.cell_id" :options="cells" :reduce="cell=>cell.id" />

                    </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label> الحجم </label><span class="asided-hint"> اختيارى ويكون بالسنتمتر المكعب</span>
                <input type="text" name="size" v-model="form.size" class="form-control" placeholder="الحجم" />
            </div>
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label> اللون </label><span class="asided-hint">اختيارى</span>
                <input type="text" name="color" v-model="form.color" class="form-control" placeholder="اللون" />

            </div>
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label> الارتفاع </label><span class="asided-hint">اختيارى ويكون بالسنتمتر</span>
                <input type="text" name="height" v-model="form.height" class="form-control" placeholder="الارتفاع" />

            </div>
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label> العرض </label><span class="asided-hint">اختيارى ويكون بالسنتمتر المربع</span>
                <input type="text" name="width" v-model="form.width" class="form-control" placeholder="العرض" />

            </div>
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label> تاريخ الانتهاء </label><span class="asided-hint">اختيارى</span>
                <input type="text" name="expired_at" v-model="form.expired_at" class="form-control"
                    placeholder="تاريخ الانتهاء" />

            </div>
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label>مده التنبية</label><span class="asided-hint">اختيارى</span>
                <input type="number" name="alert_duration" v-model="form.alert_duration" class="form-control"
                    placeholder="مده التنبية" />

            </div>
            <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label>عدد أيام فترة الركود</label><span class="asided-hint">اختيارى</span>
                <input type="number" name="num_days_recession" v-model="form.num_days_recession" class="form-control"
                    placeholder="عدد أيام فترة الركود" />


            </div>
            {{-- <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                <label> اختر الحساب </label>
                {!! Form::select("account_id",accounts(),null,['class'=>'form-control','placeholder'=>' اختر الحساب'])!!}
            </div> --}}
        </div>
        </tab-content>
        <tab-content title="Last step">
            Yuhuuu! This seems pretty damn simple
        </tab-content>
        </form-wizard>
    </div>
</div>

</div>

<div class="text-center col-md-12 m--margin-bottom-5">
    <div class="text-center">
        <button type="submit" id="register" class="btn btn-success">حفظ <i
                class="icon-arrow-left13 position-right"></i>
        </button>
    </div>
</div>

<!-- /collapsible with different panel styling -->
<!-- end table-->
<!-- end table-->
@section('scripts')


    <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
    <link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">

    <script src="https://unpkg.com/vue@latest"></script>
    <script src="https://unpkg.com/vue-select@latest"></script>
    <script src="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.js"></script>
    <script
        src="https://cdn.jsdelivr.net/combine/npm/vuelidate@0.7.6/dist/validators.min.js,npm/vuelidate@0.7.6/dist/vuelidate.min.js">
    </script>

    <script>
        Vue.component('v-select', VueSelect.VueSelect);

        var app = new Vue({
            el: '#app',

            data: {

                form: @json($product),
                categories: @json($categories ?? []),
                suppliers: @json($suppliers ?? []),
                units: @json($units ?? []),
                industrials: @json($industrials ?? []),
                taxs: @json($taxs),
                companies: @json($companies),
                branches: @json($branches ?? []),
                accounts: @json(accounts()),
                sub_unit: @json($unit_template),
                component: @json($component_temp),
                faces: @json($faces),
                companies: @json($companies),
                stores: @json($stores),
                columns: @json($columns),
                cells: @json($cells),
                product_type: [{
                        id: "store",
                        label: "مخزون",
                    },
                    {
                        id: "service",
                        label: "خدمه",
                    },
                    {
                        id: "offer",
                        label: "مجموعة اصناف ",
                    },
                    {
                        id: "creation",
                        label: "تصنيع",
                    },
                    {
                        id: "product_expiration",
                        label: "منتج بتاريخ صلاحيه",
                    },
                ]

            },
            methods: {
                onComplete: function() {
                    alert('Yay. Done!');
                },
                addSubUnit: function() {
                    this.form.sub_units.push({
                        ...this.sub_unit
                    });

                },
                getBranches: function() {
                    var company_id = this.form.company_id;
                    axios.get('/api/branches/' + company_id).then(response => {
                        this.branches = response.data;
                    });
                },
                getStores: function() {
                    var branch_id = this.form.branch_id;
                    axios.get('/api/stores/' + branch_id).then(response => {
                        this.stores = response.data;
                    });
                },
                getFaces: function() {
                    var store_id = this.form.store_id;
                    axios.get('/api/faces/' + store_id).then(response => {
                        this.faces = response.data;
                    });
                },
                getFaces: function() {
                    var store_id = this.form.store_id;
                    axios.get('/api/columns/' + store_id).then(response => {
                        this.columns = response.data;
                    });
                },
                getCells: function() {
                    var column_id = this.form.column_id;
                    axios.get('/api/cells/' + column_id).then(response => {
                        this.columns = response.data;
                    });
                }

            }

        })
    </script>
@endsection
