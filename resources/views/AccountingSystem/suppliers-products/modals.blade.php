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
				<input type="text" class="form-control the-unit-name autocomplete" id="name",list="unit_names2"  autocomplete="true">
                <datalist id="unit_names2">
                    @foreach (json_decode($units,true) as $unit )
                    <option value="{{$unit}}">

                    @endforeach
                    </datalist>


				<label> باركود</label>
				<input type="text" class="form-control the-unit-bar" id="par_code" >
				<label>مقدارها بالنسبة للوحده الاساسية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-pre" id="main_unit_present" >
				<label> سعرالبيع</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-spri" id="selling_price" >
				<label>سعر الشراء</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-ppri" id="purchasing_price" >
				<label> الكميه</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control the-unit-quantity" id="quantity" >
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
				{!! Form::select("product_id",products(),null,['class'=>'form-control js-example-basic-single','id'=>'component_name','placeholder'=>' اختر اسم المنتج المكون '])!!}
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
				<h5 class="modal-title" id="exampleModalLabel"> الاصناف التابعة</h5>
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
				<button class="btn btn-primary"  data-dismiss="modal" onclick="myFun4(event)">اضافة الخصم</button>
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
				 {!! Form::select("service_type",['Delivery'=>'توصيل','composing'=>'تركيب','maintenance'=>'صيانة'],null,['class'=>'form-control js-example-basic-single','id'=>'service_type','placeholder'=>' اختر  خدمة الصنف '])!!}
				<label>السعر</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="sevices_price">
				<label> الكود</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="sevices_code" value="">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary"  data-dismiss="modal" onclick="myFun5(event)">اضافة خدمات</button>
			</div>
		</div>
	</div>
</div>
<!-- end model5-->
<!-- Modal6 -->
<div class="modal fade" id="ExampleModalBarcode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">  كل الباركود</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<label>  الباركود</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="barcode" value="" >
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary"  data-dismiss="modal" onclick="myFun6(event)">اضافة باركود للمنتج</button>
			</div>
		</div>
	</div>
</div>
<!-- end model6-->
