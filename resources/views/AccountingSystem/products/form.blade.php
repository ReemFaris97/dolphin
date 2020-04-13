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
		<li><a data-toggle="tab" href="#menu4">العروض والخصومات</a></li>
		<li><a data-toggle="tab" href="#menu5">الضريبه المضافة</a></li>
	</ul>
	<div class="tab-content">
		<div id="home" class="tab-pane fade in active">
			<div class="row">
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الشركة </label>
					{!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له المنتج '])!!}
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الفرع التابع </label>
					{!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','multiple','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
				</div>
				<div class="form-group col-md-4 col-sm-6 col-xs-12 pull-left" id="store_id">
					<label> اسم المخزن </label>
					@if (!isset($product))
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
					{{-- @dd($product->cell()->first()->column->face_id) --}}
					<select class="form-control js-example-basic-single pull-right" name="column_id">
						@foreach ($faces as $face)
						@if($product->cell()->first()->column->face_id == $face->id)
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
					{{-- {!! Form::text("cell",null,['class'=>'form-control','placeholder'=>'  ادخل اسم  الخلية  '])!!} --}}
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
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>اسم المنتج </label>
					{!! Form::text("name_product",isset($is_edit)?$product->name:null,['class'=>'form-control','placeholder'=>' اسم المنتج '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> اسم التصنيف </label>
					{!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم التصنيف التابع له المنتج '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
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
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>الوحدة الاساسية </label><span style="color: #ff0000; margin-right: 15px;">[جرام -كيلو-لتر]</span>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						الوحدات الفرعية
					</button>
					{{--<input class="form-control autocomplete" placeholder="Enter A" />--}}
					{!! Form::text("main_unit",null,['class'=>'form-control autocomplete','placeholder'=>' الوحدة الاساسية '])!!}
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
					<tbody class="add-products">
					{{--@dd($subunits)--}}
						@if (isset($is_edit))
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
						@endif
					</tbody>
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
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					<span class="new-radio-wrap">
						<label for="active">مفعل </label>
						{!! Form::radio("is_active",1,['class'=>'form-control','id'=>'active'])!!}
					</span>
					<span class="new-radio-wrap">
						<label for="dis_active">غير مفعل </label>
						{!! Form::radio("is_active",0,['class'=>'form-control','id'=>'dis_active'])!!}
					</span>
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>الباركود </label>
					{!! Form::text("bar_code",null,['class'=>'form-control','placeholder'=>' الباركود '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>سعر البيع </label>
					{!! Form::text("product_selling_price",isset($is_edit)?$product->selling_price:null,['class'=>'form-control','placeholder'=>' سعر البيع '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>سعر الشراء </label>
					{!! Form::text("product_purchasing_price",isset($is_edit)?$product->purchasing_price:null,['class'=>'form-control','placeholder'=>'سعر الشراء '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>الحد الادنى من الكمية </label>
					{!! Form::text("min_quantity",null,['class'=>'form-control','placeholder'=>'الحد الادنى من الكمية'])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> الحد الاقصى من الكمية </label>
					{!! Form::text("max_quantity",null,['class'=>'form-control','placeholder'=>' الحد الاقصى من الكمية '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> الكمية </label>
					{!! Form::text("quantity",null,['class'=>'form-control','placeholder'=>' الكمية '])!!}
				</div>
				<div class="form-group col-xs-12 pull-left">
					<label> اسم الشركة المصنعة </label>
					{!! Form::select("industrial_id",$industrials,null,['class'=>'form-control js-example-basic-single','id'=>'industrial_id','placeholder'=>' اختر اسم الشركة المصنعة المنتج '])!!}
				</div>
			</div>
		</div>
		<div id="menu3" class="tab-pane fade">
			<div class="row">
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> الحجم </label><span style="color: #ff0000; margin-right: 15px;"> اختيارى ويكون بالسنتمتر المكعب</span>
					{!! Form::text("size",null,['class'=>'form-control','placeholder'=>' الحجم '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> اللون </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::text("color",null,['class'=>'form-control','placeholder'=>' اللون '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> الارتفاع </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر</span>
					{!! Form::text("height",null,['class'=>'form-control','placeholder'=>'الارتفاع '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> العرض </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر المربع</span>
					{!! Form::text("width",null,['class'=>'form-control','placeholder'=>' العرض '])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> تاريخ الانتهاء </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::date("expired_at",null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>مده التنبية</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::number("alert_duration",null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label>عدد أيام فترة الركود</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::number("num_days_recession",null,['class'=>'form-control'])!!}
				</div>
			</div>
			<!--discounts table-->
			<table id="discountTable" class="table ">
				<thead>
					<tr>
						<th>  نوع العرض</th>
						<th> الكمية الاساسية</th>
						<th> الكمية الهدية</th>

					</tr>
				</thead>
				<tbody>

				@if (isset($is_edit))
					@foreach($discounts as $discount)
						<tr>
							@if ($discount->discount_type=="quantity")
								<td>هدية</td>
								@else
								<td>خصم نسبه</td>
							@endif
							<td>{{$unit->quantity}}</td>
							<td>{{$unit->gift_quantity}}</td>
							<td>{{$unit->quantity}}</td>
							<td>{{$unit->percent}}</td>
						</tr>
					@endforeach
				@endif

				</tbody>
			</table>
			<!-- end table-->
		</div>
		<div id="menu4" class="tab-pane fade">
			<div class="row">
				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left">
					<label> نوع الخصم </label>
					{!! Form::select("discount_type",['percent'=>'نسبة','quantity'=>'كمية'],isset($is_edit)?$product->discount_type:null,['class'=>'form-control js-example-basic-single','id'=>'discount_id','placeholder'=>' اختر الخصم '])!!}
				</div>

				<div class="form-group col-md-6 col-sm-6 col-xs-12 pull-left ">
					<label> النسبة </label>
					{!! Form::text("percent",isset($is_edit)?$product->percent:null,['class'=>'form-control','placeholder'=>' النسبة '])!!}
				</div>
				{{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4" id="discounts_button">--}}
					{{--العروض والخصومات--}}
				{{--</button>--}}
			</div>
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
				@if (isset($is_edit))

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
<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">الوحدات الفرعية</h5>
				<button type="button" class="close" id="the-sub-unit-link" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label> اسم الوحده</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-name" id="name" required>
				<label> باركود</label>
				<input type="text" class="form-control the-unit-bar" id="par_code" required>
				<label>مقدارها بالنسبة للوحده الاساسية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-pre" id="main_unit_present" required>
				<label> سعرالبيع</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-spri" id="selling_price" required>
				<label>سعر الشراء</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-ppri" id="purchasing_price" required>
				<label> الكميه</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-quantity" id="quantity" required>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary" id="subunit" onclick="myFun(event)" data-dismiss="modal">اضافة الوحده</button>
			</div>
		</div>
	</div>
</div>
<!-- end model1-->
<!-- Modal2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> مكونات التصنيع</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label> اسم المكون</label>
				<span class="required--in">*</span>
				{!! Form::select("product_id",products(),null,['class'=>'form-control js-example-basic-single','id'=>'component_name','placeholder'=>' اختر اسم الشركة التابع له الوجه '])!!}
				<label> الكمية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="component_quantity">
				<label> الوحده الاساسية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="main_unit" value="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary"  data-dismiss="modal" onclick="myFun2(event)">اضافة المكونات للمنتج</button>
			</div>
		</div>
	</div>
</div>
<!-- end model2-->
<!-- Modal3 -->
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> المنتجات التابعة</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label> اسم المنتج</label>
				{!! Form::select("child_product",products(),null,['class'=>'form-control js-example-basic-single','id'=>'child_product','placeholder'=>' اختر اسم المنتج التابع '])!!}
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary" id="offer" data-dismiss="modal" onclick="myFun3(event)"> اضافة المنتج</button>
			</div>
		</div>
	</div>
</div>
<!-- end model3-->
<!-- Modal4 -->
<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> العروض والخصومات</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label> الكمية الاساسية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="basic_quantity">
				<label> الكمية الهدية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="gift_quantity" value="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary" id="subunit" data-dismiss="modal" onclick="myFun4(event)">اضافة الخصم</button>
			</div>
		</div>
	</div>
</div>
<!-- end model4-->
<!-- Modal5 -->
<div class="modal fade" id="exampleModal5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel"> خدمات الصنف</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<span class="required--in">*</span>
				{{-- {!! Form::select("type",['Delivery'=>'توصيل','composing'=>'تركيب','maintenance'=>'صيانة'],null,['class'=>'form-control js-example-basic-single','id'=>'service_type','placeholder'=>' اختر  خدمة الصنف '])!!} --}}
				<label>السعر</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="sevices_price">
				<label> الكود</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="sevices_code" value="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary" id="subunit" data-dismiss="modal" onclick="myFun5(event)">اضافة خدمات</button>
			</div>
		</div>
	</div>
</div>
<!-- end model5-->
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

			// $('input[name="price_has_tax"]').click(function() {
			// 	if ($(this).is(':checked')) {
			// 		var id = $(this).val();
			//
			// 		if (id == 1) {
			// 			$(".prices_taxs").show();
			// 		} else if (id == 0) {
			// 			$(".prices_taxs").show();
			// 		}
			// 	}
			// // });

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


		});
		var bigData = [];
		var bigDataComponent = [];
		var bigDataOffer = [];
		var bigDataDiscount = [];
		var bigDataService = [];
		function myFun(event) {
			event.preventDefault();
			var data = {};
			data.par_code = $('#par_code').val();
			data.name = $('#name').val();
			data.main_unit_present = $('#main_unit_present').val();
			data.selling_price = $('#selling_price').val();
			data.purchasing_price = $('#purchasing_price').val();
			data.quantity = $('#quantity').val();
			if (data.name !== '' && data.main_unit_present !== '' && data.selling_price !== '' && data.purchasing_price !== '') {
				$("tr.editted-row").remove();
				swal({
					title: "تم إضافة الوحدة الفرعية بنجاح",
					text: "",
					timer: 3000,
					icon: "success",
					buttons: ["موافق"],
					dangerMode: true,
				})
				bigData.push(data);
				$("#productsTable").show();
				var appendProducts = bigData.map(function(product) {
					return (`
                <tr class="single-product">
                    <td class="prod-nam">${product.name}</td>
                    <td class="prod-bar">${product.par_code}</td>
                    <td class="prod-pre">${product.main_unit_present}</td>
                    <td class="prod-spri">${product.selling_price}</td>
                    <td class="prod-ppri">${product.purchasing_price}</td>
                    <td class="prod-quantity">${product.quantity}</td>
   					<td>
						<a href="#" data-toggle="modal" class="edit-this-row" data-target="#exampleModal" data-original-title="تعديل">
							<i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
						</a>
						<a href="#" data-toggle="tooltip" class="delete-this-row" data-original-title="حذف">
							<i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
						</a>
                    </td>
            <input type="hidden" name="name[]" value="${product.name}" >
            <input type="hidden" name="par_codes[]" value="${product.par_code}" >
            <input type="hidden"name="main_unit_present[]" value="${product.main_unit_present}" >
            <input type="hidden" name="selling_price[]" value="${product.selling_price}" >
            <input type="hidden"name="purchasing_price[]"  value="${product.purchasing_price}" >
            <input type="hidden"name="unit_quantities[]"  value="${product.quantity}" >
                </tr>
                `);
				});
				$('.add-products').empty().append(appendProducts);
				$('.delete-this-row').click(function(e) {
					var $this = $(this);
					var row_index = $(this).parents('tr').index();
					e.preventDefault();
					swal({
						title: "هل أنت متأكد ",
						text: "هل تريد حذف هذة الوحدة الفرعية ؟",
						icon: "warning",
						buttons: ["الغاء", "موافق"],
						dangerMode: true,
					}).then(function(isConfirm) {
						if (isConfirm) {
							$this.parents('tr').remove();
							bigData.splice(row_index, 1);
						} else {
							swal("تم االإلفاء", "حذف  الوحدة الفرعية  تم الغاؤه", 'info', {
								buttons: 'موافق'
							});
						}
					});
				});
				$('.edit-this-row').click(function(e) {
					var $this = $(this);
					e.preventDefault();
					$this.parents('tr').addClass('editted-row');
					$('#exampleModal #name').val($this.parents('tr').find('.prod-nam').html());
					$('#exampleModal #par_code').val($this.parents('tr').find('.prod-bar').html());
					$('#exampleModal #main_unit_present').val($this.parents('tr').find('.prod-pre').html());
					$('#exampleModal #selling_price').val($this.parents('tr').find('.prod-spri').html());
					$('#exampleModal #purchasing_price').val($this.parents('tr').find('.prod-ppri').html());
					var row_index_edit = $(this).parents('tr').index();
					bigData.splice(row_index_edit, 1);
				});
				document.getElementById("name").val = " ";
				$('[data-dismiss=modal]').on('click', function(e) {
					var $t = $(this),
							target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
					$(target)
							.find("input,textarea,select")
							.val('')
							.end()
							.find("input[type=checkbox], input[type=radio]")
							.prop("checked", "")
							.end();
				})
			} else {
				swal({
					title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
					text: "",
					icon: "warning",
					buttons: ["موافق"],
					dangerMode: true,
				})
			}
		}
		function myFun2(event) {
			event.preventDefault();
			var component_data = {};
			component_data.component_name = $('#component_name option:selected').text();
			component_data.component_name_val = $('#component_name').val();
			component_data.component_quantity = $('#component_quantity').val();
			component_data.main_unit = $('#main_unit').val();
			if (component_data.component_name !== '' && component_data.component_quantity !== '' && component_data.main_unit !== '') {
				$("tr.editted-row").remove();
				swal({
					title: "تم إضافة  المكون بنجاح",
					text: "",
					icon: "success",
					buttons: ["موافق"],
					dangerMode: true,
				})
				bigDataComponent.push(component_data);
				$("#componentTable").show();
				var appendComponent = bigDataComponent.map(function(component) {
					return (`
					<tr class="single-product">
						<td class="component-name">${component.component_name}</td>
						<td class="component-qty">${component.component_quantity}</td>
						<td class="component-unit">${component.main_unit}</td>
	                  <td>
						<a href="#" data-toggle="modal" class="edit-this-row-component" data-target="#exampleModal2" data-original-title="تعديل">
							<i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
						</a>
						<a href="#" data-toggle="tooltip" class="delete-this-row-component" data-original-title="حذف">
							<i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
						</a>
                    </td>
				<input type="hidden" name="component_names[]" value="${component.component_name_val}" >
				<input type="hidden" name="qtys[]" value="${component.component_quantity}" >
				<input type="hidden"name="main_units[]" value="${component.main_unit}" >
					</tr>
					`);
				});
				$('.add-components').empty().append(appendComponent);
				//////////////////////////////////////////////////////////////////////
				$('.delete-this-row-component').click(function(e) {
					var $this = $(this);
					var row_index_component = $(this).parents('tr').index();
					e.preventDefault();
					swal({
						title: "هل أنت متأكد ",
						text: "هل تريد حذف هذا  المكون؟",
						icon: "warning",
						buttons: ["الغاء", "موافق"],
						dangerMode: true,
					}).then(function(isConfirm) {
						if (isConfirm) {
							$this.parents('tr').remove();
							bigDataComponent.splice(row_index_component, 1);
						} else {
							swal("تم االإلفاء", "حذف  المكون تم الغاؤه", 'info', {
								buttons: 'موافق'
							});
						}
					});
				});
				$('.edit-this-row-component').click(function(e) {
					var $this = $(this);
					e.preventDefault();
					$this.parents('tr').addClass('editted-row');
					$('#exampleModal2 #component_name').val($('.component_name option:selected').text());
					$('#exampleModal2 #component_quantity').val($this.parents('tr').find('.component-qty').html());
					$('#exampleModal2 #main_unit').val($this.parents('tr').find('.component-unit').html());
					var row_index_edit_component = $(this).parents('tr').index();
					bigDataComponent.splice(row_index_edit_component, 1);
				});
				document.getElementById("name").val = " ";
				$('[data-dismiss=modal]').on('click', function(e) {
					var $t = $(this),
							target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
					$(target)
							.find("input,textarea,select")
							.val('')
							.end()
							.find("input[type=checkbox], input[type=radio]")
							.prop("checked", "")
							.end();
				})
			} else {
				swal({
					title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
					text: "",
					icon: "warning",
					buttons: ["موافق"],
					dangerMode: true,
				})
			} ///if_end
		}
		function myFun3(event) {

		// console.log(event);
			event.preventDefault();
			var offer_data = {};
			offer_data.child_product = $('#child_product option:selected').text();
			offer_data.child_product_val = $('#child_product').val();
			if (offer_data.child_product !== '') {
				$("tr.editted-row").remove();
				swal({
					title: "تم إضافة  المنتج التابع بنجاح",
					text: "",
					icon: "success",
					buttons: ["موافق"],
					dangerMode: true,
				})
				bigDataOffer.push(offer_data);
				$("#offerTable").show();
				var appendOffer = bigDataOffer.map(function(offer) {
					return (`
					<tr class="single-product">
						<td class="child_product">${offer.child_product}</td>
	                  <td>
						<a href="#" data-toggle="modal" class="edit-this-row-offer" data-target="#exampleModal3" data-original-title="تعديل">
							<i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
						</a>
						<a href="#" data-toggle="tooltip" class="delete-this-row-offer" data-original-title="حذف">
							<i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
						</a>
                    </td>
				<input type="hidden" name="offers[]" value="${offer.child_product_val}" >
					</tr>
					`);
				});
				$('.add-offers').empty().append(appendOffer);
				//////////////////////////////////////////////////////////////////////
				$('.delete-this-row-offer').click(function(e) {
					var $this = $(this);
					var row_index_offer = $(this).parents('tr').index();
					e.preventDefault();
					swal({
						title: "هل أنت متأكد ",
						text: "هل تريد حذف هذا  المنتج؟",
						icon: "warning",
						buttons: ["الغاء", "موافق"],
						dangerMode: true,
					}).then(function(isConfirm) {
						if (isConfirm) {
							$this.parents('tr').remove();
							bigDataOffer.splice(row_index_offer, 1);
						} else {
							swal("تم االإلفاء", "حذف  المنتج تم الغاؤه", 'info', {
								buttons: 'موافق'
							});
						}
					});
				});
				$('.edit-this-row-offer').click(function(e) {
					var $this = $(this);
					e.preventDefault();
					$this.parents('tr').addClass('editted-row');
					$('#exampleModal3 #child_product').val($('.child_product option:selected').text());
					var row_index_edit_offer = $(this).parents('tr').index();
					bigDataOffer.splice(row_index_edit_offer, 1);
				});
				document.getElementById("name").val = " ";
				$('[data-dismiss=modal]').on('click', function(e) {
					var $t = $(this),
							target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
					$(target)
							.find("input,textarea,select")
							.val('')
							.end()
							.find("input[type=checkbox], input[type=radio]")
							.prop("checked", "")
							.end();
				})
			} else {
				swal({
					title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
					text: "",
					icon: "warning",
					buttons: ["موافق"],
					dangerMode: true,
				})
			} ///if_end
		}
		function myFun4(event) {
			event.preventDefault();
			var discount_data = {};
			discount_data.basic_quantity = $('#basic_quantity').val();
			discount_data.gift_quantity = $('#gift_quantity').val();
			if (discount_data.basic_quantity !== '' && discount_data.gift_quantity !== '') {
				$("tr.editted-row").remove();
				swal({
					title: "تم إضافة  الخصم بنجاح",
					text: "",
					icon: "success",
					buttons: ["موافق"],
					dangerMode: true,
				})
				bigDataDiscount.push(discount_data);
				$("#discountTable").show();
				var appendDiscount = bigDataDiscount.map(function(discount) {
					return (`
					<tr class="single-product">
						<td class="discount-basic_quantity">${discount.basic_quantity}</td>
						<td class="discount-gift_quantity">${discount.gift_quantity}</td>
	                  <td>
						<a href="#" data-toggle="modal" class="edit-this-row-discount" data-target="#exampleModal4" data-original-title="تعديل">
							<i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
						</a>
						<a href="#" data-toggle="tooltip" class="delete-this-row-discount" data-original-title="حذف">
							<i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
						</a>
                    </td>
				<input type="hidden" name="basic_quantity[]" value="${discount.basic_quantity}" >
				<input type="hidden" name="gift_quantity[]" value="${discount.gift_quantity}" >
					</tr>
					`);
				});
				$('.add-discounts').empty().append(appendDiscount);
				//////////////////////////////////////////////////////////////////////
				$('.delete-this-row-discount').click(function(e) {
					var $this = $(this);
					var row_index_discount = $(this).parents('tr').index();
					e.preventDefault();
					swal({
						title: "هل أنت متأكد ",
						text: "هل تريد حذف هذا  الخصم؟",
						icon: "warning",
						buttons: ["الغاء", "موافق"],
						dangerMode: true,
					}).then(function(isConfirm) {
						if (isConfirm) {
							$this.parents('tr').remove();
							bigDataDiscount.splice(row_index_discount, 1);
						} else {
							swal("تم االإلفاء", "حذف  الخصم تم الغاؤه", 'info', {
								buttons: 'موافق'
							});
						}
					});
				});
				$('.edit-this-row-discount').click(function(e) {
					var $this = $(this);
					e.preventDefault();
					$this.parents('tr').addClass('editted-row');
					$('#exampleModal4 #basic_quantity').val($this.parents('tr').find('.basic_quantity').html());
					$('#exampleModal4 #gift_quantity').val($this.parents('tr').find('.gift_quantity').html());
					var row_index_discount = $(this).parents('tr').index();
					bigDataDiscount.splice(row_index_discount, 1);
				});
				document.getElementById("name").val = " ";
				$('[data-dismiss=modal]').on('click', function(e) {
					var $t = $(this),
							target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
					$(target)
							.find("input,textarea,select")
							.val('')
							.end()
							.find("input[type=checkbox], input[type=radio]")
							.prop("checked", "")
							.end();
				})
			} else {
				swal({
					title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
					text: "",
					icon: "warning",
					buttons: ["موافق"],
					dangerMode: true,
				})
			} ///if_end
		}
		function myFun5(event) {
			event.preventDefault();
			var service_data = {};
			service_data.service_type = $('#service_type option:selected').text();
			service_data.service_type_type = $('#service_type').val();
			service_data.sevices_price = $('#sevices_price').val();
			service_data.sevices_code = $('#sevices_code').val();
			if (service_data.sevices_price !== '' && service_data.sevices_code !== '') {
				$("tr.editted-row").remove();
				swal({
					title: "تم إضافة  الخدمة بنجاح",
					text: "",
					icon: "success",
					buttons: ["موافق"],
					dangerMode: true,
				})
				bigDataService.push(service_data);
				$("#serviceTable").show();
				var appendService = bigDataService.map(function(service) {
					return (`
					<tr class="single-product">
                    	<td class="service-service_type">${service.service_type}</td>
						<td class="service-sevices_price">${service.sevices_price}</td>
						<td class="service-sevices_code">${service.sevices_code}</td>
	                  <td>
						<a href="#" data-toggle="modal" class="edit-this-row-service" data-target="#exampleModal5" data-original-title="تعديل">
							<i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
						</a>
						<a href="#" data-toggle="tooltip" class="delete-this-row-service" data-original-title="حذف">
							<i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
						</a>
                    </td>
				<input type="hidden" name="service_type[]" value="${service.service_type}" >
				<input type="hidden" name="sevices_price[]" value="${service.sevices_price}" >
				<input type="hidden" name="sevices_code[]" value="${service.sevices_code}" >
					</tr>
					`);
				});
				$('.add-services').empty().append(appendService);
				//////////////////////////////////////////////////////////////////////
				$('.delete-this-row-service').click(function(e) {
					var $this = $(this);
					var row_index_service = $(this).parents('tr').index();
					e.preventDefault();
					swal({
						title: "هل أنت متأكد ",
						text: "هل تريد حذف هذا  الخدمة؟",
						icon: "warning",
						buttons: ["الغاء", "موافق"],
						dangerMode: true,
					}).then(function(isConfirm) {
						if (isConfirm) {
							$this.parents('tr').remove();
							bigDataService.splice(row_index_service, 1);
						} else {
							swal("تم االإلفاء", "حذف  الخدمة تم الغاؤه", 'info', {
								buttons: 'موافق'
							});
						}
					});
				});
				$('.edit-this-row-service').click(function(e) {
					var $this = $(this);
					e.preventDefault();
					$this.parents('tr').addClass('editted-row');
					$('#exampleModal5 #sevice_type').val($this.parents('tr').find('.sevice_type').html());
					$('#exampleModal5 #sevices_price').val($this.parents('tr').find('.sevices_price').html());
					$('#exampleModal5 #sevices_code').val($this.parents('tr').find('.sevices_code').html());
					var row_index_service = $(this).parents('tr').index();
					bigDataService.splice(row_index_service, 1);
				});
				document.getElementById("name").val = " ";
				$('[data-dismiss=modal]').on('click', function(e) {
					var $t = $(this),
							target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
					$(target)
							.find("input,textarea,select")
							.val('')
							.end()
							.find("input[type=checkbox], input[type=radio]")
							.prop("checked", "")
							.end();
				})
			} else {
				swal({
					title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
					text: "",
					icon: "warning",
					buttons: ["موافق"],
					dangerMode: true,
				})
			} ///if_end
		}
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
@endsection
