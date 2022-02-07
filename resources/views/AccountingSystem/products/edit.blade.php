@extends('AccountingSystem.layouts.master')
@section('title','تعديل المنتج')
@section('parent_title','إدارة  الاصناف')
@section('action', URL::route('accounting.products.index'))

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
            {!!Form::model($product, ['route' => ['accounting.products.update' ,$product->id] ,'class'=>'novalidate','novalidate','method' => 'PATCH','files'=>true]) !!}

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
                <div>
                    <form-wizard ref="form-wizard" shape="tab" color="#2ECC71" @on-complete="onComplete">
                        <tab-content title="Personal details" icon="fas fa-archive">

                            <div class="row">
                                <div class="form-group   col-md-6 col-xs-12 pull-left">
                                    <label> <span class="text-danger">*</span> اسم المنتج باللغة العربيه </label>
                                    <input name="name" v-model="form.name" class="form-control"
                                           placeholder="اسم المنتج باللغة العربية" required/>

                                </div>
                                <div class="form-group   col-md-6 col-xs-12 pull-left">
                                    <label> <span class="text-danger">*</span> اسم المنتج باللغة الانجليزية </label>
                                    <input name="en_name" v-model="form.en_name" class="form-control"
                                           placeholder="اسم المنتج باللغة الانجليزية" required/>

                                </div>
                                <div class="form-group   col-md-6  col-xs-12 ">
                                    <label> اسم الشركة </label>
                                    <div class="row">
                                        <div class="col-md-11">

                                            <v-select name="company_id" v-model="form.company_id" :options="companies"
                                                      :reduce="company=>company.id" @input="getBranches"/>
                                        </div>
                                        <div class="col-md-1">

                                            <div class="btn-group ">
                                                <a href="{{ route('accounting.companies.create') }}"
                                                   class="btn btn-success"
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
                                                      :reduce="branch=>branch.id"
                                                      @input="(event)=>{getStores();getFaces()}"/>
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
                                    <div class="row">
                                        <div class="col-md-11">

                                            <v-select name="store_id" v-model="form.store" :options="stores"
                                                      :reduce="store=>store.id"/>
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
                                <div class="form-group  col-md-6 col-xs-12 ">
                                    <label> اسم التصنيف </label>

                                    <div class="row">
                                        <div class="col-md-11">
                                            <v-select :options="categories" v-model="form.category_id"
                                                      :reduce="(category)=>category.id" :required="!form.category_id"
                                                      {{-- class="form-control" --}} placeholder="اختر اسم التصنيف التابع له المنتج "/>
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
                                            <v-select :options="suppliers" v-model="form.suppliers" item-text="name" item-value="id" multiple
                                                      :reduce="(supplier)=>supplier.id" :required="!form.suppliers"
                                                      {{-- class="form-control" --}} placeholder="اختر اسم المورد للمنتج "/>
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
                                              :reduce="(product_type)=>product_type.id" :required="!form.type"
                                              {{-- class="form-control" --}}
                                              placeholder="اختر نوع للمنتج "/>
                                </div>


                                <div class="form-group  col-md-6 col-xs-12 ">
                                    <label> الوحدة الاساسية </label>
                                    <v-select :options="units" v-model="form.main_unit"
                                              :reduce="(main_unit)=>main_unit.label"
                                              :required="!form.main_unit"
                                              {{-- class="form-control" --}} placeholder="اختر الوحدة الرئيسية "/>
                                </div>


                                <div class="row">
                                    <div
                                        class="form-group col-lg-4  col-md-4 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper">
                                        <label>الحالة</label>
                                        <span class="new-radio-wrap">
                                    <label for="active">مفعل </label>
                                    <input type="radio" name="is_active" id="active" checked :value="1"
                                           v-model="form.is_active" class="form-control"/>
                                </span>
                                        <span class="new-radio-wrap">
                                    <label for="dis_active">غير مفعل </label>

                                    <input type="radio" name="is_active" id="dis_active" checked :value="0"
                                           v-model="form.is_active" class="form-control"/>
                                </span>
                                    </div>
                                    <div class="form-group   col-md-6 col-xs-12 pull-left">
                                        <label> <span class="text-danger">*</span> سعر التكلفة</label>
                                        <input type="number" name="purchasing_price"
                                               v-model="form.purchasing_price" class="form-control"/>

                                    </div>
                                    <div class="form-group   col-md-6 col-xs-12 pull-left">
                                        <label> <span class="text-danger">*</span> سعر البيع</label>
                                        <input type="number" name="selling_price" v-model="form.selling_price"
                                               class="form-control"/>

                                    </div>
                                    <div class="form-group   col-md-6 col-xs-12 pull-left">
                                        <label> <span class="text-danger">*</span> الحد الادنى من الكمية</label>
                                        <input type="number" name="min_quantity" v-model="form.min_quantity"
                                               class="form-control"/>

                                    </div>


                                </div>


                                <div class="form-group  col-md-12 col-xs-12 ">
                                    <label> الباركود </label>

                                    <div class="col-md-10">
                                        <v-select name="barcodes[]" v-model="form.bar_code" :taggable="true"
                                                  :multiple="true"
                                                  :options="[]" placeholder="الباركود"/>
                                    </div>
                                </div>
                                <button class="btn btn-success" type="button" @click="addSubUnit">اضافة وحده فرعية
                                </button>
                                <table class="table  finalTb table-responsive  table-border w-100">
                                    <thead>
                                    <tr>
                                        <th>الاسم</th>
                                        <th>الباركود</th>
                                        <th>مقدرها من الوحده الرئيسية</th>
                                        <th>سعر البيع</th>
                                        <th>سعر الشراء</th>
                                        <th>الكمية</th>
                                        <th>الاعدادات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(sub_unit,index) in  form.sub_units">
                                        <td>
                                            <input type="text"
                                                   class="form-control"
                                                   v-model="sub_unit.name">
                                        </td>
                                        <td>

                                    <v-select
                                    v-model="sub_unit.bar_code"
                                        :name="`[sub_units][${index}][bar_code]`"
                                        :taggable="true"
                                        :multiple="true"
                                        :options="[]"
                                           />
                                        </td>
                                        <td><input type="number"
                                                   class="form-control" v-model="sub_unit.main_unit_present"></td>
                                        <td><input type="number"
                                                   class="form-control" v-model="sub_unit.selling_price"></td>
                                        <td><input type="number"
                                                   class="form-control" v-model="sub_unit.purchasing_price"></td>
                                        <td>
                                            <input type="number"
                                                   class="form-control" v-model="sub_unit.quantity">
                                        </td>

                                        <td>
                                            <button type="button" class="btn btn-danger"
                                                    @click="deleteSubUnits(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>

                                <div v-if="form.type==='creation'">
                                    <button class="btn btn-success" type="button" @click="addComponent">اضافة اصناف
                                        التصنيع
                                    </button>
                                    <table class="table  finalTb table-responsive  table-border w-100">
                                        <thead>
                                        <tr>
                                            <th>اسم المنتج</th>
                                            <th>الكمية بالوحدة الاساسية</th>
                                            <th>الاعدادات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="(component,index) in  form.components">
                                            <td>
                                                <v-select label="name" :filterable="false" :options="components"
                                                          v-model="component.name"
                                                          @search="onSearch">
                                                </v-select>

                                            </td>
                                            <td>
                                                <input type="text" :name="`[component][${index}][quantity]`"
                                                       class="form-control" v-model="component.quantity">
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger"
                                                        @click="(e)=>{form.component.splice(index,1)}"
                                                >
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>

                                </div>
                                <div v-if="form.type==='offer'">
                                    <div class="form-group col-xs-12 pull-left">
                                        <label for="products"><span class="text-danger">*</span> مجموعة الااصناف
                                        </label>
                                        <v-select name="products" label="name" :filterable="false" :options="components"
                                                  v-model="form.products"
                                                  @search="onSearch" multiple id="products"></v-select>
                                    </div>
                                </div>
                            </div>

                        </tab-content>
                        <tab-content title="Additional Info">
                            <div class="form-group  col-md-6 col-xs-12 ">
                                <label> اسم الشركة المصنعة </label>

                                <div class="row">
                                    <div class="col-md-10">
                                        <v-select :options="industrials" v-model="form.industry_id"
                                                  :reduce="(industry)=>industry.id" :required="!form.category_id"
                                                  placeholder="اختر اسم الشركة المصنعة "/>
                                    </div>
                                    <div class="col-md-1">
                                        <a class="btn btn-success" target="_blank"
                                           href="{{ route('accounting.industrials.create') }}"><i
                                                class="fas fa-plus"></i> </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group   col-md-6 col-xs-12 pull-left">
                                    <label> <span class="text-danger">*</span> وصف المنتج </label>
                                    <textarea name="description" v-model="form.description" class="form-control">
                            </textarea>
                                </div>

                                <div class="form-group   col-md-6 col-xs-12 pull-left">
                                    <label> <span class="text-danger">*</span> صورة المنتج </label>
                                    <input type="file" name="image" {{-- v-model="form.image" --}} class="form-control"
                                           @change="(event)=>event"/>

                                </div>
                                <div class="form-group   col-md-6 col-xs-12 pull-left">
                                    <label> <span class="text-danger">*</span> الحد الادنى من الكمية</label>
                                    <input type="number" name="min_quantity" v-model="form.min_quantity"
                                           class="form-control"/>

                                </div>
                                <div class="form-group  col-md-6 col-xs-12 pull-left">
                                    <label> <span class="text-danger">*</span> الحد الاقصى من الكمية</label>
                                    <input type="number" name="max_quantity" v-model="form.max_quantity"
                                           class="form-control"/>

                                </div>
                                <div class="form-group   col-md-6  col-xs-12 ">
                                    <label> اسم الوجه </label>

                                    <v-select name="face_id" v-model="form.face_id" :options="faces"
                                              :reduce="face=>face.id"
                                              @input="getColumns"
                                    />
                                </div>
                                <div class="form-group   col-md-6  col-xs-12 ">
                                    <label> اسم العمود التابع للوجه </label>
                                    <v-select name="column_id" v-model="form.column_id" :options="columns"
                                              :reduce="column=>column.id"
                                              @input="getCells"
                                    />

                                </div>
                                <div class="form-group   col-md-6  col-xs-12 ">
                                    <label> اسم الخلية التابعة للعمود </label>

                                    <v-select name="cell_id" v-model="form.cell_id" :options="cells"
                                              :reduce="cell=>cell.id"/>

                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label> الحجم </label><span
                                        class="asided-hint"> اختيارى ويكون بالسنتمتر المكعب</span>
                                    <input type="text" name="size" v-model="form.size" class="form-control"
                                           placeholder="الحجم"/>
                                </div>
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label> اللون </label><span class="asided-hint">اختيارى</span>
                                    <input type="text" name="color" v-model="form.color" class="form-control"
                                           placeholder="اللون"/>

                                </div>
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label> الارتفاع </label><span class="asided-hint">اختيارى ويكون بالسنتمتر</span>
                                    <input type="text" name="height" v-model="form.height" class="form-control"
                                           placeholder="الارتفاع"/>

                                </div>
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label> العرض </label><span
                                        class="asided-hint">اختيارى ويكون بالسنتمتر المربع</span>
                                    <input type="text" name="width" v-model="form.width" class="form-control"
                                           placeholder="العرض"/>

                                </div>
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label> تاريخ الانتهاء </label><span v-if="form.type!=='product_expiration'"
                                                                         class="asided-hint">اختيارى</span><span v-else
                                                                                                                 class="text-danger">*</span>
                                    <input type="text" name="expired_at" v-model="form.expired_at" class="form-control"
                                           placeholder="تاريخ الانتهاء"/>

                                </div>
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label>مده التنبية</label><span class="asided-hint">اختيارى</span>
                                    <input type="number" name="alert_duration" v-model="form.alert_duration"
                                           class="form-control" placeholder="مده التنبية"/>

                                </div>
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
                                    <label>عدد أيام فترة الركود</label><span class="asided-hint">اختيارى</span>
                                    <input type="number" name="num_days_recession" v-model="form.num_days_recession"
                                           class="form-control" placeholder="عدد أيام فترة الركود"/>


                                </div>

                            </div>
                        </tab-content>
                        <tab-content title="Last step">
                            <div>
                                <div class="row">

                                    <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left"
                                         id="nesba-wrp">
                                        <label> النسبة </label>
                                        <input name="percent" v-model="form.discount" palceholder="النسبة"
                                               class="form-control"/>
                                    </div>
                                    <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left "
                                         style="margin-top: 25px;">
                                        <button type="button" class="btn btn-primary" @click="addOffer">العروض
                                            والخصومات
                                        </button>
                                    </div>
                                    <div class="col-md-12 inside-form-tbl">
                                        <span>الخصومات</span>
                                        <table class="table table-bordered   table-responsive">
                                            <thead>
                                            <tr>
                                                <th> الكمية الاساسية</th>
                                                <th> الكمية الهدية</th>
                                                <th> العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(offer,index) of form.offers">
                                                <td>
                                                    <input class="form-control" :name="`offers[${index}][quantity]`"
                                                           v-model="offer.quantity"/>
                                                </td>
                                                <td>
                                                    <input class="form-control"
                                                           :name="`offers[${index}][gift_quantity]`"
                                                           v-model="offer.gift_quantity"/>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" type="button"><i
                                                            class="fas fa-trash"
                                                            @click="(e)=>{form.offers.splice(index,1)}"
                                                        ></i></button>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- end table-->
                                </div>
                                <div>
                                    <div class="row">
                                        <div
                                            class="form-group form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">

                                            <label>الضريبة</label>
                                            <span class="new-radio-wrap">
                                        <label for="yes1">يوجد ضريبة </label>
                                        <input type="radio" v-model="form.tax" :checked="form.tax" name="tax"  class="form-control"  required id="yes1" value="1">
                                    </span>
                                            <span class="new-radio-wrap">
                                        <label for="no1">لايوجد ضريبة</label>
                                        <input type="radio" v-model="form.tax" :checked="form.tax" name="tax"  class="form-control" id="no1" value="0">
                                    </span>

                                        </div>

                                    </div>

                                    <div v-if="form.tax==1" class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                <label>شمول الضريبة</label>
                                                <span class="new-radio-wrap">
                                        <label> السعر شامل الضريبة </label>
                                        <input type="radio" name="price_has_tax" required class="form-control"
                                               value="0" v-model="form.price_has_tax"/>
                                    </span>
                                                <span class="new-radio-wrap">
                                        <label>السعر غير شامل الضريبة </label>
                                        <input type="radio" name="price_has_tax" required class="form-control"
                                               value="1" v-model="form.price_has_tax">
                                    </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6" v-if="form.price_has_tax==0">
                                            <div class="">
                                                <label> اسم شريحة الضرائب</label>

                                                <v-select name="tax_band_id[]" :options="taxs" :reduce="o=>o.id"
                                                          v-model="form.taxs"
                                                          multiple/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tab-content>
                    </form-wizard>
                </div>
            </div>


            {{-- <div class="text-center col-md-12 m--margin-bottom-5">
                <div class="text-center">
                    <button type="submit" id="register" class="btn btn-success">حفظ <i
                            class="icon-arrow-left13 position-right"></i>
                    </button>
                </div>
            </div> --}}

        <!-- end table-->
            @section('scripts')

                <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
                        integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
                        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
                <link rel="stylesheet" href="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.min.css">

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
                <script src="https://unpkg.com/vue-select@latest"></script>
                <script src="https://unpkg.com/vue-form-wizard/dist/vue-form-wizard.js"></script>
                <script
                    src="https://cdn.jsdelivr.net/combine/npm/vuelidate@0.7.6/dist/validators.min.js,npm/vuelidate@0.7.6/dist/vuelidate.min.js">
                </script>
                <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js
