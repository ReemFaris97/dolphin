@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="custom-tabs">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#home">بيانات المكان</a></li>
		<li><a data-toggle="tab" href="#menu1">بيانات المنتج</a></li>
		<li><a data-toggle="tab" href="#menu2">بيانات البيع</a></li>
		<li><a data-toggle="tab" href="#menu3">مواصفات أخرى (إختياري)</a></li>
		<li><a data-toggle="tab" href="#menu4"> الخصومات</a></li>
		<li><a data-toggle="tab" href="#menu5">الضريبه المضافة</a></li>
	</ul>
	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<div class="row">
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الشركة </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.companies.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة شركة
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له المنتج '])!!}
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الفرع التابع </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.branches.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة فرع
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','multiple','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left" id="store_id">
					<label> اسم المخزن </label>
					@if (!isset($product))
						<div class="btn-group adding-new-comp">
							<a href="{{route('accounting.stores.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة مخزن
						   <i class="fa fa-plus"></i>
						   </span>
							</a>
						</div>
					{!! Form::select("store_id",stores(),null,['class'=>'form-control js-example-basic-single store_id','id'=>'store_id','placeholder'=>' اختر اسم المخزن التابع له المنتج '])!!}
					@else
					<select class="form-control js-example-basic-single pull-right" name="store_id">
						@foreach ($stores as $store)
						@if ($product->store_id == $store->id)
						<option value="{{$store->id}}" selected>{{$store->ar_name}}</option>
						@else
						<option value="{{$store->id}}">{{$store->ar_name}}</option>
						@endif
						@endforeach
					</select>
					@endif
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الوجه </label>
					@if (!isset($product))
					{!! Form::select("face_id",faces(),null,['class'=>'form-control selectpicker face_id','id'=>'face_id','placeholder'=>' اختر وجه للمنتج '])!!}
					@else
					<select class="form-control js-example-basic-single pull-right" name="column_id">
						@foreach ($faces as $face)
						@if($product->cell_product->column->face_id == $face->id)
						<option value="{{$face->id}}" selected>{{$face->name}}</option>
						@else
						<option value="{{$face->id}}">{{$face->name}}</option>
						@endif
						@endforeach
					</select>
					@endif
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم العمود التابع للوجه </label>
					@if (!isset($product))
					{!! Form::select("column_id",colums(),null,['class'=>'form-control selectpicker column_id','id'=>'column_id','placeholder'=>' اختر عمود للمنتج '])!!}
					@else
					<select class="form-control js-example-basic-single pull-right" name="column_id">
						@foreach ($columns as $column)
						@if ($product->column_id == $column->id)
						<option value="{{$column->id}}" selected>{{$column->name}}</option>
						@else
						<option value="{{$column->id}}">{{$column->name}}</option>
						@endif
						@endforeach
					</select>
					@endif
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الخلية التابعة للعمود </label>
{{--					 {!! Form::text("cell",null,['class'=>'form-control','placeholder'=>'  ادخل اسم  الخلية  '])!!}--}}
					@if (!isset($product))
					{!! Form::select("cell_id",cells(),null,['class'=>'form-control selectpicker cell_id','id'=>'cell_id','placeholder'=>' اختر خلية للمنتج '])!!}
					@else
					<select class="form-control js-example-basic-single pull-right" name="cell_id">
						@foreach ($cells as $cell)
						@if ($product->cell_id==$cell->id)
						<option value="{{$cell->id}}" selected>{{$cell->name}}</option>
						@else
						<option value="{{$cell->id}}">{{$cell->name}}</option>
						@endif
						@endforeach
					</select>
					@endif
				</div>
			</div>
		</div>
		<div id="menu1" class="tab-pane fade">
			<div class="row">
				<div class=" col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>   اسم المنتج باللغة العربيه </label>
					{!! Form::text("product_name",isset($is_edit)?$product->name:null,['class'=>'form-control','placeholder'=>' اسم المنتج باللغة العربية '])!!}
				</div>
                </div>
                <div class=" col-md-6 col-sm-6 col-xs-12 pull-left">
                    <div class=" form-group">
                        <label>   اسم المنتج باللغة الانجليزية</label>
                        {!! Form::text("en_name",isset($is_edit)?$product->en_name:null,['class'=>'form-control','placeholder'=>'  اسم المنتج  باللغة الانجليزية'])!!}
                    </div>
                    </div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> اسم التصنيف </label>

					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.categories.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة تصنيف
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم التصنيف التابع له المنتج '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label> اسم المورد </label>
						<div class="btn-group adding-new-comp">
							<a href="{{route('accounting.suppliers.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة مورد
						   <i class="fa fa-plus"></i>
						   </span>
							</a>
						</div>
						{!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control js-example-basic-single','id'=>'supplier_id','placeholder'=>' اختر اسم المورد للمنتج '])!!}
					</div>
				</div>
				<div class="col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>النوع </label>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" id="components_button">
						المكونات
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" style="display: none;" id="offers_button">
						المنتجات التابعة
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5" style="display: none;" id="services_button">
						الخدمات
					</button>
					{!! Form::select("type",['store'=>'مخزون','service'=>'خدمه','offer'=>'مجموعة منتجات ','creation'=>'تصنيع','product_expiration'=>'منتج بتاريخ صلاحيه'],null,['class'=>'form-control js-example-basic-single type','placeholder'=>' نوع المنتج ','id'=>'type'])!!}
				</div>
				</div>
				<div class="col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>الوحدة الاساسية </label><span style="color: #ff0000; margin-right: 15px;">[جرام -كيلو-لتر]</span>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" id="openExampleModal" data-toggle="modal" data-target="#exampleModal">
						الوحدات الفرعية
					</button>
					{{--<input class="form-control autocomplete" placeholder="Enter A" />--}}
					{!! Form::text("main_unit",null,['class'=>'form-control autocomplete','placeholder'=>' الوحدة الاساسية '])!!}
				</div>
				</div>
				<div class="form-group col-xs-12 pull-left">
					<label>وصف المنتج </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>' وصف المنتج '])!!}
				</div>
				@if( isset($product))
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>صوره المنتج الحالية : </label>
					<img src="{{getimg($product->image)}}" style="width:100px; height:100px">
				</div>
				@endif
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>صوره المنتج: </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::file("image",null,['class'=>'form-control'])!!}
				</div>
				<!-- unit table-->
				<span> الوحدات الفرعيه </span>
				<table id="productsTable" class="table ">
					<thead>
						<tr>
							<th> اسم الوحده</th>
							<th>الباركود</th>
							<th>المقدارمن الوحدة الاساسية</th>
							<th>سعر البيع</th>
							<th>سعر الشراء</th>
							<th> الكمية</th>
							<th>العمليات</th>
						</tr>
					</thead>
					@if (isset($is_edit))
					<tbody class="add-products">
							@foreach($subunits as $unit)
								<tr>
									<td>{{$unit->name}}</td>
									<td>{{$unit->bar_code}}</td>
									<td>{{$unit->main_unit_present}}</td>
									<td>{{$unit->selling_price}}</td>
									<td>{{$unit->purchasing_price}}</td>
									<td>{{$unit->quantity}}</td>
									<td>
										<a href="#" onclick="Delete({{$unit->id}})" class="delete-sub-unit">حذف</a>
									</td>
								</tr>
							@endforeach
					</tbody>
					<tbody class="edit-products"></tbody>
					@else
					<tbody class="add-products"></tbody>
					@endif
				</table>
				<!-- services table-->
				<span> الخدمات </span>
				<table id="serviceTable" class="table ">
					<thead>
						<tr>
							<th>نوع الخدمة</th>
							<th>السعر</th>
							<th>الكود</th>
							<th>العمليات</th>
						</tr>
					</thead>
					<tbody class="add-services">
					</tbody>
				</table>
				<!-- component table-->
				<span> مكونات المنتجات </span>
				<table id="componentTable" class="table ">
					<thead>
						<tr>
							<th> اسم الصنف</th>
							<th>الكمية</th>
							<th>الوحدة الاساسية</th>
							<th>العمليات</th>
						</tr>
					</thead>
					<tbody class="add-components">
					</tbody>
				</table>
				<!-- end table-->
			</div>
		</div>
		<div id="menu2" class="tab-pane fade">
			<div class="row">
				<div class="form-group col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					<span class="new-radio-wrap">
						<label for="active">مفعل </label>
						{!! Form::radio("is_active",1,['class'=>'form-control','id'=>'active'])!!}
					</span>
					<span class="new-radio-wrap">
						<label for="dis_active">غير مفعل </label>
						{!! Form::radio("is_active",0,['class'=>'form-control','id'=>'dis_active'])!!}
					</span>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">

				<div class=" form-group">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" id="barcodes_button" data-toggle="modal" data-target="#ExampleModalBarcode">
                        اضاقه باركود اخر
                   </button>
					<label>الباركود </label>
					{!! Form::text("bar_code",null,['class'=>'form-control','placeholder'=>' الباركود '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>سعر البيع </label>
					{!! Form::text("product_selling_price",isset($is_edit)?$product->selling_price:null,['class'=>'form-control','placeholder'=>' سعر البيع '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>سعر الشراء </label>
					{!! Form::text("product_purchasing_price",isset($is_edit)?$product->purchasing_price:null,['class'=>'form-control','placeholder'=>'سعر الشراء '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>الحد الادنى من الكمية </label>
					{!! Form::text("min_quantity",null,['class'=>'form-control','placeholder'=>'الحد الادنى من الكمية'])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> الحد الاقصى من الكمية </label>
					{!! Form::text("max_quantity",null,['class'=>'form-control','placeholder'=>' الحد الاقصى من الكمية '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> الكمية </label>
					{!! Form::text("quantity",null,['class'=>'form-control','placeholder'=>' الكمية '])!!}
				</div>
				</div>
				<div class="col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> اسم الشركة المصنعة </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.industrials.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة شركة
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("industrial_id",$industrials,null,['class'=>'form-control js-example-basic-single','id'=>'industrial_id','placeholder'=>' اختر اسم الشركة المصنعة المنتج '])!!}
				</div>
				</div>
			</div>
		</div>
		<div id="menu3" class="tab-pane fade">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> الحجم </label><span style="color: #ff0000; margin-right: 15px;"> اختيارى ويكون بالسنتمتر المكعب</span>
					{!! Form::text("size",null,['class'=>'form-control','placeholder'=>' الحجم '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> اللون </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::text("color",null,['class'=>'form-control','placeholder'=>' اللون '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> الارتفاع </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر</span>
					{!! Form::text("height",null,['class'=>'form-control','placeholder'=>'الارتفاع '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> العرض </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر المربع</span>
					{!! Form::text("width",null,['class'=>'form-control','placeholder'=>' العرض '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> تاريخ الانتهاء </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::date("expired_at",null,['class'=>'form-control'])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>مده التنبية</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::number("alert_duration",null,['class'=>'form-control'])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label>عدد أيام فترة الركود</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::number("num_days_recession",null,['class'=>'form-control'])!!}
				</div>
				</div>

				@if (getsetting('automatic_products')==0)
					<div class="form-group col-md-6 pull-left">
						<label> اختر الحساب </label>
						{!! Form::select("account_id",accounts(),null,['class'=>'form-control','placeholder'=>' اختر الحساب'])!!}
					</div>

				@endif
			</div>

		</div>
		<div id="menu4" class="tab-pane fade">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left">
				<div class=" form-group">
					<label> نوع الخصم </label>
					{!! Form::select("discount_type",['percent'=>'نسبة','quantity'=>'كمية'],isset($discount)?$discount->discount_type:null,['class'=>'form-control js-example-basic-single','id'=>'discount_id','placeholder'=>' اختر الخصم '])!!}
				</div>
				</div>

				<div class="col-md-6 col-sm-6 col-xs-12 pull-left  " id="nesba-wrp">
				<div class=" form-group">
					<label> النسبة </label>
					{!! Form::text("percent",isset($discount)?$discount->percent:null,['class'=>'form-control','placeholder'=>' النسبة '])!!}
				</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 pull-left  " id="discounts_button">
				<div class=" form-group">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4" >
					العروض والخصومات
				</button>
				</div>
				</div>

			</div>

			<!--discounts table-->
			<table id="discountTable" class="table ">
				<thead>
				<tr>

					<th> الكمية الاساسية</th>
					<th> الكمية الهدية</th>
					<th>  العمليات</th>
				</tr>
				</thead>
				<tbody class="add-discounts">

				@if (isset($discounts))
				@foreach($discounts as $discount)
					@if ($discount->discount_type=="quantity")
				<tr>

						<td>{{$discount->quantity}}</td>
						<td>{{$discount->gift_quantity}}</td>
					<td></td>

				</tr>
					@endif
				@endforeach
				@endif

				</tbody>
			</table>
			<!-- end table-->
		</div>
		<div id="menu5" class="tab-pane fade">
			<div class="row">
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					{{--{!! Form::radio("tax",$has_tax,['class'=>'form-control','id'=>'yes1','value'=>==)!!}--}}
					@if (isset($is_edit))
						{{--@dd($product->discount_type)--}}
					<span class="new-radio-wrap">
						<label for="yes1">يوجد ضريبة </label>
						<input type="radio" name="tax" class="form-control" id="yes1" value={{($has_tax==1)?1:0}} {{($has_tax==1)?'checked':null }}>
					</span>
					<span class="new-radio-wrap">
						<label for="no1">لايوجد ضريبة</label>
						<input type="radio" name="tax" class="form-control" id="no1" value={{($has_tax==1)?0:1}} {{($has_tax==1)?null:'checked'}}>
					</span>
					@else
					<span class="new-radio-wrap">
						<label for="yes1">يوجد ضريبة </label>
						<input type="radio" name="tax" class="form-control" checked id="yes1" value="1">
					</span>
					<span class="new-radio-wrap">
						<label for="no1">لايوجد ضريبة</label>
						<input type="radio" name="tax" class="form-control" id="no1" value="0">
					</span>
					@endif
				</div>
				@if (isset($price_has_tax))

					<div id="shamel-mesh">
						<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left form-line new-radio-big-wrapper shamel-mesh">
						<span class="new-radio-wrap">
							<label > السعر شامل الضريبة </label>
							<input type="radio" name="price_has_tax"   class="form-control"  value={{($price_has_tax==1)?1:0}} {{($price_has_tax==1)?'checked':null }}>
						</span>
							<span class="new-radio-wrap">
							<label >السعر غير شامل الضريبة </label>
							<input type="radio" name="price_has_tax"  class="form-control"  value={{($price_has_tax==1)?0:1}} {{($price_has_tax==1)?null:'checked'}}>
						</span>
						</div>
						<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left prices_taxs">
							<label> اسم شريحة الضرائب</label>
							<div class="btn-group adding-new-comp">
								<a href="{{route('accounting.taxs.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة شريحة
						   <i class="fa fa-plus"></i>
						   </span>
								</a>
							</div>

							{!! Form::select("tax_band_id[]",$taxs,null,['class'=>'form-control selectpicker','multiple'])!!}
						</div>
					</div>
                 @else
				<div id="shamel-mesh">
					<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left form-line new-radio-big-wrapper shamel-mesh">
						<span class="new-radio-wrap">
							<label > السعر شامل الضريبة </label>
							<input type="radio" name="price_has_tax"   class="form-control"  value="1">
						</span>
						<span class="new-radio-wrap">
							<label >السعر غير شامل الضريبة </label>
							<input type="radio" name="price_has_tax"  class="form-control"  value="0">
						</span>
					</div>
					<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left prices_taxs">
						<label> اسم شريحة الضرائب</label>
                        <div class="btn-group adding-new-comp">
                            <a href="{{route('accounting.taxs.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						   إضافة شريحة
						   <i class="fa fa-plus"></i>
						   </span>
                            </a>
                        </div>
						{!! Form::select("tax_band_id[]",$taxs,null,['class'=>'form-control selectpicker','multiple'])!!}
					</div>
				</div>
				@endif

				@if (isset($is_edit))
					<table  class="table">
						<thead>
						<tr>
							<th> اسم الضريبه</th>
							<th> النسبه</th>

						</tr>
						</thead>
						<tbody>
						@foreach($taxsproduct as $tax)
							<tr>
								<td>{{$tax->Taxband->name}}</td>
								<td>{{$tax->Taxband->percent}}</td>

							</tr>
							@endforeach
						</tbody>
					</table>
					@endif


		</div>
	</div>
	<div class="text-center col-md-12 m--margin-bottom-5">
		<div class="text-center">
			<button type="submit" id="register" class="btn btn-success">حفظ <i class="icon-arrow-left13 position-right"></i>
			</button>
		</div>
	</div>
</div>
<!-- /collapsible with different panel styling -->
<!-- end table-->
<!-- end table-->

@include('AccountingSystem.products.modals')


@section('scripts')
	<script>
		$(document).ready(function() {
			$("#components_button").hide();
			$("#offers_button").hide();
			$("#discounts_button").hide();
			$(".percent").hide();

			$('.js-example-basic-single').select2();
			// $("#productsTable").hide();
			$("#componentTable").hide();
			$("#offerTable").hide();
			// $("#discountTable").hide();
			$("#serviceTable").hide();

			$('input[name="tax"]').click(function () {
				if ($(this).is(':checked')) {
					var id = $(this).val();
					// alert(id);
					if (id == 1) {
						$("#shamel-mesh").show();
						$(".prices_taxs").show();
					} else if (id == 0) {
						$("#shamel-mesh").hide();
						$(".prices_taxs").hide();
					}
				}
			});


			$("button#openExampleModal").click(function(){
				$("#exampleModal").find("input,textarea,select").val('');
				$("#exampleModal").find("input[type=checkbox], input[type=radio]").prop("checked", "");
			})

		});

		var bigData = [];
		var bigDataComponent = [];
		var bigDataOffer = [];
		var bigDataDiscount = [];
		var bigDataService = [];
        var bigDataBarcode = [];


		$(function() {
			var availableTags = <?php echo $units; ?>;
			$(".autocomplete").autocomplete({
				source: availableTags
			});
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
	<script src="{{asset('admin/assets/js/get_faces_by_branch.js')}}"></script>
	<script src="{{asset('admin/assets/js/get_cells_by_column.js')}}"></script>
	<script src="{{asset('admin/assets/js/get_columns_by_face.js')}}"></script>
	<script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
	<script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
	<script src="{{asset('admin/assets/js/creation.js')}}"></script>
	<script src="{{asset('admin/assets/js/services.js')}}"></script>
	<script src="{{asset('admin/assets/js/offer.js')}}"></script>
	<script src="{{asset('admin/assets/js/discount.js')}}"></script>
	<script src="{{asset('admin/assets/js/tax.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun2.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun3.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun4.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun5.js')}}"></script>
    <script src="{{asset('admin/assets/js/productFunction/myFun6.js')}}"></script>


@endsection
