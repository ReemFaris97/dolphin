@if (count($errors) > 0)
<div class="alert alert-danger">
	<ul>
		@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
		@endforeach
	</ul>
</div>
@endif

<div class="panel-group">
	<div class="panel">
		<div class="panel-heading" style="background: #2ecc71">
			<h6 class="panel-title">
				<a data-toggle="collapse" href="#collapsible-styled-group1">بيانات المكان</a>
			</h6>
		</div>
		<div id="collapsible-styled-group1" class="panel-collapse collapse in">
			<div class="panel-body">
				<div class="form-group col-md-4 pull-left">
					<label> اسم الشركة </label>
					{!! Form::select("company_id",companies(),null,['class'=>'form-control js-example-basic-single company_id','id'=>'company_id','placeholder'=>' اختر اسم الشركة التابع له المنتج '])!!}
				</div>

				<div class="form-group col-md-4 pull-left">
					<label> اسم الفرع التابع </label>
					{!! Form::select("branch_id",branches(),null,['class'=>'form-control selectpicker branch_id','id'=>'branch_id','multiple','placeholder'=>' اختر اسم الفرع التابع له المنتج '])!!}
				</div>

				<div class="form-group col-md-4 pull-left" id="store_id">
					<label> اسم المخزن </label>
					{!! Form::select("store_id",stores(),null,['class'=>'form-control js-example-basic-single store_id','id'=>'store_id','placeholder'=>' اختر اسم المخزن التابع له المنتج '])!!}
				</div>

				<div class="form-group col-md-4 pull-left">
					<label> اسم الوجه </label>
					{!! Form::select("face_id",faces(),null,['class'=>'form-control selectpicker face_id','id'=>'face_id','placeholder'=>' اختر وجه للمنتج '])!!}
				</div>

				<div class="form-group col-md-4 pull-left">
					<label> اسم العمود التابع للوجه </label>
					{!! Form::select("column_id",colums(),null,['class'=>'form-control selectpicker column_id','id'=>'column_id','placeholder'=>' اختر عمود للمنتج '])!!}
				</div>
				<div class="form-group col-md-4 pull-left">
					<label> اسم  الخلية  التابعة للعمود </label>
					{!! Form::select("cell_id",cells(),null,['class'=>'form-control selectpicker cell_id','id'=>'cell_id','placeholder'=>' اختر خلية للمنتج '])!!}
				</div>

			</div>
		</div>
	</div>

	<div class="panel">
		<div class="panel-heading" style="background: #e74c3c">
			<h6 class="panel-title">
				<a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group2">بيانات المنتج</a>
			</h6>
		</div>
		<div id="collapsible-styled-group2" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="form-group col-md-6 pull-left">
					<label>اسم المنتج </label>
					{!! Form::text("name_product",isset($is_edit)?$product->name:null,['class'=>'form-control','placeholder'=>' اسم المنتج '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> اسم التصنيف </label>
					{!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','id'=>'company_id','placeholder'=>' اختر اسم التصنيف التابع له المنتج '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>النوع </label>
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" id="components_button">
						المكونات
					</button>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" id="offers_button">
                        المنتجات التابعة
                    </button>
					{!! Form::select("type",['store'=>'مخزون','service'=>'خدمه','offer'=>'مجموعة منتجات ','creation'=>'تصنيع','product_expiration'=>'منتج بتاريخ صلاحيه'],null,['class'=>'form-control js-example-basic-single type','placeholder'=>' نوع المنتج ','id'=>'type'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>الوحدة الاساسية </label><span style="color: #ff0000; margin-right: 15px;">[جرام -كيلو-لتر]</span>
					<!-- Button trigger modal -->
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						الوحدات الفرعية
					</button>

					{!! Form::text("main_unit",null,['class'=>'form-control','placeholder'=>' الوحدة الاساسية '])!!}
				</div>
				<div class="form-group col-md-12 pull-left">
					<label>وصف المنتج </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>' وصف المنتج '])!!}
				</div>

				@if( isset($product))

					<div class="form-group col-md-6 pull-left">
						<label>صوره المنتج الحالية : </label>
						<img src="{{getimg($product->image)}}" style="width:100px; height:100px">
					</div>
				@endif
				<div class="form-group col-md-6 pull-left">
					<label>صوره المنتج:  </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::file("image",null,['class'=>'form-control'])!!}
				</div>

			</div>
		</div>
	</div>

	<div class="panel">
		<div class="panel-heading" style="background: #3498db">
			<h6 class="panel-title">
				<a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group3">بيانات البيع</a>
			</h6>
		</div>
		<div id="collapsible-styled-group3" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="form-group col-md-6 pull-left">
					<label>مفعل </label>
					{!! Form::radio("is_active",1,['class'=>'form-control'])!!}

					<label>غير مفعل </label>
					{!! Form::radio("is_active",0,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>الباركود </label>
					{!! Form::text("bar_code",null,['class'=>'form-control','placeholder'=>' الباركود '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>سعر البيع </label>
					{!! Form::text("product_selling_price",isset($is_edit)?$product->selling_price:null,['class'=>'form-control','placeholder'=>' سعر البيع '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>سعر الشراء </label>
					{!! Form::text("product_purchasing_price",isset($is_edit)?$product->purchasing_price:null,['class'=>'form-control','placeholder'=>'سعر الشراء '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>الحد الادنى من الكمية </label>
					{!! Form::text("min_quantity",null,['class'=>'form-control','placeholder'=>'الحد الادنى من الكمية'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> الحد الاقصى من الكمية </label>
					{!! Form::text("max_quantity",null,['class'=>'form-control','placeholder'=>' الحد الاقصى من الكمية '])!!}
				</div>

			</div>
		</div>
	</div>

	<div class="panel">
		<div class="panel-heading " style="background: #f1c40f">
			<h6 class="panel-title">
				<a class="collapsed" data-toggle="collapse" href="#collapsible-styled-group4">مواصفات أخرى (إختياري)</a>
			</h6>
		</div>
		<div id="collapsible-styled-group4" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="form-group col-md-6 pull-left">
					<label> الحجم </label><span style="color: #ff0000; margin-right: 15px;"> اختيارى ويكون بالسنتمتر المكعب</span>
					{!! Form::text("size",null,['class'=>'form-control','placeholder'=>' الحجم '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> اللون </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::text("color",null,['class'=>'form-control','placeholder'=>' اللون '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> الارتفاع </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر</span>
					{!! Form::text("height",null,['class'=>'form-control','placeholder'=>'الارتفاع '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> العرض </label><span style="color: #ff0000; margin-right: 15px;">اختيارى ويكون بالسنتمتر المربع</span>
					{!! Form::text("width",null,['class'=>'form-control','placeholder'=>' العرض '])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label> تاريخ الانتهاء </label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::date("expired_at",null,['class'=>'form-control'])!!}
				</div>
				<div class="form-group col-md-6 pull-left">
					<label>عدد أيام فترة الركود</label><span style="color: #ff0000; margin-right: 15px;">اختيارى</span>
					{!! Form::number("num_days_recession",null,['class'=>'form-control'])!!}
				</div>
			</div>
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
<!-- unit table-->
<table id="productsTable" class="table datatable-button-init-basic all">
	<thead>
		<tr>
			<th> اسم الوحده</th>
			<th>الباركود</th>
			<th>المقدارمن الوحدة الاساسية</th>
			<th>سعر البيع</th>
			<th>سعر الشراء</th>
			<th>العمليات</th>
		</tr>
	</thead>
	<tbody class="add-products">


	</tbody>
</table>

<!-- end table-->


<!-- component table-->
<table id="componentTable" class="table datatable-button-init-basic all">
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


<!-- offers table-->
<table id="offerTable" class="table datatable-button-init-basic all">
    <thead>
    <tr>
        <th> اسم المنتج التابع</th>

        <th>العمليات</th>
    </tr>
    </thead>
    <tbody class="add-offers">


    </tbody>
</table>

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
				{!! Form::select("product_id",$products,null,['class'=>'form-control js-example-basic-single','id'=>'component_name','placeholder'=>' اختر اسم الشركة التابع له الوجه '])!!}


				<label> الكمية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="component_quantity">
				<label> الوحده الاساسية</label>
				<span class="required--in">*</span>
				<input type="text" class="form-control" id="main_unit" value="">



			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				<button class="btn btn-primary" id="subunit" data-dismiss="modal" onclick="myFun2(event)">اضافة المكونات للمنتج</button>

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
                {!! Form::select("child_product",$products,null,['class'=>'form-control js-example-basic-single','id'=>'child_product','placeholder'=>' اختر اسم المنتج التابع   '])!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                <button class="btn btn-primary" id="offer" data-dismiss="modal" onclick="myFun3(event)"> اضافة  المنتج</button>

            </div>
        </div>
    </div>
</div>
<!-- end model3-->
@section('scripts')
<script>
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
		$("#components_button").hide();
        $("#offers_button").hide();
		$('#exampleModal').on('hidden.bs.modal', function(e) {
			$(this).removeData();
			$('#exampleModal input').val('');
		});
	});


	var bigData = [];
	var bigDataComponent = [];
    var bigDataOffer = [];
	function myFun(event) {
		event.preventDefault();
		var data = {};
		data.par_code = $('#par_code').val();
		data.name = $('#name').val();
		data.main_unit_present = $('#main_unit_present').val();
		data.selling_price = $('#selling_price').val();
		data.purchasing_price = $('#purchasing_price').val();
		if (data.name !== '' && data.main_unit_present !== '' && data.selling_price !== '' && data.purchasing_price !== '') {
			$("tr.editted-row").remove();
			swal({
				title: "تم إضافة الوحدة الفرعية بنجاح",
				text: "",
				icon: "success",
				buttons: ["موافق"],
				dangerMode: true,
			})

			bigData.push(data);

			var appendProducts = bigData.map(function(product) {
				return (`
                <tr class="single-product">
                    <td class="prod-nam">${product.name}</td>
                    <td class="prod-bar">${product.par_code}</td>
                    <td class="prod-pre">${product.main_unit_present}</td>
                    <td class="prod-spri">${product.selling_price}</td>
                    <td class="prod-ppri">${product.purchasing_price}</td>
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


		if (component_data.component_name !== '' && component_data.component_quantity !== '' && component_data.main_unit !== '' ) {
			$("tr.editted-row").remove();
			swal({
				title: "تم إضافة  المكون بنجاح",
				text: "",
				icon: "success",
				buttons: ["موافق"],
				dangerMode: true,
			})


			bigDataComponent.push(component_data);
			var appendComponent = bigDataComponent.map(function (component) {
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

		}///if_end

	}

    function myFun3(event) {
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
            var appendOffer= bigDataOffer.map(function (offer) {
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

        }///if_end

    }

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
<script src="{{asset('admin/assets/js/get_faces_by_branch.js')}}"></script>
<script src="{{asset('admin/assets/js/get_cells_by_column.js')}}"></script>
<script src="{{asset('admin/assets/js/get_columns_by_face.js')}}"></script>
<script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
<script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
<script src="{{asset('admin/assets/js/creation.js')}}"></script>
<script src="{{asset('admin/assets/js/offer.js')}}"></script>
@endsection