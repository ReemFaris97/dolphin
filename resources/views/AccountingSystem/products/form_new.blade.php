

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
            <form-wizard
            shape="tab"
            color="#2ECC71"

            >
  <tab-content title="Personal details"
             icon="fas fa-archive"  >

             <div class="row">
				<div class="form-group   col-md-6 col-xs-12 pull-left">
					<label>  <span class="text-danger">*</span> اسم المنتج باللغة العربيه </label>
                    <input name="product_name" v-model="form.product_name" class="form-control" placeholder="اسم المنتج باللغة العربية" required/>

                </div>
				<div class="form-group   col-md-6 col-xs-12 pull-left">
					<label>  <span class="text-danger">*</span> اسم المنتج باللغة الانجليزية </label>
                    <input name="en_name" v-model="form.en_name" class="form-control" placeholder="اسم المنتج باللغة الانجليزية" required/>

                </div>

				<div class="form-group  col-md-6 col-xs-12 ">
					<label> اسم التصنيف </label>

                    <div class="row">
               <div class="col-md-11">
                        <v-select  :options="categories"
                        v-model="form.category_id"
                        :reduce="(category)=>category.id"
                        :required="!form.category_id"
                        {{-- class="form-control" --}}
                        placeholder="اختر اسم التصنيف التابع له المنتج "

                     />
                    </div>
                     <div class="col-md-1">
                        <a class="btn btn-success" target="_blank" href="{{route('accounting.categories.create')}}"><i class="fas fa-plus"></i> </a>
                     </div>
            </div>
				</div>
				<div class="form-group  col-md-6 col-xs-12 ">
					<label> اسم المورد </label>
                    <div class="row">
                        <div class="col-md-11">
                                 <v-select  :options="suppliers"
                                 v-model="form.supplier_id"
                                 :reduce="(supplier)=>supplier.id"
                                 :required="!form.supplier_id"
                                 {{-- class="form-control" --}}
                                 placeholder="اختر اسم المورد للمنتج "

                              />
                             </div>
                              <div class="col-md-1">
                                 <a class="btn btn-success" target="_blank" href="{{route('accounting.suppliers.create')}}"><i class="fas fa-plus"></i> </a>
                              </div>
                     </div>
                    </div>


                    <div class="form-group  col-md-6 col-xs-12 ">
                        <label> نوع المنتج </label>
                                     <v-select  :options="product_type"
                                     v-model="form.type"
                                     :reduce="(type)=>type.id"
                                     :required="!form.type"
                                     {{-- class="form-control" --}}
                                     placeholder="اختر نوع للمنتج "
                                  />
                        </div>


                        <div class="form-group   col-md-6 col-xs-12 pull-left">
                            <label>  <span class="text-danger">*</span> وصف المنتج </label>
                            <textarea name="description" v-model="form.description" class="form-control">
                            </textarea>
                        </div>

                        <div class="form-group  col-md-6 col-xs-12 ">
                            <label> الوحدة الاساسية  </label>
                                         <v-select  :options="units"
                                         v-model="form.main_unit"
                                         :reduce="(main_unit)=>type.label"
                                         :required="!form.main_unit"
                                         {{-- class="form-control" --}}
                                         placeholder="اختر الوحدة الرئيسية "
                                      />
                            </div>


                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label>  <span class="text-danger">*</span> اسم المنتج باللغة الانجليزية </label>
                                <input type="file" name="image" v-model="form.image" class="form-control" />

                            </div>


                            <div class="row">
                                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper">
                                    <label>الحالة</label>
                                    <span class="new-radio-wrap">
                                        <label for="active">مفعل </label>
                                        {!! Form::radio("is_active",1,['class'=>'form-control','required','checked','id'=>'active'])!!}
                                        <input type="radio" name="is_active" id="active" checked  
                                        :value="1"
                                        v-model="form.is_active"
                                        class="form-control"/>
                                    </span>
                                    <span class="new-radio-wrap">
                                        <label for="dis_active">غير مفعل </label>
                                     
                                        <input type="radio" name="is_active" id="dis_active" checked  
                                        :value="0"
                                        v-model="form.is_active"
                                        class="form-control"/>
                                    </span>
                                </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label>  <span class="text-danger">*</span> سعر التكلفة</label>
                                <input type="number" name="product_purchasing_price" v-model="form.product_purchasing_price" class="form-control" />

                            </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label>  <span class="text-danger">*</span> سعر البيع</label>
                                <input type="number" name="product_selling_price" v-model="form.product_selling_price" class="form-control" />

                            </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label>  <span class="text-danger">*</span> الحد الادنى من الكمية</label>
                                <input type="number" name="min_quantity" v-model="form.min_quantity" class="form-control" />

                            </div>
                            <div class="form-group   col-md-6 col-xs-12 pull-left">
                                <label>  <span class="text-danger">*</span> الحد الاقصى من الكمية</label>
                                <input type="number" name="max_quantity" v-model="form.max_quantity" class="form-control" />

                            </div>

                            <div class="form-group  col-md-6 col-xs-12 ">
                                <label> اسم الشركة المصنعة </label>
            
                                <div class="row">
                           <div class="col-md-11">
                                    <v-select  :options="industrials"
                                    v-model="form.industry_id"
                                    :reduce="(industry)=>industry.id"
                                    :required="!form.category_id"
                                    {{-- class="form-control" --}}
                                    placeholder="اختر اسم الشركة المصنعة "
            
                                 />
                                </div>
                                 <div class="col-md-1">
                                    <a class="btn btn-success" target="_blank" href="{{route('accounting.industrials.create')}}"><i class="fas fa-plus"></i> </a>
                                 </div>
                        </div>
                            </div>
                        

             </div>



                </tab-content>
  <tab-content title="Additional Info"
               >
    My second tab content
  </tab-content>
  <tab-content title="Last step"
               >
    Yuhuuu! This seems pretty damn simple
  </tab-content>
{{--   <template slot="footer" slot-scope="props">
    <div class="wizard-footer-left">
        <wizard-button  v-if="props.activeTabIndex > 0 && !props.isLastStep" @click.native="props.prevTab()" :style="props.fillButtonStyle">Previous</wizard-button>
     </div>
     <div class="wizard-footer-right">
       <wizard-button v-if="!props.isLastStep"@click.native="props.nextTab()" class="wizard-footer-right" :style="props.fillButtonStyle">التالى</wizard-button>

       <wizard-button v-else @click.native="onComplete" class="wizard-footer-right finish-button" :style="props.fillButtonStyle">  @{{props.isLastStep ? 'Done' : 'Next'}}</wizard-button>
     </div>
</template> --}}
</form-wizard>
        </div>
      </div>

  </div>

	<div class="text-center col-md-12 m--margin-bottom-5">
			<div class="text-center">
				<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i>
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
<script src="https://cdn.jsdelivr.net/combine/npm/vuelidate@0.7.6/dist/validators.min.js,npm/vuelidate@0.7.6/dist/vuelidate.min.js"></script>

<script>

Vue.component('v-select', VueSelect.VueSelect);

var app = new Vue({
  el: '#app',

  data: {
    form: @json($product),
    categories:@json($categories??[]),
    suppliers:@json($suppliers??[]),
    units: @json($units??[]),
    industrials:@json($industrials??[]),
    taxs:@json($taxs),
    companies:@json(companies()),
    accounts:@json(accounts()),
    product_type:
    [
         {
            id:"store",
            label:"مخزون",
         },
         {
            id:"service",
            label:"خدمه",
         },
         {
            id:"offer",
            label:"مجموعة اصناف ",
         },
        {
            id:"creation",
            label:"تصنيع",
        },
        {
           id:"product_expiration",
           label:"منتج بتاريخ صلاحيه",
        },
    ]

  },
  methods: {
  onComplete: function(){
      alert('Yay. Done!');
   }
   }

})
</script>
@endsection
