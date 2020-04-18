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
		<h5 class="panel-title">نقطة البيع
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
				<div class="row table-upper-options">
					<!-- Nav tabs -->
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label> اسم الكاشير: </label>
							{{--@dd($session->shift->name)--}}
							{{$session->user->name}}
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group"><label> اسم الوردية: </label>
							{{optional($session->shift)->name}}
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-12">
						<div class="form-group">
							<label> تاريخ بداية الجلسة :</label>
							{{$session->start_session}}
						</div>
					</div>
				</div>
				<div class="row table-upper-options">
					<!-- Nav tabs -->
					<div class="form-group block-gp col-md-4 col-sm-4">
						<label> إسم العميل: </label>
						{!! Form::select("client",$clients,null,['class'=>'selectpicker form-control inline-control','data-live-search'=>'true','id'=>'client_id'])!!}
					</div>
					<div class="form-group block-gp col-md-4 col-sm-4">
						<label for="bill_date"> تاريخ الفاتورة </label>
						{!! Form::text("bill_date",null,['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' تاريخ الفاتورة',"id"=>'bill_date'])!!}
					</div>
					<div class="form-group block-gp col-md-4 col-sm-4">
						<label>بحث بالباركود </label>
						<input class="form-control" type="text" id="barcode_search">
					</div>
					<div class="form-group block-gp col-md-4 col-sm-4">
						<label>اسم القسم </label>
						{!! Form::select("category_id",$categories,null,['class'=>'selectpicker form-control js-example-basic-single category_id','id'=>'category_id','placeholder'=>' اختر اسم القسم ','data-live-search'=>'true'])!!}
					</div>
					<div class="form-group block-gp col-md-4 col-sm-4">
						<div class="yurProdc"></div>
						<div class="tempobar"></div>
					</div>
				</div>
			</div>
			<div class="result">
				<form method="post" id="sllForm" action="{{route('accounting.sales.store')}}">
					@csrf
					<input type="hidden" name="user_id" value="{{$session->user_id}}">
					<input type="hidden" name="session_id" value="{{$session->id}}">
					<input type="hidden" name="shift_id" value="{{$session->shift_id}}">
					<input type="hidden" name="client_id" id="client_id_val">
					<table border="1" class="finalTb mabi3at-bill bill-table 
					{{(getsetting('name_enable_sales')==1) ? 'name_enable':'' }} {{(getsetting('barcode_enable_sales')==1) ? 'barcode_enable':'' }} 
					{{(getsetting('unit_enable_sales')==1) ? 'unit_enable':'' }} {{(getsetting('quantity_enable_sales')==1) ? 'quantity_enable':'' }} {{(getsetting('unit_price_before_enable_sales') == 1) ? 'unit_price_before_enable':''}} {{(getsetting('unit_price_after_enable_sales')==1) ? 'unit_price_after_enable':'' }} {{(getsetting('total_price_before_enable_sales')==1) ? 'total_price_before_enable':'' }} {{(getsetting('total_price_after_enable_sales')==1) ? 'total_price_after_enable':'' }}">
						<thead>
							<tr>
								<th rowspan="2">م</th>
								<th rowspan="2" class="maybe-hidden name_enable">اسم الصنف</th>
								<th rowspan="2" class="maybe-hidden barcode_enable">باركود</th>
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



							<tr>
								<th id="amountBeforeDariba" class="rel-cols" colspan="3">
									<span class="colorfulSpan"> المجموع</span>
									<input type="hidden" class="dynamic-input">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
								<th id="amountOfDariba" class="rel-cols" colspan="3">
									<span class="colorfulSpan"> قيمة الضريبة</span>
									<input type="hidden" class="dynamic-input" name="totalTaxs" id="amountOfDariba1">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
								<th id="amountAfterDariba" class="rel-cols" colspan="3">
									<span class="colorfulSpan">المجموع بعد الضريبة</span>
									<input type="hidden" class="dynamic-input" name="amount" id="amountAfterDarib1">
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
												<input type="number" placeholder="النسبة المئوية للخصم" min="0" value="0" max="100" step="any" id="byPercentage" class="form-control dynamic-input" name="discount_byPercentage">
												<span class="rs"> % </span>
											</div>
										</div>
										<div class="form-group">
											<div class="rel-cols">
												<label for="byAmount">ادخل مبلغ الخصم</label>
												<input type="number" step="any" placeholder="مبلغ الخصم" min="0" value="0" max="1" id="byAmount" class="form-control dynamic-input" name="discount_byAmount">
												<span class="rs"> ر.س </span>
											</div>
										</div>
									</div>
								</th>
							</tr>
							<tr id="demandedAmount">
								<th colspan="2">المطلوب دفعه</th>
								<input type="hidden" name="total" id="total">
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
											<input type="number" step="any" id="byCache" placeholder="المدفوع كاش" min="0" class="form-control dynamic-input" name="cash">
											<span class="rs"> ر.س </span>
										</div>
										<span> + </span>
										<div class="form-group rel-cols">
											<label for="byNet">شبكة</label>
											<input type="number" step="any" id="byNet" placeholder="المدفوع شبكة" min="0" class="form-control dynamic-input" name="network">
											<span class="rs"> ر.س </span>
										</div>
										<div class="rel-cols">
											<input type="hidden" name="payed" id="allPaid1">
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
								<input type="hidden" class="dynamic-input" id="remainder-inputt" name="reminder">
							</tr>
							<tr>
								<th colspan="9">
									<button type="submit"> حفظ [F7] </button>
								</th>
							</tr>
						</tfoot>
					</table>
				</form>
				<div class="newly-added-2-btns-">
					@if(auth()->user()->is_saler==1)
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
						اغلاق الجلسة [F8]
					</button>
					@endif
					<a class="btn btn-danger" id="add-mortaga3" href="{{route('accounting.sales.returns',$session->id)}}">
						اضافة فاتورة مرتجع [F9] </a>
					<a class="btn btn-warning" id="ta3liik" href="#" target="_blank"> تعليق الفاتورة [F10] </a>
				</div>
				@if($session->user->is_saler==1)
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"> اغلاق الجلسة </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="{{route('accounting.sales.end',$session->user->is_saler)}}" id="form1">
									@csrf
									<input type="hidden" name="session_id" value="{{$session->id}}">
									<label style="color:black"> الباسورد</label>
									<input type="password" name="password" class="form-control">
								</form>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
								<button type="submit" class="btn btn-primary" onclick="document.getElementById('form1').submit()">حفظ</button>
							</div>
						</div>
					</div>
				</div>
				@endif


				<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel"> إزالة الصنف </h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="post" action="#" id="form5">
									@csrf
									<div class="col-md-12">
										<label style="color:black"> البريد الإلكتروني</label>
										<input type="email" name="" class="form-control" id="email">
									</div>
									<div class="col-md-12">
										<label style="color:black"> الباسورد</label>
										<input type="password" name="" class="form-control" id="password">
									</div>
								</form>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary confirm_delete"  id="confirm_delete">تحقق</button>
							</div>
						</div>
					</div>
				</div>


			</div>
		</section>
		<!----------------  End Bill Content ----------------->
	</div>
</div>
@endsection
@section('scripts')
<script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>
<script>
	
(function($){
    $.fn.scannerDetection=function(options){

        // If string given, call onComplete callback
        if(typeof options==="string"){
            this.each(function(){
                this.scannerDetectionTest(options);
            });
            return this;
        }

        var defaults={
            onComplete:false, // Callback after detection of a successfull scanning (scanned string in parameter)
            onError:false, // Callback after detection of a unsuccessfull scanning (scanned string in parameter)
            onReceive:false, // Callback after receive a char (scanned char in parameter)
            timeBeforeScanTest:100, // Wait duration (ms) after keypress event to check if scanning is finished
            avgTimeByChar:30, // Average time (ms) between 2 chars. Used to do difference between keyboard typing and scanning
            minLength:6, // Minimum length for a scanning
            endChar:[9,13], // Chars to remove and means end of scanning
            stopPropagation:false, // Stop immediate propagation on keypress event
            preventDefault:false // Prevent default action on keypress event
        };
        if(typeof options==="function"){
            options={onComplete:options}
        }
        if(typeof options!=="object"){
            options=$.extend({},defaults);
        }else{
            options=$.extend({},defaults,options);
        }
        
        this.each(function(){
            var self=this, $self=$(self), firstCharTime=0, lastCharTime=0, stringWriting='', callIsScanner=false, testTimer=false;
            var initScannerDetection=function(){
                firstCharTime=0;
                stringWriting='';
            };
            self.scannerDetectionTest=function(s){
                // If string is given, test it
                if(s){
                    firstCharTime=lastCharTime=0;
                    stringWriting=s;
                }
                // If all condition are good (length, time...), call the callback and re-initialize the plugin for next scanning
                // Else, just re-initialize
                if(stringWriting.length>=options.minLength && lastCharTime-firstCharTime<stringWriting.length*options.avgTimeByChar){
                    if(options.onComplete) options.onComplete.call(self,stringWriting);
                    $self.trigger('scannerDetectionComplete',{string:stringWriting});
                    initScannerDetection();
                    return true;
                }else{
                    if(options.onError) options.onError.call(self,stringWriting);
                    $self.trigger('scannerDetectionError',{string:stringWriting});
                    initScannerDetection();
                    return false;
                }
            }
            $self.data('scannerDetection',{options:options}).unbind('.scannerDetection').bind('keydown.scannerDetection',function(e){
                // Add event on keydown because keypress is not triggered for non character keys (tab, up, down...)
                // So need that to check endChar (that is often tab or enter) and call keypress if necessary
                if(firstCharTime && options.endChar.indexOf(e.which)!==-1){
                    // Clone event, set type and trigger it
                    var e2=jQuery.Event('keypress',e);
                    e2.type='keypress.scannerDetection';
                    $self.triggerHandler(e2);
                    // Cancel default
                    e.preventDefault();
                    e.stopImmediatePropagation();
                }
            }).bind('keypress.scannerDetection',function(e){
                if(options.stopPropagation) e.stopImmediatePropagation();
                if(options.preventDefault) e.preventDefault();

                if(firstCharTime && options.endChar.indexOf(e.which)!==-1){
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    callIsScanner=true;
                }else{
                    stringWriting+=String.fromCharCode(e.which);
                    callIsScanner=false;
                }

                if(!firstCharTime){
                    firstCharTime=e.timeStamp;
                }
                lastCharTime=e.timeStamp;

                if(testTimer) clearTimeout(testTimer);
                if(callIsScanner){
                    self.scannerDetectionTest();
                    testTimer=false;
                }else{
                    testTimer=setTimeout(self.scannerDetectionTest,options.timeBeforeScanTest);
                }
                
                if(options.onReceive) options.onReceive.call(self,e);
                $self.trigger('scannerDetectionReceive',{evt:e});
            });
        });
        return this;
    }
})(jQuery);
</script>
<script>
	$(document).ready(function() {
		$('.inlinedatepicker').datetimepicker().datepicker("setDate", new Date());
		$('.inlinedatepicker').text(new Date().toLocaleString());
		$('.inlinedatepicker').val(new Date().toLocaleString());
	});


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
	});
	$("#client_id").on('change', function() {
		var client = $(this).val();
		$('#client_id_val').val(client);
	});
	var rowNum = 0;
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
			url: "/accounting/productsAjex/" + id,
			data: {
				id: id,
				store_id: store_id
			},
			dataType: 'json',
			success: function(data) {
				$('.yurProdc').html(data.data);
				$('#selectID').attr('data-live-search', 'true');
				$('#selectID').selectpicker('refresh');
				$('#selectID').change(function () {
					rowNum++;
					var selectedProduct = $(this).find(":selected");
					//  alert($('#selectID').val());
					var productId = $('#selectID').val();
					var productName = selectedProduct.text();
					var productBarCode = selectedProduct.data('bar-code');
					var productPrice = selectedProduct.data('price');
					var priceHasTax = selectedProduct.data('price-has-tax');
					var totalTaxes = selectedProduct.data('total-taxes');
					var mainUnit = selectedProduct.data('main-unit');
					var productUnits = selectedProduct.data('subunits');
					let unitName = productUnits.map(a => a.name);
					let unitPrice = productUnits.map(b => b.selling_price);
					var unitId = productUnits.map(c => c.id);
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
					var optss = ``;
					for (var i = 0; i < productUnits.length; i++) {
						optss += '<option data-uni-price="' + unitPrice[i] + '" value="' + unitId[i] + '"> ' + unitName[i] + '</option> ';
					}
					$(".bill-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}">
						<td class="row-num">${rowNum}</td>
						<input type="hidden" name="product_id[]" value=${productId}>
						<td class="product-name maybe-hidden name_enable">${productName}</td>
						<td class="product-name maybe-hidden barcode_enable">${productBarCode}</td>
						<td class="product-unit maybe-hidden unit_enable">
							<select class="form-control js-example-basic-single" name="unit_id[${productId}]">
								${optss}
							</select>
						</td>
						<td class="product-quantity maybe-hidden quantity_enable">
							<input type="number" placeholder="الكمية" min="1" value="1" id="sale" name="quantity[]" class="form-control">
						</td>
						<td class="single-price-before maybe-hidden unit_price_before_enable">${singlePriceBefore}</td>
						<td class="single-price-after maybe-hidden unit_price_after_enable">${singlePriceAfter}</td>
						<td class="whole-price-before maybe-hidden total_price_before_enable">${singlePriceBefore}</td>
						<td class="whole-price-after maybe-hidden total_price_after_enable">${singlePriceAfter}</td>
						<td class="delete-single-row">
							@if($session->user->is_admin==1)
							<a href="#"><span class="icon-cross"></span></a>
							@else
							<button type="button" class="btn btn-primary in-row-del" data-toggle="modal" data-target="#deleteModal">
                                <span class="icon-cross"></span>
                            </button>
							@endif
							</td>
                        </tr>`);
						// assign id for the clicked button on the deleting modal
						$(".in-row-del").on('click' , function(){
							var tempRowNum = $(this).parents('tr').attr('id');
							$("#deleteModal").attr('data-tempdelrow' , tempRowNum);
							$("#confirm_delete").click(function() {
							   var email = $("#email").val();
							   var password = $("#password").val();
							   $.ajax({
								  url: "/accounting/confirm_user/",
								  type: "GET",
								  data:{'email':email,'password':password},
								  success: function (data) {
									  if(data.data == 'success'){
										  $("#" + tempRowNum).remove();
										  $(".bill-table tbody").trigger('change');
										  $('#deleteModal').modal('hide');
									  }else{
										  alert('البيانات التي ادخلتها غير صحيحة .');
									  }
								  },
								  error: function (error) {
									  alert('البيانات التي ادخلتها غير صحيحة .');
								  }
							   });
							});
						})
					var wholePriceBefore, wholePriceAfter = 0;
					$(".product-unit select").change(function () {
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
						$(this).parents('.single-row-wrapper').find(".single-price-before").text(singlePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").text(singlePriceAfter.toFixed(2));
					});
					$(".product-quantity input").change(function () {
						if (($(this).val()) < 0) {
							$(this).val(0);
							$(this).text('0');
						}
						$(".tempDisabled").removeClass("tempDisabled");
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before").text()) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").text()) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
					});
					$(".bill-table tbody").trigger('change');
					$(".tempDisabled").removeClass("tempDisabled");
					$(".delete-single-row a").on('click', function () {
						$(this).parents('tr').remove();
						$(".bill-table tbody").trigger('change');
					})
				});
				$(".bill-table tbody").change(function () {
					preventDiscount();
					var amountBeforeDariba = 0;
					$(".whole-price-before").each(function () {
						amountBeforeDariba += Number($(this).text());
					});
					var amountAfterDariba = 0;
					$(".whole-price-after").each(function () {
						amountAfterDariba += Number($(this).text());
					});
					var amountOfDariba = Number(amountAfterDariba) - Number(amountBeforeDariba);
					$("#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba);
					$("#amountAfterDariba span.dynamic-span").html(amountAfterDariba);
					$("#amountOfDariba span.dynamic-span").html(amountOfDariba.toFixed(2));
					$("#amountOfDariba1").val(amountOfDariba);
					var byAmount = $("input#byAmount").val();
					var byPercentage = $("input#byPercentage").val();
					$("input#byAmount").attr('max', amountAfterDariba);
					var total = 0;
					$('#amountAfterDarib1').val(amountAfterDariba);
					if (byAmount == 0 && byPercentage == 0) {
						$("#demandedAmount span.dynamic-span").html(amountAfterDariba.toFixed(2));
					} else {
						$("input#byPercentage").change(function () {
							if ((Number($(this).val())) > 100) {
								alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
							$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
							$("#total").val(total);
						});
						$("input#byAmount").change(function () {
							if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
								alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number($(this).val()));
							$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
							$("#total").val(total);
						});
					}
					$("input#byPercentage").change(function () {
						if ((Number($(this).val())) > 100) {
							alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
							$(this).val(0);
						}
						total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
						$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
						$("#total").val(total);
					});
					$("input#byAmount").change(function () {
						if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
							alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
							$(this).val(0);
						}
						total = Number(amountAfterDariba) - (Number($(this).val()));
						$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
						$("#total").val(total);
					});
					$("#byCache , #byNet").change(function () {
						var allPaid = Number($("#byCache").val()) + Number($("#byNet").val());
						$("#allPaid").html(allPaid.toFixed(2));
						$("#allPaid1").val(allPaid);
						var remaindedAmount = Number(allPaid) - Number($("#demandedAmount span.dynamic-span").html());
						$("#remaindedAmount span.dynamic-span").html(remaindedAmount.toFixed(2));
						$('#remainder-inputt').val(Math.abs(remaindedAmount));
						if (remaindedAmount > 0) {
							$("#remaindedAmount .rel-cols").removeClass("aagel-case");
							$("#remaindedAmount .rel-cols").removeClass("tmam-case");
							$("#remaindedAmount .rel-cols").addClass("motabaqy-case");
						} else if (remaindedAmount < 0) {
							$("#remaindedAmount .rel-cols").removeClass("motabaqy-case");
							$("#remaindedAmount .rel-cols").removeClass("tmam-case");
							$("#remaindedAmount .rel-cols").addClass("aagel-case");
						} else {
							$("#remaindedAmount .rel-cols").removeClass("motabaqy-case");
							$("#remaindedAmount .rel-cols").removeClass("aagel-case");
							$("#remaindedAmount .rel-cols").addClass("tmam-case");
						}
					})
				});
			}
		});
	});
	//	For Ajax Search By Product Bar Code



	

//	$('#barcode_search').keyup(function(){
//				var barcode_search = $(this).val();
//		$.ajax({
//			url: "/accounting/barcode_search_sale/" + barcode_search,
//			type: "GET",
//			success: function(data) {
//				if (data.data.length !== 0) {
//					$('#barcode_search').val('');
//					$(".tempobar").html(data.data);
//					var selectedID = $(".tempobar").find('option').data('unit-id');
//					var alreadyChosen = $(".bill-table tbody td select option[value=" + selectedID + "]");
//					var repeatedInputVal = $(".bill-table tbody td select option[value=" + selectedID + "]:selected").parents('tr').find('.product-quantity').find('input');
//					if (alreadyChosen.length > 0 && alreadyChosen.is(':selected')) {
//						repeatedInputVal.val(Number(repeatedInputVal.val()) + 1);
//						repeatedInputVal.text(repeatedInputVal.val());
//						$('.product-quantity').find('input').trigger('change');
//					} else {
//						$('#barcode_search').val('');
//						rowNum++;
//						byBarcode();
//					}
//					
//				}
//			}
//		});
//	
//	});

$("#barcode_search").scannerDetection({
	timeBeforeScanTest: 200, // wait for the next character for upto 200ms
	avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
	preventDefault: true,
	endChar: [13],
	onComplete: function(barcode, qty){	
   		validScan = true;
		$.ajax({
			url: "/accounting/barcode_search_sale/" + barcode,
			type: "GET",
			success: function(data) {
				if (data.data.length !== 0) {
					$('#barcode_search').val('');
					$(".tempobar").html(data.data);
					var selectedID = $(".tempobar").find('option').data('unit-id');
					var alreadyChosen = $(".bill-table tbody td select option[value=" + selectedID + "]");
					var repeatedInputVal = $(".bill-table tbody td select option[value=" + selectedID + "]:selected").parents('tr').find('.product-quantity').find('input');
					if (alreadyChosen.length > 0 && alreadyChosen.is(':selected')) {
						repeatedInputVal.val(Number(repeatedInputVal.val()) + 1);
						repeatedInputVal.text(repeatedInputVal.val());
						$('.product-quantity').find('input').trigger('change');
					} else {
						$('#barcode_search').val('');
						rowNum++;
						byBarcode();
					}	
				}
			}
		});
    },
	onError: function(string, qty) {
		$('#barcode_search').val ($('#barcode_search').val()  + string);
	}
});









	function byBarcode() {
		$(".tempDisabled").removeClass("tempDisabled");
		$(".tempobar").find('option').prop('selected', true);
		var selectedProduct = $(".tempobar").find('option').prop('selected', true);
		//		  alert($('option.ssID').val());
		var productId = $('option.ssID').val();
		var productName = selectedProduct.text();
		var productBarCode = selectedProduct.data('bar-code');
		var productPrice = selectedProduct.data('price');
		var priceHasTax = selectedProduct.data('price-has-tax');
		var totalTaxes = selectedProduct.data('total-taxes');
		var mainUnit = selectedProduct.data('main-unit');
		var productUnits = selectedProduct.data('subunits');
		let unitName = productUnits.map(a => a.name);
		let unitPrice = productUnits.map(b => b.selling_price);
		var unitId = productUnits.map(c => c.id);
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
		var optss = ``;
		for (var i = 0; i < productUnits.length; i++) {
			optss += '<option data-uni-price="' + unitPrice[i] + '" value="' + unitId[i] + '" > ' + unitName[i] + '</option> ';
		}
		$(".bill-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}">
		<td class="row-num">${rowNum}</td>
		<input type="hidden" name="product_id[]" value=${productId}>
		<td class="product-name maybe-hidden name_enable">${productName}</td>
		<td class="product-name maybe-hidden barcode_enable">${productBarCode}</td>
		<td class="product-unit maybe-hidden unit_enable">
			<select class="form-control js-example-basic-single" name="unit_id[${productId}]">
				${optss}
			</select>
		</td>
		<td class="product-quantity maybe-hidden quantity_enable">
			<input type="number" placeholder="الكمية" min="1" value="1" id="sale" name="quantity[]" class="form-control">
		</td>
		<td class="single-price-before maybe-hidden unit_price_before_enable">${singlePriceBefore}</td>
		<td class="single-price-after maybe-hidden unit_price_after_enable">${singlePriceAfter}</td>
		<td class="whole-price-before maybe-hidden total_price_before_enable">${singlePriceBefore}</td>
		<td class="whole-price-after maybe-hidden total_price_after_enable">${singlePriceAfter}</td>
		<td class="delete-single-row">
			@if($session->user->is_admin==1)
			<a href="#"><span class="icon-cross"></span></a>
			@else
			<button type="button" class="btn btn-primary in-row-del" data-toggle="modal" data-target="#deleteModal">
				<span class="icon-cross"></span>
			</button>
			@endif
			</td>
		</tr>`);

		// assign id for the clicked button on the deleting modal
		$(".in-row-del").on('click' , function(){
			var tempRowNum = $(this).parents('tr').attr('id');
			$("#deleteModal").attr('data-tempdelrow' , tempRowNum);
			$("#confirm_delete").click(function() {
			   var email = $("#email").val();
			   var password = $("#password").val();
			   $.ajax({
				  url: "/accounting/confirm_user/",
				  type: "GET",
				  data:{'email':email,'password':password},
				  success: function (data) {
					  if(data.data == 'success'){
						  $("#" + tempRowNum).remove();
						  $(".bill-table tbody").trigger('change');
						  $('#deleteModal').modal('hide');
					  }else{
						  alert('البيانات التي ادخلتها غير صحيحة .');
					  }
				  },
				  error: function (error) {
					  alert('البيانات التي ادخلتها غير صحيحة .');
				  }
			   });
			});
		})



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
			$(this).parents('.single-row-wrapper').find(".single-price-before").text(singlePriceBefore.toFixed(2));
			$(this).parents('.single-row-wrapper').find(".single-price-after").text(singlePriceAfter.toFixed(2));
		});
		$(".product-quantity input").change(function() {
			if (($(this).val()) < 0) {
				$(this).val(0);
				$(this).text('0');
			}
			$(".tempDisabled").removeClass("tempDisabled");
			var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before").text()) * Number($(this).val());
			$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
			var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").text()) * Number($(this).val());
			$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
		});
		$(".delete-single-row a").on('click', function() {
			$(this).parents('tr').remove();
			$(".bill-table tbody").trigger('change');
		})
		$(".bill-table tbody").change(function() {
			preventDiscount();
			var amountBeforeDariba = 0;
			$(".whole-price-before").each(function() {
				amountBeforeDariba += Number($(this).text());
			});
			var amountAfterDariba = 0;
			$(".whole-price-after").each(function() {
				amountAfterDariba += Number($(this).text());
			});
			var amountOfDariba = Number(amountAfterDariba) - Number(amountBeforeDariba);
			$("#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba);
			$("#amountAfterDariba span.dynamic-span").html(amountAfterDariba);
			$("#amountOfDariba span.dynamic-span").html(amountOfDariba.toFixed(2));
			$("#amountOfDariba1").val(amountOfDariba);
			var byAmount = $("input#byAmount").val();
			var byPercentage = $("input#byPercentage").val();
			$("input#byAmount").attr('max', amountAfterDariba);
			var total = 0;
			$('#amountAfterDarib1').val(amountAfterDariba);
			if (byAmount == 0 && byPercentage == 0) {
				$("#demandedAmount span.dynamic-span").html(amountAfterDariba.toFixed(2));
			} else {
				$("input#byPercentage").change(function() {
					if ((Number($(this).val())) > 100) {
						alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
						$(this).val(0);
					}
					total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
					$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
					$("#total").val(total.toFixed(2));
				});
				$("input#byAmount").change(function() {
					if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
						alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
						$(this).val(0);
					}
					total = Number(amountAfterDariba) - (Number($(this).val()));
					$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
					$("#total").val(total.toFixed(2));
				});
			}
			$("input#byPercentage").change(function() {
				if ((Number($(this).val())) > 100) {
					alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
					$(this).val(0);
				}
				total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
				$("#demandedAmount span.dynamic-span").html(total.toFixed(2));

				$("#total").val(total);
			});
			$("input#byAmount").change(function() {
				if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
					alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
					$(this).val(0);
				}
				total = Number(amountAfterDariba) - (Number($(this).val()));
				$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
				$("#total").val(total);
			});
			$("#byCache , #byNet").change(function() {
				var allPaid = Number($("#byCache").val()) + Number($("#byNet").val());
				$("#allPaid").html(allPaid.toFixed(2));
				$("#allPaid1").val(allPaid);
				var remaindedAmount = Number(allPaid) - Number($("#demandedAmount span.dynamic-span").html());
				$("#remaindedAmount span.dynamic-span").html(remaindedAmount.toFixed(2));
				$('#remainder-inputt').val(Math.abs(remaindedAmount));
				if (remaindedAmount > 0) {
					$("#remaindedAmount .rel-cols").removeClass("aagel-case");
					$("#remaindedAmount .rel-cols").removeClass("tmam-case");
					$("#remaindedAmount .rel-cols").addClass("motabaqy-case");
				} else if (remaindedAmount < 0) {
					$("#remaindedAmount .rel-cols").removeClass("motabaqy-case");
					$("#remaindedAmount .rel-cols").removeClass("tmam-case");
					$("#remaindedAmount .rel-cols").addClass("aagel-case");
				} else {
					$("#remaindedAmount .rel-cols").removeClass("motabaqy-case");
					$("#remaindedAmount .rel-cols").removeClass("aagel-case");
					$("#remaindedAmount .rel-cols").addClass("tmam-case");
				}
			})
		});
	}
	$(document).keydown(function(event) {
		if (event.which == 118) { //F7 حفظ
			$("#sllForm").submit();
			return false;
		}
		if (event.which == 119) { //F8 اغلاق الجلسة
			$("button[data-target='#exampleModal']").trigger('click');
			return false;
		}
		if (event.which == 120) { //F9 اضافة مرتجع
			window.open(
				"{{route('accounting.sales.returns',$session->id)}}",
				"_blank"
			);
			return false;
		}
		if (event.which == 121) { //F10 تعليق الفاتورة
			window.open(
				"#",
				"_blank"
			);
			return false;
		}
	});

	$(document).on('submit', '#sllForm', function(event) {
		var feloos = Number($("tr#remaindedAmount span.dynamic-span").text())
		if (feloos >= 0) {
			$("#sllForm").submit();
		} else {
			event.preventDefault();
			alert('عفوا , لابد من استيفاء المبلوغ الطلوب دفعه قبل حفظ الفاتورة')
		}
	});
</script>
<script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
<script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
<!---- new design --->
<script>
	@if(!empty(\Illuminate\ Support\ Facades\ Session::has('sale_id')))
	@php($sale_id = \Illuminate\ Support\ Facades\ Session::get('sale_id'))
	window.open(
		"{{route('accounting.sales.show',$sale_id)}}",
		"_blank"
	).print();
	@endif
</script>
<script>
	//   For Alerting Before closing the window
	window.onbeforeunload = function(e) {
		e = e || window.event;
		if (e) {
			e.returnValue = 'هل أنت متأكد من غلق هذه الصفحة ؟ سيتم فقدان كال البيانات التي تم ادخالها!!';
		}
		return 'هل أنت متأكد من غلق هذه الصفحة ؟ سيتم فقدان كال البيانات التي تم ادخالها!!';
	};

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