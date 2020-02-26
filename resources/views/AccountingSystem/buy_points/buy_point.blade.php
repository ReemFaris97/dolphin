@extends('AccountingSystem.layouts.master')
@section('title','الفاتوره')
@section('parent_title','إدارة نقطه البيع')
@section('action', URL::route('accounting.categories.index'))
@section('styles')
<link href="{{asset('admin/assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/bill.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/customized.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title"> فاتوره مشتريات
			<b class="time-r" id="theTime"></b>
		</h5>
		<div class="heading-elements">
			<ul class="icons-list">
				<li><a data-action="collapse"></a></li>
				<li><a data-action="reload"></a></li>
				<li><a data-action="close"></a></li>
			</ul>
		</div>
	</div>
	<div class="panel-body">
		<!----------------  Start Bill Content ----------------->
		<section class="yourBill">
			<div class="yurSections">
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group col-sm-4">
							<label> إسم المورد </label> :
							{!! Form::select("supplier_id",$suppliers,null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر اسم المورد','data-live-search'=>'true','id'=>'supplier_id'])!!}
						</div>
						<div class="form-group col-sm-4">
							<label> رقم الفاتوره </label> :
							{!! Form::text("bill_num",null,['class'=>'selectpicker form-control inline-control','placeholder'=>' رقم الفاتوره',"id"=>'bill_num'])!!}
						</div>
						<div class="form-group col-sm-4">
							<label for="bill_date"> تاريخ الفاتورة </label> :
							{!! Form::text("bill_date",null,['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' تاريخ الفاتورة',"id"=>'bill_date'])!!}
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group block-gp">
							<label>اسم القسم </label>
							{!! Form::select("category_id",$categories,null,['class'=>'selectpicker form-control js-example-basic-single category_id','id'=>'category_id','placeholder'=>' اختر اسم القسم ','data-live-search'=>'true'])!!}
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="yurProdc">
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group block-gp">
							<label>بحث بالباركود </label>
							<input class="form-control" type="text" id="barcode_search">
						</div>
					</div>
				</div>
			</div>
			<div class="result">
				<form method="post" action="{{route('accounting.purchases.store')}}">
					@csrf
					<input type="hidden" name="supplier_id" id="supplier_id_val">
					<input type="hidden" name="bill_num" id="bill_num_val">
					{{-- @dd(getsetting('name_enable')) --}}
					{{-- @dd(getsetting('name_enable')) --}}
					<table border="1" class="finalTb mabi3at-bill bill-table
                    {{(getsetting('name_enable')==1) ? 'name_enable':'' }}
                    {{(getsetting('barcode_enable')==1) ? 'barcode_enable':'' }}
                    {{(getsetting('unit_enable')==1) ? 'unit_enable':'' }}
                    {{(getsetting('quantity_enable')==1) ? 'quantity_enable':'' }}
                    {{(getsetting('unit_price_before_enable') == 1) ? 'unit_price_before_enable':''}}
                    {{(getsetting('unit_price_after_enable')==1) ? 'unit_price_after_enable':'' }}
                    {{(getsetting('total_price_before_enable')==1) ? 'total_price_before_enable':'' }}
                    {{(getsetting('total_price_after_enable')==1) ? 'total_price_after_enable':'' }} ">
						<thead>
							<tr>
								<th rowspan="2">م</th>
								<th rowspan="2" class="maybe-hidden name_enable">اسم الصنف</th>
								<th rowspan="2" class="maybe-hidden unit_enable">الوحدة</th>
								<th rowspan="2" class="maybe-hidden quantity_enable">الكمية</th>
								<th colspan="2" rowspan="1" class="th_lg">
									سعر الوحدة
								</th>
								<th colspan="2" rowspan="1" class="th_lg">
									الإجمالى
								</th>
								<th rowspan="2"> حذف </th>
							</tr>
							<tr>
								<th rowspan="1" class="maybe-hidden unit_price_before_enable">قبل الضريبة</th>
								<th rowspan="1" class="maybe-hidden unit_price_after_enable">بعد الضريبة</th>
								<th rowspan="1" class="maybe-hidden total_price_before_enable">قبل الضريبة</th>
								<th rowspan="1" class="maybe-hidden total_price_after_enable">بعد الضريبة</th>
							</tr>
						</thead>
						<tbody>
							<!--						Space For Appended Products-->
						</tbody>
						<tfoot class="tempDisabled">
							<tr id="amountBeforeDariba">
								<th colspan="2"> المجموع</th>
								<input type="hidden" class="dynamic-input" id="amountBeforeDariba1" name="amount">
								<th colspan="7" class="rel-cols">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
							</tr>
							<tr id="amountOfDariba">
								<th colspan="2"> قيمة الضريبة</th>
								<input type="hidden" class="dynamic-input">
								<th colspan="7" class="rel-cols">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
							</tr>
							<tr id="amountAfterDariba">
								<th colspan="2">المجموع بعد الضريبة</th>
								<input type="hidden" class="dynamic-input">
								<th colspan="7" class="rel-cols">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
							</tr>
							<tr id="discountArea">
								<th colspan="2">
									الخصم
								</th>
								<th colspan="7">
									<div class="inline_divs">
										<div class="form-group">
											<div class="rel-cols">
												<label for="byPercentage">ادخل نسبة الخصم</label>
												<input type="number" placeholder="النسبة المئوية للخصم" min="0" value="0" max="100" id="byPercentage" class="form-control dynamic-input">
												<span class="rs"> % </span>
											</div>
										</div>
										<div class="form-group">
											<div class="rel-cols">
												<label for="byAmount">ادخل مبلغ الخصم</label>
												<input type="number" placeholder="مبلغ الخصم" min="0" value="0" max="1" id="byAmount" class="form-control dynamic-input">
												<span class="rs"> ر.س </span>
											</div>
										</div>
									</div>
								</th>
							</tr>
							<tr id="demandedAmount">
								<th colspan="2">المطلوب دفعه</th>
								<input type="hidden" name="total" id="demandedAmount1">
								<th colspan="7" id="reminder" class="rel-cols">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
							</tr>
							<tr id="paidAmount">
								<th colspan="2">المدفوع</th>
								<th colspan="7">
									<div class="inline_divs">
										<div class="form-group rel-cols">
											<label for="byCache">كاش</label>
											<input type="number" id="byCache" placeholder="المدفوع كاش" min="0" class="form-control dynamic-input">
											<span class="rs"> ر.س </span>
										</div>
										<span> + </span>
										<div class="form-group rel-cols">
											<label for="byNet">شبكة</label>
											<input type="number" id="byNet" placeholder="المدفوع شبكة" min="0" class="form-control dynamic-input">
											<span class="rs"> ر.س </span>
										</div>
										<div class="rel-cols">
											<span class="dynamic-span" id="allPaid">0</span>
											<span class="rs"> ر.س </span>
										</div>
									</div>
								</th>
							</tr>
							<tr id="remaindedAmount">
								<th colspan="2">المتبقي</th>
								<th colspan="7" class="rel-cols">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
								<input type="hidden" class="dynamic-input" id="#remainder-inputt" name="reminder">
							</tr>
							<input type="hidden" name="totalTaxs">
							<input type="hidden" name="payment" id="payment_type">
							<tr>
								<th colspan="9">
									<button type="submit">حفظ</button>
								</th>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</section>
		<!----------------  End Bill Content ----------------->
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>
<script>
	$(document).ready(function() {
		$('.inlinedatepicker').datetimepicker().datepicker("setDate", new Date());
	})
	// For preventing user from inserting two methods of discount
	function preventDiscount() {
		$("input#byPercentage").change(function() {
			$("input#byAmount").val(0);
		});
		$("input#byAmount").change(function() {
			$("input#byPercentage").val(0);
		});
	}
	$(document).ready(function() {
		preventDiscount();
	})
	$("#supplier_id").on('change', function() {
		$("#supplier_id_val").val($(this).val());
	});
	$("#bill_num_val").val($("#bill_num").val());
	$(".category_id").on('change', function() {
		var id = $(this).val();
		var store_id = $('#store_id').val();
		$('#store_val').val(store_id);
		var branch_id = $('#branch_id').val();
		$('#branch_val').val(branch_id);
		var company_id = $('#company_id').val();
		$('#company_val').val(company_id);
		$.ajax({
			type: 'get',
			url: "/accounting/productsAjexPurchase/" + id,
			data: {
				id: id,
				store_id: store_id
			},
			dataType: 'json',
			success: function(data) {
				$('.yurProdc').html(data.data);
				$('#selectID').attr('data-live-search', 'true');
				$('#selectID').attr('placeholder', 'اختر الصنف');
				$('#selectID').selectpicker('refresh');
				var rowNum = 0;
				$('#selectID').change(function() {
					rowNum++;
					var selectedProduct = $(this).find(":selected");
					var ProductId = $('#selectID').val();
					var productName = selectedProduct.text();
					var productPrice = selectedProduct.data('price');
					var priceHasTax = selectedProduct.data('price-has-tax');
					var totalTaxes = selectedProduct.data('total-taxes');
					var mainUnit = selectedProduct.data('main-unit');
					var productUnits = selectedProduct.data('subunits');
					let unitName = productUnits.map(a => a.name);
					let unitPrice = productUnits.map(b => b.selling_price);
					var singlePriceBefore, singlePriceAfter = 0;
					if (Number(priceHasTax) === 0) {
						var singlePriceBefore = Number(productPrice);
						var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
					} else if (Number(priceHasTax) === 1) {
						var singlePriceBefore = Number(productPrice) - (Number(productPrice) * (Number(totalTaxes) / 100));
						var singlePriceAfter = Number(productPrice);
					} else {
						var singlePriceBefore = Number(productPrice);
						var singlePriceAfter = Number(productPrice);
					}
					var optss = `<option data-uni-price="${productPrice}">${mainUnit}</option>`;
					for (var i = 0; i < productUnits.length; i++) {
						optss += '<option data-uni-price="' + unitPrice[i] + '"> ' + unitName[i] + '</option> ';
					}
					$(".bill-table tbody").append(`<tr class="single-row-wrapper">
							<td class="row-num">${rowNum}</td>
                            <input type="hidden" name="product_id[]" value="${ProductId}">
							<td class="product-name maybe-hidden name_enable">${productName}</td>
							<td class="product-unit maybe-hidden unit_enable">
								<select class="form-control js-example-basic-single">
									${optss}
								</select>
							</td>
							<td class="product-quantity maybe-hidden quantity_enable">
								<input type="number" placeholder="الكمية" min="1" value="0" id="sale" class="form-control" name="quantity[]">
							</td>
							<td class="single-price-before maybe-hidden unit_price_before_enable">${singlePriceBefore}</td>
							<td class="single-price-after maybe-hidden unit_price_after_enable">${singlePriceAfter}</td>
							<td class="whole-price-before maybe-hidden total_price_before_enable">${singlePriceBefore}</td>
							<td class="whole-price-after maybe-hidden total_price_after_enable">${singlePriceAfter}</td>
							<td class="delete-single-row">
								لابد من مراجعة المشرف
							</td>
						</tr>`);
					var wholePriceBefore, wholePriceAfter = 0;
					$(".product-unit select").change(function() {
						var selectedUnit = $(this).find(":selected");
						var productPrice = selectedUnit.data('uni-price');
						if (Number(priceHasTax) === 0) {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
						} else if (Number(priceHasTax) === 1) {
							var singlePriceBefore = Number(productPrice) - (Number(productPrice) * (Number(totalTaxes) / 100));
							var singlePriceAfter = Number(productPrice);
						} else {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice);
						}
						$(this).parents('tr.single-row-wrapper').find(".single-price-before").text(singlePriceBefore.toFixed(1));
						$(this).parents('tr.single-row-wrapper').find(".single-price-after").text(singlePriceAfter.toFixed(1));
					});
					$(".product-quantity input").change(function() {
						if (($(this).val()) < 0) {
							$(this).val(0);
							$(this).text('0');
						}
						$(".tempDisabled").removeClass("tempDisabled");
						var wholePriceBefore = Number($(this).parents('tr.single-row-wrapper').find(".single-price-before").text()) * Number($(this).val());
						$(this).parents('tr.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(1));
						var wholePriceAfter = Number($(this).parents('tr.single-row-wrapper').find(".single-price-after").text()) * Number($(this).val());
						$(this).parents('tr.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(1));
					});
				});
				$(".bill-table tbody").change(function() {
					preventDiscount();
					var amountBeforeDariba = 0;
					$("td.whole-price-before").each(function() {
						amountBeforeDariba += Number($(this).text());
						$("#amountBeforeDariba1").val(amountBeforeDariba);
					})
					var amountAfterDariba = 0;
					$("td.whole-price-after").each(function() {
						amountAfterDariba += Number($(this).text());
					})
					var amountOfDariba = Number(amountAfterDariba) - Number(amountBeforeDariba);
					$("tr#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba);
					$("tr#amountAfterDariba span.dynamic-span").html(amountAfterDariba);
					$("tr#amountOfDariba span.dynamic-span").html(amountOfDariba);
					var byAmount = $("input#byAmount").val();
					var byPercentage = $("input#byPercentage").val();
					$("input#byAmount").attr('max', amountAfterDariba);
					var total = 0;
					if (byAmount == 0 && byPercentage == 0) {
						$("tr#demandedAmount span.dynamic-span").html(amountAfterDariba);
					} else {
						$("input#byPercentage").change(function() {
							if ((Number($(this).val())) > 100) {
								alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
							$("#demandedAmount span.dynamic-span").html(total);
						});
						$("input#byAmount").change(function() {
							if ((Number($(this).val())) > Number($("tr#amountAfterDariba span.dynamic-span").html())) {
								alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("tr#amountAfterDariba span.dynamic-span").html());
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number($(this).val()));
							$("#demandedAmount span.dynamic-span").html(total);
						});
					}
					$("input#byPercentage").change(function() {
						if ((Number($(this).val())) > 100) {
							alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
							$(this).val(0);
						}
						total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
						$("#demandedAmount span.dynamic-span").html(total);
					});
					$("input#byAmount").change(function() {
						if ((Number($(this).val())) > Number($("tr#amountAfterDariba span.dynamic-span").html())) {
							alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("tr#amountAfterDariba span.dynamic-span").html());
							$(this).val(0);
						}
						total = Number(amountAfterDariba) - (Number($(this).val()));
						$("#demandedAmount span.dynamic-span").html(total);
					});
					$("#byCache , #byNet").change(function() {
						var allPaid = Number($("#byCache").val()) + Number($("#byNet").val());
						$("#allPaid").html(allPaid);
						var remaindedAmount = Number(allPaid) - Number($("tr#demandedAmount span.dynamic-span").html());
						$("#remaindedAmount span.dynamic-span").html(remaindedAmount);
						$("#remainder-inputt").val(remaindedAmount);
						if (remaindedAmount > 0) {
							$("#remaindedAmount th.rel-cols").removeClass("aagel-case");
							$("#remaindedAmount th.rel-cols").removeClass("tmam-case");
							$("#remaindedAmount th.rel-cols").addClass("motabaqy-case");
							$("#payment_type").val("cash");
						} else if (remaindedAmount < 0) {
							$("#remaindedAmount th.rel-cols").removeClass("motabaqy-case");
							$("#remaindedAmount th.rel-cols").removeClass("tmam-case");
							$("#remaindedAmount th.rel-cols").addClass("aagel-case");
							$("#payment_type").val("agel");
						} else {
							$("#remaindedAmount th.rel-cols").removeClass("motabaqy-case");
							$("#remaindedAmount th.rel-cols").removeClass("aagel-case");
							$("#remaindedAmount th.rel-cols").addClass("tmam-case");
							$("#payment_type").val("cash");
						}
					});
					$("#demandedAmount1").val($("tr#demandedAmount span.dynamic-span").html())
				});
			}
		});
	});
	//	For Ajax Search By Product Name
	$('#pro_search').keyup(function(e) {
		var pro_search = $(this).val();
		$.ajax({
			url: "/accounting/pro_search/" + pro_search,
			type: "GET",
			success: function(data) {
				$('.yurProdc').html(data.data);
				$('#selectID').attr('data-live-search', 'true');
				$('#selectID').selectpicker('refresh');
			}
		});
	});
	//	For Ajax Search By Product Bar Code
	$('#barcode_search').keyup(function(e) {
		var barcode_search = $(this).val();
		$.ajax({
			url: "/accounting/barcode_search/" + barcode_search,
			type: "GET",
			success: function(data) {
				$('.yurProdc').html(data.data);
				$('#selectID').attr('data-live-search', 'true');
				$('#selectID').selectpicker('refresh');
			}
		});
	});
</script>
<script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
<script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
<!---- new design --->
<script>
	//   For Alerting Before closing the window
//	window.onbeforeunload = function(e) {
//		e = e || window.event;
//		if (e) {
//			e.returnValue = 'هل أنت متأكد من غلق هذه الصفحة ؟ سيتم فقدان كال البيانات التي تم ادخالها!!';
//		}
//		return 'هل أنت متأكد من غلق هذه الصفحة ؟ سيتم فقدان كال البيانات التي تم ادخالها!!';
//	};

	function refreshTime() {
		var today = new Date();
		var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
		var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		var dateTime = date + ' ' + time;
		document.getElementById("theTime").innerHTML = dateTime;
	}
	setInterval(refreshTime, 1000)
</script>
@endsection