"></script>
                <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>



                <script>
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "0",
                        "hideDuration": "0",
                        "timeOut": "0",
                        "extendedTimeOut": "0",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    }
                    Vue.component('v-select', VueSelect.VueSelect);
                    var app = new Vue({
                            el: '#app',
                            created() {

                                this.form.company_id = _.get(this.form, 'category.company.id');

                            },
                            mounted() {
                                this.getBranches();
                                // this.getStores();
                            },
                            data: {
                                components: [
                                    {
                                        'id': '',
                                        'name': 'اختار المنتجات'
                                    }
                                ],
                                products: [],
                                products_select: [],
                                form: @json($product),
                                categories: [],
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
                                stores: @json($stores),
                                columns: @json($columns),
                                cells: @json($cells),
                                offer: @json($offer_template),
                                product_type: [
                                    {
                                    id: "store",
                                    label: "مخزون",
                                },
                                    {
                                        id: "service",
                                        label: "خدمه",
                                    },
                                    /*
                                    {
                                        id: "offer",
                                        label: "مجموعة اصناف ",
                                    },
                                    */
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
                                onSearch: function (search, loading) {
                                    if (search.length) {
                                        loading(true);
                                        this.search(loading, search, this);
                                    }
                                },
                                addSubUnit: function () {
                                    this.form.sub_units.push({
                                        ...this.sub_unit
                                    });
                                },
                                addComponent: function () {
                                    this.form.components.push({
                                        ...this.component
                                    });

                                },
                                search: _.debounce((loading, search, vm) => {
                                    fetch(
                                        `/accounting/products-by-ajax?search=${search}`
                                    ).then(res => {

                                        res.json().then(json => (vm.components = json.data.data));
                                        loading(false);
                                    });
                                }, 350),
                                onComplete: function () {
                                    let that = this;
                                    let id = this.form.id;
                                    axios.put('/accounting/ajax/products/' + id, this.form)
                                        .then(function (resp) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: resp.data.message,
                                            });
                                            // that.form = {};
                                            that.$refs['form-wizard'].reset();
                                            // console.log('hi')
                                        })
                                        .catch(function (err) {
                                            console.log(err);
                                            errors = err.response.data.errors;
                                            //this code will get the first error message in side the erros object
                                            // first_error=errors[Object.keys(err.response.data.errors)[0]][0]
                                            console.log(errors)
                                            _.each(errors, function (item) {
                                                _.each(item, function (error) {
                                                    toastr["error"](error)
                                                })
                                            })

                                        })
                                    // alert('Yay. Done!');
                                },
                                getBranches: function () {
                                    var company_id = this.form.company_id;
                                    if (company_id != null)
                                        axios.get(`/accounting/ajax/company/${company_id}/branches`).then(response => {
                                            this.branches = response.data.branches;
                                            this.categories = response.data.categories;
                                        });
                                },
                                getStores: function () {
                                    var branch_id = this.form.branch_id;
                                    axios.get(`/accounting/ajax/branch/${branch_id}/stores`).then(response => {
                                        this.stores = response.data;
                                    });
                                },
                                getFaces: function () {
                                    var branch_id = this.form.branch_id;
                                    axios.get(`/accounting/ajax/branch/${branch_id}/faces`).then(response => {
                                        this.faces = response.data;
                                    });
                                },
                                getColumns: function () {
                                    var face_id = this.form.face_id;
                                    axios.get(`/accounting/ajax/face/${face_id}/columns`).then(response => {
                                        this.columns = response.data;
                                    });
                                },
                                getCells: function () {
                                    var column_id = this.form.column_id;
                                    axios.get(`/accounting/ajax/column/${column_id}/cells`).then(response => {
                                        this.columns = response.data;
                                    });
                                },
                                addOffer() {
                                    this.form.offers.push({
                                        ...this.offer
                                    });

                                },
                                deleteSubUnits(index) {
                                    axios.delete('/accounting/ajax/products/sub-units/' + this.form.sub_units[index].id).then(function (resp) {
                                        Swal.fire({
                                            title: resp.data.message,
                                            icon: "success"
                                        })
                                    })
                                    this.form.sub_units.splice(index, 1)

                                }
                            },
                        }
                    )
                </script>
            @endsection


            {!!Form::close() !!}
        </div>


    </div>
@endsection
