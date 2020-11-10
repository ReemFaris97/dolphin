@section('styles')
@endsection
@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif
<div class="custom-tabs tabs-2020">
		<div>
			<div class="row">
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الشركة </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.companies.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						    شركة
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','required','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له المنتج '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الفرع التابع </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.branches.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						    فرع
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','required','multiple','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left" id="store_id">
					<label> اسم المخزن </label>
					@if (!isset($product))
						<div class="btn-group adding-new-comp">
							<a href="{{route('accounting.stores.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						    مخزن
						   <i class="fa fa-plus"></i>
						   </span>
							</a>
						</div>
					{!! Form::select("store_id",stores(),null,['class'=>'form-control js-example-basic-single store_id','id'=>'store_id','required','placeholder'=>' اختر اسم المخزن التابع له المنتج '])!!}
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
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الوجه </label>
					@if (!isset($product))
					{!! Form::select("face_id",faces(),null,['class'=>'form-control selectpicker face_id','id'=>'face_id','required','placeholder'=>' اختر وجه للمنتج '])!!}
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
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم العمود التابع للوجه </label>
					@if (!isset($product))
					{!! Form::select("column_id",colums(),null,['class'=>'form-control selectpicker column_id','id'=>'column_id','required','placeholder'=>' اختر عمود للمنتج '])!!}
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
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم الخلية التابعة للعمود </label>
{{--					 {!! Form::text("cell",null,['class'=>'form-control','placeholder'=>'  ادخل اسم  الخلية  '])!!}--}}
					@if (!isset($product))
					{!! Form::select("cell_id",cells(),null,['class'=>'form-control selectpicker cell_id','id'=>'cell_id','required','placeholder'=>' اختر خلية للمنتج '])!!}
					@else
					<select class="form-control js-example-basic-single pull-right" required="" name="cell_id">
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
		<div>
			<div class="row">
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>   اسم المنتج باللغة العربيه </label>
					{!! Form::text("product_name",isset($is_edit)?$product->name:null,['class'=>'form-control','required','placeholder'=>' اسم المنتج باللغة العربية '])!!}
                </div>
                <div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>   اسم المنتج باللغة الانجليزية</label><span class="asided-hint">اختيارى</span>
					{!! Form::text("en_name",isset($is_edit)?$product->en_name:null,['class'=>'form-control','placeholder'=>'  اسم المنتج  باللغة الانجليزية'])!!}
                </div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم التصنيف </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.categories.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						    تصنيف
						   <i class="fa fa-plus"></i>
						   </span>
						</a>
					</div>
					{!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','required','placeholder'=>' اختر اسم التصنيف التابع له المنتج '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اسم المورد </label>
					<div class="btn-group adding-new-comp">
						<a href="{{route('accounting.suppliers.create')}}" class="btn btn-success" target="_blank">
					  <span class="m-l-5">
					    مورد
					   <i class="fa fa-plus"></i>
					   </span>
						</a>
					</div>
					{!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control js-example-basic-single','id'=>'supplier_id','required','placeholder'=>' اختر اسم المورد للمنتج '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>النوع </label>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" style="display: none;" id="components_button">
						المكونات
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" style="display: none;" id="offers_button">
						المنتجات التابعة
					</button>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal5" style="display: none;" id="services_button">
						الخدمات
					</button>
					{!! Form::select("type",['store'=>'مخزون','service'=>'خدمه','offer'=>'مجموعة منتجات ','creation'=>'تصنيع','product_expiration'=>'منتج بتاريخ صلاحيه'],null,['class'=>'form-control js-example-basic-single type','required','placeholder'=>' نوع المنتج ','id'=>'type'])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>الوحدة الاساسية </label><span class="asided-hint">[جرام -كيلو-لتر]</span>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" id="openExampleModal" data-toggle="modal" data-target="#exampleModal">
						الوحدات الفرعية
					</button>
					{{--<input class="form-control autocomplete" placeholder="Enter A" />--}}
					{!! Form::text("main_unit",null,['class'=>'form-control autocomplete','required','placeholder'=>' الوحدة الاساسية '])!!}
				</div>
				<div class="form-group col-lg-3 col-md-8 col-sm-6 col-xs-12 pull-left">
					<label>وصف المنتج </label><span class="asided-hint">اختيارى</span>
					{!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>' وصف المنتج '])!!}
				</div>
				@if( isset($product))
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>صوره المنتج الحالية : </label>
					<img src="{{getimg($product->image)}}" style="width:100px; height:100px">
				</div>
				@endif
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>صوره المنتج: </label><span class="asided-hint">اختيارى</span>
					{!! Form::file("image",null,['class'=>'form-control'])!!}
				</div>
				<!-- unit table-->
				<div class="col-md-12 inside-form-tbl" id="productsTable-wrap" style="display:none">
					<span> الوحدات الفرعيه </span>
					<table id="productsTable">
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
				</div>
				<!-- services table-->
				<div class="col-md-12 inside-form-tbl" id="serviceTable-wrap" style="display:none">
					<span> الخدمات </span>
					<table id="serviceTable">
					<thead>
						<tr>
							<th>نوع الخدمة</th>
							<th>السعر</th>
							<th>الكود</th>
							<th>العمليات</th>
						</tr>
					</thead>
					<tbody class="add-services"></tbody>
				</table>
				</div>

				<!-- component table-->
				<div class="col-md-12 inside-form-tbl" id="componentTable-wrap" style="display:none">
					<span> مكونات المنتجات </span>
					<table id="componentTable" >
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
				</div>
				<!-- end table-->
			</div>
		</div>
		<div>
			<div class="row">
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper">
					<label>الحالة</label>
					<span class="new-radio-wrap">
						<label for="active">مفعل </label>
						{!! Form::radio("is_active",1,['class'=>'form-control','required','checked','id'=>'active'])!!}
					</span>
					<span class="new-radio-wrap">
						<label for="dis_active">غير مفعل </label>
						{!! Form::radio("is_active",0,['class'=>'form-control','id'=>'dis_active'])!!}
					</span>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary" id="barcodes_button" data-toggle="modal" data-target="#ExampleModalBarcode">
							اضاقه باركود اخر
					   </button>
						<label>الباركود </label>
						{!! Form::text("bar_code",null,['class'=>'form-control','id'=>'TheBarCodeInput','required','placeholder'=>' الباركود '])!!}
					</div>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label>سعر البيع </label>
						{!! Form::text("product_selling_price",isset($is_edit)?$product->selling_price:null,['class'=>'form-control','required','placeholder'=>' سعر البيع '])!!}
					</div>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label>سعر الشراء </label>
						{!! Form::text("product_purchasing_price",isset($is_edit)?$product->purchasing_price:null,['class'=>'form-control','required','placeholder'=>'سعر الشراء '])!!}
					</div>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label>الحد الادنى من الكمية </label>
						{!! Form::text("min_quantity",null,['class'=>'form-control','required','placeholder'=>'الحد الادنى من الكمية'])!!}
					</div>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label> الحد الاقصى من الكمية </label>
						{!! Form::text("max_quantity",null,['class'=>'form-control','required','placeholder'=>' الحد الاقصى من الكمية '])!!}
					</div>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label> الكمية </label>
						{!! Form::text("quantity",null,['class'=>'form-control','required','placeholder'=>' الكمية '])!!}
					</div>
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<div class=" form-group">
						<label> اسم الشركة المصنعة </label>
						<div class="btn-group adding-new-comp">
							<a href="{{route('accounting.industrials.create')}}" class="btn btn-success" target="_blank">
							  <span class="m-l-5">
							  شركة
							   <i class="fa fa-plus"></i>
							   </span>
							</a>
						</div>
						{!! Form::select("industrial_id",$industrials,null,['class'=>'form-control js-example-basic-single','id'=>'industrial_id','required','placeholder'=>' اختر اسم الشركة المصنعة المنتج '])!!}
					</div>
				</div>
			</div>
		</div>
    <!-- barcodes table-->
    <div class="col-md-12 inside-form-tbl" id="BarcodeTable" style="display:none">
        <span> الباركود </span>
        <table id="BarcodeTable">
            <thead>
            <tr>

                <th>الباكود</th>
                <th>العمليات</th>
            </tr>
            </thead>
            <tbody class="add-Barcodes"></tbody>
        </table>
    </div>
		<div>
			<div class="row">
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> الحجم </label><span class="asided-hint"> اختيارى ويكون بالسنتمتر المكعب</span>
					{!! Form::text("size",null,['class'=>'form-control','placeholder'=>' الحجم '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اللون </label><span class="asided-hint">اختيارى</span>
					{!! Form::text("color",null,['class'=>'form-control','placeholder'=>' اللون '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> الارتفاع </label><span class="asided-hint">اختيارى ويكون بالسنتمتر</span>
					{!! Form::text("height",null,['class'=>'form-control','placeholder'=>'الارتفاع '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> العرض </label><span class="asided-hint">اختيارى ويكون بالسنتمتر المربع</span>
					{!! Form::text("width",null,['class'=>'form-control','placeholder'=>' العرض '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> تاريخ الانتهاء </label><span class="asided-hint">اختيارى</span>
					{!! Form::date("expired_at",null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>مده التنبية</label><span class="asided-hint">اختيارى</span>
					{!! Form::number("alert_duration",null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label>عدد أيام فترة الركود</label><span class="asided-hint">اختيارى</span>
					{!! Form::number("num_days_recession",null,['class'=>'form-control'])!!}
				</div>
				@if (getsetting('automatic_products')==0)
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> اختر الحساب </label>
					{!! Form::select("account_id",accounts(),null,['class'=>'form-control','placeholder'=>' اختر الحساب'])!!}
				</div>
				@endif
			</div>
		</div>
		<div>
			<div class="row">
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left">
					<label> نوع الخصم </label>
					{!! Form::select("discount_type",['percent'=>'نسبة','quantity'=>'كمية'],isset($discount)?$discount->discount_type:null,['class'=>'form-control js-example-basic-single','id'=>'discount_id','placeholder'=>' اختر الخصم '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left" id="nesba-wrp">
					<label> النسبة </label>
					{!! Form::text("percent",isset($discount)?$discount->percent:null,['class'=>'form-control','placeholder'=>' النسبة '])!!}
				</div>
				<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left" id="discounts_button" style="display:none">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal4" >العروض والخصومات</button>
				</div>
							<!--discounts table-->
			<div class="col-md-12 inside-form-tbl" id="discountTable-wrap" style="display:none">
				<span>الخصومات</span>
				<table id="discountTable">
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
			</div>
			<!-- end table-->
			</div>
		</div>
		<div>
			<div class="row">
				<div class="form-group form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left taxs form-line new-radio-big-wrapper ">
					{{--{!! Form::radio("tax",$has_tax,['class'=>'form-control','id'=>'yes1','value'=>==)!!}--}}
					@if (isset($is_edit))
						{{--@dd($product->discount_type)--}}
					<label>الضريبة</label>
					<span class="new-radio-wrap">
						<label for="yes1">يوجد ضريبة</label>
					
						<input type="radio" name="tax" class="form-control" required id="yes1" value="{{($has_tax==1)?1:0}}" 
						{{($has_tax==1)?'checked':null}}>
					</span>
					<span class="new-radio-wrap">
						<label for="no1">لايوجد ضريبة</label>
						<input type="radio" name="tax" class="form-control" id="no1" value="{{($has_tax==1)?0:1}}"  
						{{($has_tax==1)?null:'checked'}}>
					</span>
					@else
					<label>الضريبة</label>
					<span class="new-radio-wrap">
						<label for="yes1">يوجد ضريبة </label>
						<input type="radio" name="tax" class="form-control" required checked id="yes1" value="1">
					</span>
					<span class="new-radio-wrap">
						<label for="no1">لايوجد ضريبة</label>
						<input type="radio" name="tax" class="form-control" id="no1" value="0">
					</span>
					@endif
				</div>
			
				@if (isset($price_has_tax))
					@if(isset($has_tax)&$has_tax==1)
					<div id="shamel-mesh">
						<div class="form-group form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left form-line new-radio-big-wrapper shamel-mesh">
						<label>شمول الضريبة</label>
						<span class="new-radio-wrap">
							<label > السعر شامل الضريبة </label>
							<input type="radio" name="price_has_tax" required class="form-control" value="{{($price_has_tax==1)?1:0}}" checked="{{($price_has_tax==1) ? 'checked':null }}">
						</span>
						<span class="new-radio-wrap">
							<label >السعر غير شامل الضريبة </label>
							<input type="radio" name="price_has_tax" required class="form-control"  value="{{($price_has_tax==1)?0:1}}" checked="{{($price_has_tax==1)? null:'checked' }}">
						</span>
						</div>
						<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left prices_taxs">
							<label> اسم شريحة الضرائب</label>
							<div class="btn-group adding-new-comp">
								<a href="{{route('accounting.taxs.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						    شريحة
						   <i class="fa fa-plus"></i>
						   </span>
								</a>
							</div>
							{!! Form::select("tax_band_id[]",$taxs,null,['class'=>'form-control selectpicker','multiple','placeholder'=>' اختر الشريحة '])!!}
						</div>
					</div>
					@endif
                @else
				<div id="shamel-mesh">
					<div class="form-group form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left form-line new-radio-big-wrapper shamel-mesh">
						<label>شمول الضريبة</label>
						<span class="new-radio-wrap">
							<label > السعر شامل الضريبة </label>
							<input type="radio" name="price_has_tax"  required="required" checked class="form-control"  value="1">
						</span>
						<span class="new-radio-wrap">
							<label >السعر غير شامل الضريبة </label>
							<input type="radio" name="price_has_tax" required="required"  class="form-control"  value="0">
						</span>
					</div>
					<div class="form-group col-lg-3  col-md-4 col-sm-6 col-xs-12 pull-left prices_taxs">
						<label> اسم شريحة الضرائب</label>
                        <div class="btn-group adding-new-comp">
                            <a href="{{route('accounting.taxs.create')}}" class="btn btn-success" target="_blank">
						  <span class="m-l-5">
						    شريحة
						   <i class="fa fa-plus"></i>
						   </span>
                            </a>
                        </div>
						{!! Form::select("tax_band_id[]",$taxs,null,['class'=>'form-control selectpicker','multiple','placeholder'=>' اختر الشريحة '])!!}
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
						{{-- @dd($taxsproduct) --}}
						@foreach($taxsproduct as $tax)
							<tr style="color:black;">
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
			$("#TheBarCodeInput").change(function(e){
				e.stopPropagation();
				e.preventDefault();
			})
			$("select[multiple]").each(function(){
				$(this).parent().find("ul.dropdown-menu.inner").children('li:first-child').removeClass('selected')
				$(this).children('option:first-child').attr('selected' , false);
				$(this).children('option:first-child').attr('disabled' , 'disabled');
			})
			$("#type").on('change', function () {
			var id = $(this).val();
			if (id =='service')
			{
			$("#services_button").show();
			}
			if (id !='service')
			{
			$("#services_button").hide();
			}
			});

			$("#type").on('change', function () {
			var id = $(this).val();
			if (id =='offer')
			{
			$("#offers_button").show();
			}
			if (id !='offer')
			{
			$("#offers_button").hide();
			}
			});

			$(".percent").hide();
			$('.js-example-basic-single').select2();
			$('input[name="tax"]').click(function () {
				if ($(this).is(':checked')) {
					var id = $(this).val();
					if (id == 1) {
						$("#shamel-mesh").show();
					} else if (id == 0) {
						$("#shamel-mesh").hide();
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
	<script src="{{asset('admin/assets/js/discount.js')}}"></script>
	<script src="{{asset('admin/assets/js/tax.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun2.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun3.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun4.js')}}"></script>
	<script src="{{asset('admin/assets/js/productFunction/myFun5.js')}}"></script>
    <script src="{{asset('admin/assets/js/productFunction/myFun6.js')}}"></script>
@endsection
