@extends('AccountingSystem.layouts.master')
@section('title','انشاء فاتورة مرتجع  مشترى')
@section('parent_title','إدارة المشتريات')
@section('action', URL::route('accounting.suppliers.index'))
@section('styles')
<!--- start datatable -->
<link href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/doc/assets/docs.css" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/src/parsley.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet" type="text/css">
<link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css
" rel="stylesheet" type="text/css">
<!--- end datatable -->
<link href="{{asset('admin/assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/bill.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/customized.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="panel panel-flat">
	<div class="panel-heading">
		<h5 class="panel-title">  اضافة فاتورة مرتجع
			<b class="time-r" id="theTime"></b>
			{{-- <a href="{{url("/accounting/settings/purchases_bill")}}" class="btn btn-success bill-cogs" target="_blank" rel="noreferrer noopener">
				<i class="fas fa-cogs"></i>
				إعدادات الفاتورة
				<i class="fas fa-cogs"></i>
			</a> --}}
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
		<form method="post" id="buyForm" action="{{route('accounting.puchaseReturns.store')}}" data-parsley-validate="">
					@csrf
			<div class="yurSections">
				<div class="row">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									{{ $error }}
								@endforeach
							</ul>
						</div>
					@endif
					<div class="col-xs-12">
						<div class="form-group  {{(getsetting('show_supplier_balance')==1) ? 'show_supplier_balance_enable col-sm-2':'col-sm-4' }}">
							<label> إسم المورد </label>
							{!! Form::select("supplier_id",$suppliers,null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر اسم المورد','data-live-search'=>'true','data-parsley-required-message'=>'من فضلك اختر المورد','id'=>'supplier_id','required'=>''])!!}
						</div>
						@if (getsetting('show_supplier_balance')==1)

							<div class="form-group col-md-2  pull-left suppliers">
								<label>   رصيد المورد </label>
								<input type="text" id="balance" class="form-control" readonly>
							</div>
						@endif

						<div class="form-group col-sm-4">
							<label> رقم الفاتوره </label>
							{!! Form::text("bill_num",null,['class'=>'selectpicker form-control inline-control','placeholder'=>' رقم الفاتوره','data-parsley-required-message'=>'من فضلك رقم الفاتورة',"id"=>'bill_num','required'=>''])!!}
						</div>
						<div class="form-group col-sm-4">
							<label for="bill_date"> تاريخ الفاتورة </label>
							{!! Form::text("__bill_date",null,['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' تاريخ الفاتورة',"id"=>'bill_date','data-parsley-required-message'=>'من فضلك التاريخ','required'=>''])!!}
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12 pos-rel">
						<div class="form-group block-gp">
							<label>بحث بالباركود </label>
							<input class="form-control" type="text" id="barcode_search">
						</div>
						{{-- <a href="{{route('accounting.products.create')}}" target="_blank" class="btn btn-primary pos-abs-btn">
							اضافه منتج جديد
						</a> --}}
					</div>
<!--
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="form-group block-gp">
							<label>اسم القسم </label>
							{!! Form::select("category_id",$categories,null,['class'=>'selectpicker form-control js-example-basic-single category_id','id'=>'category_id','placeholder'=>' اختر اسم القسم ','data-live-search'=>'true'])!!}
						</div>
					</div>
-->
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="yurProdc">
							<!--Select Products-->
							<div class="form-group block-gp">
								<label>بحث بإسم الصنف أو الباركود</label>
								<select class=" form-control js-example-basic-single"
										name="product_id"
										placeholder="اختر الصنف"
										data-live-search="true"
										id="selectID">
									<option value=""> اختر الصنف</option>
									@foreach ($products as $product)
									<?php
                                        $producttax=\App\Models\AccountingSystem\AccountingProductTax::where('product_id',$product->id)->first();
                                        $units=\App\Models\AccountingSystem\AccountingProductSubUnit::where('product_id',$product->id)->get();
                                        $subunits= collect($units);
                                        $allunits=json_encode($subunits,JSON_UNESCAPED_UNICODE);
                                        $mainunits=json_encode(collect([['id'=>'main-'.$product->id,'name'=>$product->main_unit , 'purchasing_price'=>$product->purchasing_price]]),JSON_UNESCAPED_UNICODE);
                                        $merged = array_merge(json_decode($mainunits), json_decode($allunits));
                                        $lastPrice=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->latest()->first();
                                        $sumQuantity=\App\Models\AccountingSystem\AccountingPurchaseItem::where('product_id',$product->id)->sum('quantity');
                                        $arrPrice=DB::table('accounting_purchases_items')->where('product_id',$product->id)
                                            ->selectRaw('SUM(price_after_tax * quantity) as total')
                                            ->pluck('total');
                                        $total=0;
                                        foreach ($arrPrice as $price){
                                            $total+= $price;
                                        }
                                        if($sumQuantity!=0){
                                            $average= $total/$sumQuantity;
                                        }else{
                                            $average=0;
                                        }
                                        ?>
									<option value="{{$product->id}}"
										data-name="{{$product->name}}"
										data-link="{{route('accounting.products.show',['id'=>$product->id])}}"
										data-last-price="{{$lastPrice->price_after_tax??0 }}"
										data-average="{{($average)??0 }}"
										data-bar-code="{{$product->bar_code}}"
										data-price="{{$product->purchasing_price -(($product->purchasing_price*$product->total_discounts)/100) }}"
										data-price-has-tax="{{isset($producttax)? $producttax->price_has_tax : '-1' }}"
										data-subunits="{{json_encode($merged)}}"
										data-product_expiration="{{($product->type=='product_expiration')? '1':'0' }}"
										data-total-taxes="{{ isset($producttax)? $product->total_taxes : '0'}}"
										data-total_discounts="{{$product->total_discounts}}">
										{{$product->name}} - {{$product->bar_code}}
									</option>
									@endforeach
								</select>
							</div>
							<!--Select Products End-->
						</div>
					</div>
					<div class="tempobar"></div>
				</div>
			</div>
			<div class="result">

					<input type="hidden" name="bill_date" id="bill_date_val">

<table border="1" class="table finalTb moshtraiat-bill mabi3at-bill bill-table
{{(getsetting('name_enable')==1) ? 'name_enable':'' }}
{{(getsetting('barcode_enable')==1) ? 'barcode_enable':'' }}
{{(getsetting('unit_enable')==1) ? 'unit_enable':'' }}
{{(getsetting('quantity_enable')==1) ? 'quantity_enable':'' }}
{{(getsetting('product_expire_date')==1) ? 'expiration_enable':'' }}
{{(getsetting('unit_price_enable') == 1) ? 'unit_price_enable':''}}
{{(getsetting('total_enable')==1) ? 'total_enable':'' }}
{{(getsetting('gifts_enable')==1) ? 'gifts_enable':'' }}
{{(getsetting('discounts_enable')==1) ? 'discounts_enable':'' }}
{{(getsetting('total_taxes_enable')==1) ? 'total_taxes_enable':'' }}
{{(getsetting('operations_enable')==1) ? 'operations_enable':'' }}
{{(getsetting('total_pure_enable')==1) ? 'total_pure_enable':'' }}

">

{{-- name_enable unit_enable quantity_enable
 expiration_enable unit_price_enable total_enable gifts_enable
  discounts_enable total_taxes_enable operations_enable total_pure_enable"> --}}
    <thead>
        <tr>
            <th rowspan="2" width="40">م</th>
            <th rowspan="2" class="maybe-hidden name_enable" width="270">اسم الصنف</th>
            <th rowspan="2" class="maybe-hidden unit_enable" width="70">الوحدة</th>
            <th rowspan="2" class="maybe-hidden quantity_enable" width="70">الكمية</th>
            <th rowspan="2" class="maybe-hidden expiration_enable" width="120">تاريخ الصلاحية</th>
            <th rowspan="2" class="maybe-hidden unit_price_enable" width="70">سعر الوحدة</th>
            <th colspan="2" class="maybe-hidden total_enable" width="70">الإجمالى</th>
            <th colspan="2" class="maybe-hidden gifts_enable" width="70">هدايا</th>
            <th colspan="2" class="maybe-hidden discounts_enable">الخصومات</th>
            <th rowspan="2" class="maybe-hidden total_taxes_enable" width="70">قيمة الضريبة</th>
            <th rowspan="2" class="maybe-hidden total_pure_enable" width="70">صافي الإجمالي</th>
            <th rowspan="2" class="maybe-hidden operations_enable"  width="160"> عمليات </th>
        </tr>
    </thead>

						<tbody>
							<!--Space For Appended Products-->
						</tbody>
						<tfoot class="tempDisabled">
							<tr>
								<th id="amountBeforeDariba" class="rel-cols" colspan="3">
									<span class="colorfulSpan"> المجموع</span>
									<input type="hidden" class="dynamic-input" id="amountBeforeDariba1" name="amount">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
								<th id="amountOfDariba" class="rel-cols" colspan="3">
									<span class="colorfulSpan"> قيمة الضريبة</span>
									<input type="hidden" class="dynamic-input" name="totalTaxs" id="amountOfDariba2">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
								<th id="amountAfterDariba" class="rel-cols" colspan="3">
									<span class="colorfulSpan">المجموع بعد الضريبة</span>
									<input type="hidden" class="dynamic-input">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
							</tr>
							<tr>
								<th colspan="3" class="rel-cols" id="discountArea">
									<span class="colorfulSpan">
										الخصم
									</span>
									<div class="inline_divs">
										<div class="form-group">
											<div>
												<label for="byPercentage" class="wit-lbl">ادخل نسبة الخصم</label>
												<input type="number" step="any" placeholder="النسبة المئوية للخصم" min="0" value="0" max="100" id="byPercentage" name="discount_byPercentage" class="form-control dynamic-input">
												<span class="rs"> % </span>
											</div>
										</div>
										<div class="form-group">
											<div>
												<label for="byAmount" class="wit-lbl">ادخل مبلغ الخصم</label>
												<input type="number" step="any" placeholder="مبلغ الخصم" min="0" value="0" max="1" id="byAmount" name="discount_byAmount" class="form-control dynamic-input">
												<span class="rs"> ر.س </span>
											</div>
										</div>
									</div>
								</th>
								<th class="rel-cols" colspan="3" id="demandedAmount">
									<span class="colorfulSpan">المطلوب دفعه</span>
									<input type="hidden" name="total" id="demandedAmount1">
									<span class="dynamic-span">0</span>
									<span class="rs"> ر.س </span>
								</th>
								<th id="paymentMethod" colspan="3" class="rel-cols">
									<span class="colorfulSpan">طريقة الدفع</span>
									<div class="inline_divs">
										<div class="form-group rel-cols radiBtnwrap">
											<input type="radio" id="tazaBTaza" name="payment" value="cash" required="" data-parsley-required-message="من فضلك اختر طريقة الدفع"
>
											<label for="tazaBTaza">نقدا</label>
										</div>
										<div class="form-group rel-cols radiBtnwrap">
											<input type="radio" id="tataBTata" name="payment" value="agel">
											<label for="tataBTata">اجل</label>
										</div>
									</div>
								</th>
							</tr>
							{{--<input type="hidden" name="totalTaxs">--}}
							<tr>
								<th colspan="9">
									<button type="submit">حفظ</button>
								</th>
							</tr>
						</tfoot>
					</table>
			<div id="modals-area"></div>
			</div>
			</form>
		</section>
		<!----------------  End Bill Content ----------------->
	</div>
</div>
@endsection
@section('scripts')
<!-- Begin Form Validation-->
<script src="https://cdn.jsdelivr.net/gh/guillaumepotier/Parsley.js@2.9.2/dist/parsley.js"></script>
<script>
    $(function () {
      $('#buyForm').parsley().on('field:validated', function() {
        var ok = $('.parsley-error').length === 0;
        $('.bs-callout-info').toggleClass('hidden', !ok);
        $('.bs-callout-warning').toggleClass('hidden', ok);
      })
    });
</script>
<!-- End Form Validation-->
<!--- scroll to the last table row -->
<script>
$('table').on('DOMSubtreeModified', 'tbody', function(){
    $("tbody").animate({ scrollTop: $('tbody').prop("scrollHeight")}, 1000);
});
</script>
<!--- end datatable -->
<script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>
<script src="{{asset('admin/assets/js/scanner.js')}}"></script>
<script>
	$(document).ready(function() {
		// scroll to the last table row
		$('table').on('DOMSubtreeModified', 'tbody', function() {$("tbody").animate({scrollTop: $('tbody').prop("scrollHeight")}, 1000)});

		// For initializing now date
		$('.inlinedatepicker').datetimepicker().datepicker("setDate", new Date());
		$('.inlinedatepicker').text(new Date().toLocaleString());
		$('.inlinedatepicker').val(new Date().toLocaleString());

		// For preventing user from inserting two methods of discount
		$("#byPercentage").change(function() {
			$("#byAmount").val(0);
		});
		$("#byAmount").change(function() {
			$("#byPercentage").val(0);
		});

	});

	//	variable for enumeration of bill products id
	var rowNum = 0;
	$('#selectID').selectpicker();
	$('#selectID').change(function() {
					//		Getting initial vairiables and values code
					rowNum++;
					var selectedProduct = $(this).find(":selected");
					var ProductId = $('#selectID').val();
					var productName = selectedProduct.data('name');
					var productLink = selectedProduct.data('link');
					var lastPrice = selectedProduct.data('last-price');
					var avgPrice = selectedProduct.data('average');
					var barCode = selectedProduct.data('bar-code');
					var productPrice = selectedProduct.data('price');
					var priceHasTax = selectedProduct.data('price-has-tax');
					var totalTaxes = selectedProduct.data('total-taxes');
					var productUnits = selectedProduct.data('subunits');
					var expirationDate = selectedProduct.data('product_expiration');
					var dateInpt = '';
					let today = new Date().toISOString().substr(0, 10);
					if (expirationDate == 1) {
						var dateInpt = '<input type="date" class="expiration form-control" name="expire_date" value="' + today + '" , min="' + today + '">';
					} else {
						var dateInpt = '---';
					}
					let unitName = productUnits.map(a => a.name);
					let unitId = productUnits.map(c => c.id);
					let unitPrice = productUnits.map(b => b.purchasing_price);

					//		Getting prices and taxes Code
					var singlePriceBefore, singlePriceAfter = 0;
					if (Number(priceHasTax) === 0) {
						var singlePriceBefore = Number(productPrice);
						var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
					} else if (Number(priceHasTax) === 1) {
						var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(totalTaxes))));
						var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
						var singlePriceAfter = Number(productPrice);
					} else {
						var singlePriceBefore = Number(productPrice);
						var singlePriceAfter = Number(productPrice);
					}
					var netTax = (Number(singlePriceAfter) - Number(singlePriceBefore)).toFixed(2);

					var discountNum = 1;
					var optss = ``;
					for (var i = 0; i < productUnits.length; i++) {
						optss += '<option data-uni-price="' + unitPrice[i] + '" value="' + unitId[i] + '" > ' + unitName[i] + '</option> ';
					}

					$(".bill-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}" data-ifhastax="${priceHasTax}" data-tot-taxes="${totalTaxes}">
							<td class="row-num" width="40">${rowNum}</td>
                            <input type="hidden" name="product_id[]" value="${ProductId}">
							<td class="product-name maybe-hidden name_enable" width="270"><a href="${productLink}" target="_blank" rel="noopener noreferrer">${productName}</a></td>
							<td class="product-unit maybe-hidden unit_enable" width="70">
								<select class="form-control js-example-basic-single" name="unit_id[${ProductId}]" >
									${optss}
								</select>
							</td>
							<td class="product-quantity maybe-hidden quantity_enable" width="70">
								<input type="number" placeholder="الكمية" step="1" min="1" value="1" id="sale" class="form-control" name="quantity[${ProductId}]">
							</td>
							<td class="expiration-date maybe-hidden expiration_enable" width="120">
								${dateInpt}
							</td>
							<td class="unit-price maybe-hidden unit_price_enable" width="70">
								<input type="number" class="form-control" step="any" value="${productPrice}" name="">
							</td>
							<td class="quantityXprice maybe-hidden total_enable" width="70">${productPrice}</td>
							<td class="whole-product-gifts maybe-hidden gifts_enable" width="70">
								<input type="number" placeholder="الهدايا" step="1" min="0" value="0" class="form-control" name="gifts[${ProductId}]">
							</td>
							<td class="whole-product-discounts maybe-hidden discounts_enable"></td>

							<td class="single-price-before maybe-hidden">
								<input type="number" class="form-control" step="any" value="${singlePriceBefore}" name="prices[${ProductId}]">
							</td>

                            <input type="hidden" name="itemTax[${ProductId}]" value="${netTax}">
							<td class="single-price-after maybe-hidden total_taxes_enable" data-sinAft="${singlePriceAfter}" width="70">
								${netTax}
							</td>
							<td class="whole-price-before maybe-hidden ">${singlePriceBefore}</td>
							<td class="whole-price-after maybe-hidden total_pure_enable" width="70">${singlePriceAfter}</td>

							<td class="bill-operations-td maybe-hidden operations_enable" width="160">
								<a href="${productLink}" target="_blank" title="عرض المنتح" rel="noopener noreferrer">
									<span class="icon-file-text"></span>
								</a>
								<button type="button" title="متوسط السعر" class="btn btn-primary popover-dismiss"
										data-toggle="popover" title="أخر سعر : ${lastPrice}"
										data-container="body" data-toggle="popover"
										data-placement="right" data-content="متوسط السعر : ${avgPrice}">
										<span class="icon-coin-dollar"></span>
								</button>
								<a href="#" data-toggle="modal" title="إضافة خصم" data-target="#discMod${rowNum}"><span class="icon-magic-wand"></span></a>
								<a href="#" title="مسح" class="remove-prod-from-list"><span class="icon-cross"></span></a>
							</td>
						</tr>
					`);
//					$("#row" + rowNum).find('.product-quantity').find('input').trigger('change');
					$(".tempDisabled").removeClass("tempDisabled");
					calcInfo();
					$('.popover-dismiss').popover({
						trigger: 'focus'
					});
					$("#modals-area").append(`<div id="discMod${rowNum}" class="modal fade special-discount-modal" role="dialog">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"> إضافة خصم خاص بالمنتج ${productName} </h4>
						  </div>
						  <div class="modal-body">
							<div class="single-special-dis-wrap clearfix row">
                                <div class="form-group col-xs-4 ddd-none" >
								<label>رقم الخصم</label>
								<input type="text" class="form-control " value=${discountNum} >
							</div>
								<div class="form-group col-xs-4">
									<label>ادخل الخصم بالنسبة</label>
									<input type="number" step="any" class="form-control singleSpecialDiscByPer" value="0" min="0" placeholder="ادخل الخصم بالنسبة" name="items[${rowNum}][discount_item_percentage][]">
								</div>
								<div class="form-group col-xs-4">
									<label>ادخل الخصم بالمبلغ</label>
									<input type="number" step="any" class="form-control singleSpecialDiscByVal" value="0" min="0" placeholder="ادخل الخصم بالمبلغ" name="items[${rowNum}][discount_item_value][]">
								</div>
								<div class="form-group col-xs-4">
									<label>يؤثر في الضريبة <input class="effectTax" type="checkbox" name="items[${rowNum}][discount_item_effectTax][]" value="1"></label>
								</div>
							</div>
							<div class="anotherAddedSpecialDiscounts"></div>
							<div class="row clearfix text-center">
								<a data-id="${rowNum}" class="appendAnewDiscount btn btn-success">إضافة خصم أخر</a>
							</div>
						  </div>
						  <div class="modal-footer Text-center">
							<button type="button" class="btn btn-default" data-dismiss="modal">إتمام</button>
						  </div>
						</div>
					  </div>
					</div>`);
					$("#discMod" + rowNum + "  a.appendAnewDiscount").on('click', function() {
						discountNum++;
						var itemNumber = $(this).data('id');
						$(this).parent().prev('.anotherAddedSpecialDiscounts').append(`<div class="single-special-dis-wrap clearfix row">
                            <div class="form-group col-xs-4 ddd-none">
								<label>رقم الخصم</label>
								<input type="text" class="form-control " value="${discountNum}" >
							</div>
                        	<div class="form-group col-xs-4">
								<label>ادخل الخصم بالنسبة</label>
								<input type="number" step="any" class="form-control singleSpecialDiscByPer" value="0" min="0" placeholder="ادخل الخصم بالنسبة" name="items[${itemNumber}][discount_item_percentage][]">
							</div>
							<div class="form-group col-xs-4">
								<label>ادخل الخصم بالمبلغ</label>
								<input type="number" step="any" class="form-control singleSpecialDiscByVal" value="0" min="0" placeholder="ادخل الخصم بالمبلغ" name="items[${itemNumber}][discount_item_value][]">
							</div>
							<div class="form-group col-xs-4">
								<label>يؤثر في الضريبة <input class="effectTax" type="checkbox" name="items[${rowNum}][discount_item_effectTax][]" value="1"></label>

								</div>
							<a href="#" class="removeThisSinglSpecDisc"><span class="icon-cross"></span></a>
						</div>`);
						$(".product-quantity input").each(function() {
							$(this).trigger('change');
						});
						$("a.removeThisSinglSpecDisc").on('click', function(e) {
							e.preventDefault();
							$(this).parents(".single-special-dis-wrap").remove();
						});
						$(".singleSpecialDiscByPer").each(function() {
							$(this).on('change', function() {
								$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByVal').val(0);
								if (($(this).val()) < 0) {
									$(this).val(0);
									$(this).text('0');
								}
							})
						});
						$(".singleSpecialDiscByVal").each(function() {
							$(this).on('change', function() {
								$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByPer').val(0);
								if (($(this).val()) < 0) {
									$(this).val(0);
									$(this).text('0');
								}
							})
						});
					});
					$(".singleSpecialDiscByPer").each(function() {
						$(this).on('change', function() {
							$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByVal').val(0);
							if (($(this).val()) < 0) {
								$(this).val(0);
								$(this).text('0');
							}
						})
					});
					$(".singleSpecialDiscByVal").each(function() {
						$(this).on('change', function() {
							$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByPer').val(0);
							if (($(this).val()) < 0) {
								$(this).val(0);
								$(this).text('0');
							}
						})
					});
					var wholePriceBefore, wholePriceAfter = 0;
					//**************    Calc while changing unit input ***********************
					$(".product-unit select").change(function() {
						$(".tempDisabled").removeClass("tempDisabled");
						var selectedUnit = $(this).find(":selected");
						var priceHasTax = $(this).parents("tr.single-row-wrapper").data('ifhastax');
						var productPrice = selectedUnit.data('uni-price');
						//		Getting prices and taxes Code
						if (Number(priceHasTax) === 0) {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
						} else if (Number(priceHasTax) === 1) {
							var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(totalTaxes))));
							var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
							var singlePriceAfter = Number(productPrice);
						} else {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice);
						}

						var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
						var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".single-price-before input").val();
						var theUnitTax = $(this).parents("tr.single-row-wrapper").data("tot-taxes");
						var quantityXprice = Number(productPrice) * Number(theQuantity);
						$(this).parents('.single-row-wrapper').find(".unit-price input").val(productPrice);
						$(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));
						var netTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);
						$(this).parents('.single-row-wrapper').find(".single-price-before input").val(singlePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft', singlePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").text(netTax.toFixed(2));
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before input").val()) * Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft')) * Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
						$(this).parents("tr.single-row-wrapper").find(".product-quantity input").trigger('change');
						$('.special-discount-modal').trigger('hidden.bs.modal');
					});
					//**************    Calc while changing quantity input *******************
					$(".product-quantity input").change(function() {
						$(".tempDisabled").removeClass("tempDisabled");
						if (($(this).val()) < 0) {
							$(this).val(0);
							$(this).text('0');
						}
						var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
						var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".single-price-before input").val();
						var productPrice = $(this).parents("tr.single-row-wrapper").find(".unit-price input").val();
						var theUnitTax = $(this).parents("tr.single-row-wrapper").data("tot-taxes");
						var netTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);

						var quantityXprice = Number(productPrice) * Number(theQuantity);
						$(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));

						$(this).parents('.single-row-wrapper').find(".single-price-after").text(netTax.toFixed(2));
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before input").val()) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft')) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
						$('.special-discount-modal').trigger('hidden.bs.modal');
					});
					//**************    Calc while changing single price input ***************
					$(".unit-price input").change(function() {
						var productPrice = $(this).val();
						var priceHasTax = $(this).parents("tr.single-row-wrapper").data('ifhastax');
						//		Getting prices and taxes Code
						if (Number(priceHasTax) === 0) {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
						} else if (Number(priceHasTax) === 1) {
							var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(totalTaxes))));
							var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
							var singlePriceAfter = Number(productPrice);
						} else {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice);
						}
						var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
						var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".single-price-before input").val();
						var theUnitTax = $(this).parents("tr.single-row-wrapper").data("tot-taxes");
						var netTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);
						var quantityXprice = Number(productPrice) * Number(theQuantity);
						$(".tempDisabled").removeClass("tempDisabled");
						$(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-before input").val(singlePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft', singlePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").text(netTax.toFixed(2));
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val()) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft')) * Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
						$(this).parents("tr.single-row-wrapper").find(".product-quantity input").trigger('change');
						$('.special-discount-modal').trigger('hidden.bs.modal');
					});

					function calcInfo() {
						var amountBeforeDariba = 0;
						$(".whole-price-before").each(function() {
							amountBeforeDariba += Number($(this).text());
							$("#amountBeforeDariba1").val(amountBeforeDariba);
						});
						var amountAfterDariba = 0;
						$(".whole-price-after").each(function() {
							amountAfterDariba += Number($(this).text());
						});
						var amountOfDariba = 0;
						$("tr.single-row-wrapper").each(function() {
							var theSingleTax = $(this).find(".single-price-after").text();
							amountOfDariba += Number(theSingleTax);
						});
						$("#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba.toFixed(2));
						$("#amountAfterDariba span.dynamic-span").html(amountAfterDariba.toFixed(2));
						$("#amountOfDariba span.dynamic-span").html(amountOfDariba.toFixed(2));

						$("#amountOfDariba2").val(amountOfDariba);
						console.log($("#amountOfDariba2").val());
						var byAmount = $("input#byAmount").val();
						var byPercentage = $("input#byPercentage").val();
						$("input#byAmount").attr('max', amountAfterDariba);
						var total = 0;
						if (byAmount == 0 && byPercentage == 0) {
							$("#demandedAmount span.dynamic-span").html(amountAfterDariba.toFixed(2));
							total = $("#demandedAmount").val();
							$("#demandedAmount1").val(amountAfterDariba);
						} else {
							$("input#byPercentage").change(function() {
								if ((Number($(this).val())) > 100) {
									alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
									$(this).val(0);
								}
								total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
								$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
								$("#demandedAmount1").val(total);
							});
							$("input#byAmount").change(function() {
								if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
									alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
									$(this).val(0);
								}
								total = Number(amountAfterDariba) - (Number($(this).val()));
								$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
								$("#demandedAmount1").val(total);
							});
						}
						$("input#byPercentage").change(function() {
							if ((Number($(this).val())) > 100) {
								alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
							$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
							$("#demandedAmount1").val(total);
						});
						$("input#byAmount").change(function() {
							if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
								alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number($(this).val()));
							$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
							$("#demandedAmount1").val(total);
						});
					}
					//**************    Calc while changing table body ***********************
					$('#discMod' + rowNum).on('hide.bs.modal', function(e) {
						var modId = $(this).attr('id');
						var onlyModNum = modId.substr(7, modId.length);
						var theUnitPrice = $('#row' + onlyModNum).find(".single-price-before input").val();
						var theQuantity = $('#row' + onlyModNum).find(".product-quantity input").val();
						var theUnitTax = $('#row' + onlyModNum).data("tot-taxes");
						var theSingleTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);
						$('#row' + onlyModNum).find(".single-price-after").text(theSingleTax.toFixed(2));
						$('#row' + onlyModNum).find(".product-quantity input").trigger('change');
					});

					$('#discMod' + rowNum).on('hidden.bs.modal', function(e) {
						var modId = $(this).attr('id');
						var onlyModNum = modId.substr(7, modId.length);
						var finalAftDisc = Number($('#row' + onlyModNum).find('.whole-price-before').attr('tempPriBef'));
						var discountsText = ' **** ';
						var rows = $(this).find('.single-special-dis-wrap');
						for (var i = 0; i < rows.length; i++) {
							finalAftDisc -= Number($(rows[i]).find('.singleSpecialDiscByVal').val());
							finalAftDisc -= (Number($(rows[i]).find('.singleSpecialDiscByPer').val()) / 100) * finalAftDisc;
							$('#row' + onlyModNum).find('.whole-price-before').text(finalAftDisc.toFixed(2));
							if ($(rows[i]).find(".effectTax").is(":checked")) {
								var currentDisc = Number($('#row' + onlyModNum).data('tot-taxes')) / 100;
								var newNetTax = Number(currentDisc) * Number(finalAftDisc);
								$('#row' + onlyModNum).find('.single-price-after').text(newNetTax.toFixed(2));
							} else if (!($(rows[i]).find(".effectTax").is(":checked"))) {
								var newNetTax = $('#row' + onlyModNum).find('.single-price-after').text()
							}

							var newWholePriceAfter = Number(finalAftDisc) + Number(newNetTax);
							$('#row' + onlyModNum).find('.whole-price-after').text(newWholePriceAfter.toFixed(2));
							calcInfo();
						}

						for (var i = 0; i < rows.length; i++) {
							if(($(rows[i]).find('.singleSpecialDiscByVal').val()) > 0){
								discountsText = discountsText + ($(rows[i]).find('.singleSpecialDiscByVal').val()) + 'ريال'
							}else{
								discountsText = discountsText + ($(rows[i]).find('.singleSpecialDiscByPer').val()) + '%'
							}

							if ($(rows[i]).find(".effectTax").is(":checked")) {
								discountsText = discountsText + '(مؤثر على الضرية) **** '
							}else{
								discountsText = discountsText + ' **** '
							}
						}
						$('#row' + onlyModNum).find(".whole-product-discounts").text(discountsText);
					});
					//**************    Calc while changing table body ***********************
					$(".bill-table tbody").change(calcInfo);
					//**************    Calc while removing a product ************************
					$(".remove-prod-from-list").on('click', function(e) {
						e.preventDefault();
						$(this).parents("tr").remove();
						calcInfo();
						var trLen = $(".finalTb  tbody tr").length;
						if (trLen === 0) {
							$('table tfoot').addClass('tempDisabled');
						}
					})
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

$("#barcode_search").scannerDetection({
	timeBeforeScanTest: 200, // wait for the next character for upto 200ms
	avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
	preventDefault: true,
	endChar: [13],
	onComplete: function(barcode, qty){
   		validScan = true;
		$.ajax({
			url: "/accounting/barcode_search/" + barcode,
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
						$('.product-quantity').find('input').trigger('change');
					}
				}
			}
		});
    },
	onError: function(string, qty) {
		$('#barcode_search').val ($('#barcode_search').val()  + string);
		var barcode = $('#barcode_search').val();
		validScan = true;
		$.ajax({
			url: "/accounting/barcode_search/" + barcode,
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
						$('.product-quantity').find('input').trigger('change');
					}
				}
			}
		});

	}
});

	function byBarcode() {
		$(".tempDisabled").removeClass("tempDisabled");
		var selectedProduct = $(".tempobar").find('option').prop('selected', true);
		var ProductId = $('#selectID2').val();
		var productName = selectedProduct.data('name');
					var productLink = selectedProduct.data('link');
					var lastPrice = selectedProduct.data('last-price');
					var avgPrice = selectedProduct.data('average');
					var barCode = selectedProduct.data('bar-code');
					var productPrice = selectedProduct.data('price');
					var priceHasTax = selectedProduct.data('price-has-tax');
					var totalTaxes = selectedProduct.data('total-taxes');
					var productUnits = selectedProduct.data('subunits');
					var expirationDate = selectedProduct.data('product_expiration');
					var dateInpt = '';
					let today = new Date().toISOString().substr(0, 10);
					if (expirationDate == 1) {
						var dateInpt = '<input type="date" class="expiration form-control" name="expire_date" value="' + today + '" , min="' + today + '">';
					} else {
						var dateInpt = '---';
					}
					let unitName = productUnits.map(a => a.name);
					let unitId = productUnits.map(c => c.id);
					let unitPrice = productUnits.map(b => b.purchasing_price);

					//		Getting prices and taxes Code
					var singlePriceBefore, singlePriceAfter = 0;
					if (Number(priceHasTax) === 0) {
						var singlePriceBefore = Number(productPrice);
						var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
					} else if (Number(priceHasTax) === 1) {
						var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(totalTaxes))));
						var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
						var singlePriceAfter = Number(productPrice);
					} else {
						var singlePriceBefore = Number(productPrice);
						var singlePriceAfter = Number(productPrice);
					}
					var netTax = (Number(singlePriceAfter) - Number(singlePriceBefore)).toFixed(2);

					var discountNum = 1;
					var optss = ``;
					for (var i = 0; i < productUnits.length; i++) {
						optss += '<option data-uni-price="' + unitPrice[i] + '" value="' + unitId[i] + '" > ' + unitName[i] + '</option> ';
					}

					$(".bill-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}" data-ifhastax="${priceHasTax}" data-tot-taxes="${totalTaxes}">
							<td class="row-num" width="40">${rowNum}</td>
                            <input type="hidden" name="product_id[]" value="${ProductId}">
							<td class="product-name maybe-hidden name_enable" width="270"><a href="${productLink}" target="_blank" rel="noopener noreferrer">${productName}</a></td>
							<td class="product-unit maybe-hidden unit_enable" width="70">
								<select class="form-control js-example-basic-single" name="unit_id[${ProductId}]" >
									${optss}
								</select>
							</td>
							<td class="product-quantity maybe-hidden quantity_enable" width="70">
								<input type="number" placeholder="الكمية" step="1" min="1" value="1" id="sale" class="form-control" name="quantity[${ProductId}]">
							</td>
							<td class="expiration-date maybe-hidden expiration_enable" width="120">
								${dateInpt}
							</td>
							<td class="unit-price maybe-hidden unit_price_enable" width="70">
								<input type="number" class="form-control" step="any" value="${productPrice}" name="">
							</td>
							<td class="quantityXprice maybe-hidden total_enable" width="70">${productPrice}</td>
							<td class="whole-product-gifts maybe-hidden gifts_enable" width="70">
								<input type="number" placeholder="الهدايا" step="1" min="0" value="0" class="form-control" name="">
							</td>
							<td class="whole-product-discounts maybe-hidden discounts_enable"></td>

							<td class="single-price-before maybe-hidden">
								<input type="number" class="form-control" step="any" value="${singlePriceBefore}" name="prices[${ProductId}]">
							</td>

                            <input type="hidden" name="itemTax[${ProductId}]" value="${netTax}">
							<td class="single-price-after maybe-hidden total_taxes_enable" data-sinAft="${singlePriceAfter}" width="70">
								${netTax}
							</td>
							<td class="whole-price-before maybe-hidden ">${singlePriceBefore}</td>
							<td class="whole-price-after maybe-hidden total_pure_enable" width="70">${singlePriceAfter}</td>

							<td class="bill-operations-td maybe-hidden operations_enable" width="160">
								<a href="${productLink}" target="_blank" title="عرض المنتح" rel="noopener noreferrer">
									<span class="icon-file-text"></span>
								</a>
								<button type="button" title="متوسط السعر" class="btn btn-primary popover-dismiss"
										data-toggle="popover" title="أخر سعر : ${lastPrice}"
										data-container="body" data-toggle="popover"
										data-placement="right" data-content="متوسط السعر : ${avgPrice}">
										<span class="icon-coin-dollar"></span>
								</button>
								<a href="#" data-toggle="modal" title="إضافة خصم" data-target="#discMod${rowNum}"><span class="icon-magic-wand"></span></a>
								<a href="#" title="مسح" class="remove-prod-from-list"><span class="icon-cross"></span></a>
							</td>
						</tr>
					`);
//					$("#row" + rowNum).find('.product-quantity').find('input').trigger('change');
					$(".tempDisabled").removeClass("tempDisabled");
					calcInfo();
					$('.popover-dismiss').popover({
						trigger: 'focus'
					});
					$("#modals-area").append(`<div id="discMod${rowNum}" class="modal fade special-discount-modal" role="dialog">
					  <div class="modal-dialog">
						<div class="modal-content">
						  <div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"> إضافة خصم خاص بالمنتج ${productName} </h4>
						  </div>
						  <div class="modal-body">
							<div class="single-special-dis-wrap clearfix row">
                                <div class="form-group col-xs-4 ddd-none" >
								<label>رقم الخصم</label>
								<input type="text" class="form-control " value=${discountNum} >
							</div>
								<div class="form-group col-xs-4">
									<label>ادخل الخصم بالنسبة</label>
									<input type="number" step="any" class="form-control singleSpecialDiscByPer" value="0" min="0" placeholder="ادخل الخصم بالنسبة" name="items[${rowNum}][discount_item_percentage][]">
								</div>
								<div class="form-group col-xs-4">
									<label>ادخل الخصم بالمبلغ</label>
									<input type="number" step="any" class="form-control singleSpecialDiscByVal" value="0" min="0" placeholder="ادخل الخصم بالمبلغ" name="items[${rowNum}][discount_item_value][]">
								</div>
								<div class="form-group col-xs-4">
									<label>يؤثر في الضريبة <input class="effectTax" type="checkbox" name="items[${rowNum}][discount_item_effectTax][]" value="1"></label>
								</div>
							</div>
							<div class="anotherAddedSpecialDiscounts"></div>
							<div class="row clearfix text-center">
								<a data-id="${rowNum}" class="appendAnewDiscount btn btn-success">إضافة خصم أخر</a>
							</div>
						  </div>
						  <div class="modal-footer Text-center">
							<button type="button" class="btn btn-default" data-dismiss="modal">إتمام</button>
						  </div>
						</div>
					  </div>
					</div>`);
					$("#discMod" + rowNum + "  a.appendAnewDiscount").on('click', function() {
						discountNum++;
						var itemNumber = $(this).data('id');
						$(this).parent().prev('.anotherAddedSpecialDiscounts').append(`<div class="single-special-dis-wrap clearfix row">
                            <div class="form-group col-xs-4 ddd-none">
								<label>رقم الخصم</label>
								<input type="text" class="form-control " value="${discountNum}" >
							</div>
                        	<div class="form-group col-xs-4">
								<label>ادخل الخصم بالنسبة</label>
								<input type="number" step="any" class="form-control singleSpecialDiscByPer" value="0" min="0" placeholder="ادخل الخصم بالنسبة" name="items[${itemNumber}][discount_item_percentage][]">
							</div>
							<div class="form-group col-xs-4">
								<label>ادخل الخصم بالمبلغ</label>
								<input type="number" step="any" class="form-control singleSpecialDiscByVal" value="0" min="0" placeholder="ادخل الخصم بالمبلغ" name="items[${itemNumber}][discount_item_value][]">
							</div>
							<div class="form-group col-xs-4">
								<label>يؤثر في الضريبة <input class="effectTax" type="checkbox" name="items[${rowNum}][discount_item_effectTax][]" value="1"></label>

								</div>
							<a href="#" class="removeThisSinglSpecDisc"><span class="icon-cross"></span></a>
						</div>`);
						$(".product-quantity input").each(function() {
							$(this).trigger('change');
						});
						$("a.removeThisSinglSpecDisc").on('click', function(e) {
							e.preventDefault();
							$(this).parents(".single-special-dis-wrap").remove();
						});
						$(".singleSpecialDiscByPer").each(function() {
							$(this).on('change', function() {
								$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByVal').val(0);
								if (($(this).val()) < 0) {
									$(this).val(0);
									$(this).text('0');
								}
							})
						});
						$(".singleSpecialDiscByVal").each(function() {
							$(this).on('change', function() {
								$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByPer').val(0);
								if (($(this).val()) < 0) {
									$(this).val(0);
									$(this).text('0');
								}
							})
						});
					});
					$(".singleSpecialDiscByPer").each(function() {
						$(this).on('change', function() {
							$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByVal').val(0);
							if (($(this).val()) < 0) {
								$(this).val(0);
								$(this).text('0');
							}
						})
					});
					$(".singleSpecialDiscByVal").each(function() {
						$(this).on('change', function() {
							$(this).parents('.single-special-dis-wrap').find('.singleSpecialDiscByPer').val(0);
							if (($(this).val()) < 0) {
								$(this).val(0);
								$(this).text('0');
							}
						})
					});
					var wholePriceBefore, wholePriceAfter = 0;
					//**************    Calc while changing unit input ***********************
					$(".product-unit select").change(function() {
						$(".tempDisabled").removeClass("tempDisabled");
						var selectedUnit = $(this).find(":selected");
						var priceHasTax = $(this).parents("tr.single-row-wrapper").data('ifhastax');
						var productPrice = selectedUnit.data('uni-price');
						//		Getting prices and taxes Code
						if (Number(priceHasTax) === 0) {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
						} else if (Number(priceHasTax) === 1) {
							var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(totalTaxes))));
							var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
							var singlePriceAfter = Number(productPrice);
						} else {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice);
						}

						var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
						var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".single-price-before input").val();
						var theUnitTax = $(this).parents("tr.single-row-wrapper").data("tot-taxes");
						var quantityXprice = Number(productPrice) * Number(theQuantity);
						$(this).parents('.single-row-wrapper').find(".unit-price input").val(productPrice);
						$(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));
						var netTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);
						$(this).parents('.single-row-wrapper').find(".single-price-before input").val(singlePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft', singlePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").text(netTax.toFixed(2));
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before input").val()) * Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft')) * Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
						$(this).parents("tr.single-row-wrapper").find(".product-quantity input").trigger('change');
						$('.special-discount-modal').trigger('hidden.bs.modal');
					});
					//**************    Calc while changing quantity input *******************
					$(".product-quantity input").change(function() {
						$(".tempDisabled").removeClass("tempDisabled");
						if (($(this).val()) < 0) {
							$(this).val(0);
							$(this).text('0');
						}
						var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
						var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".single-price-before input").val();
						var productPrice = $(this).parents("tr.single-row-wrapper").find(".unit-price input").val();
						var theUnitTax = $(this).parents("tr.single-row-wrapper").data("tot-taxes");
						var netTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);

						var quantityXprice = Number(productPrice) * Number(theQuantity);
						$(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));

						$(this).parents('.single-row-wrapper').find(".single-price-after").text(netTax.toFixed(2));
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before input").val()) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft')) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
						$('.special-discount-modal').trigger('hidden.bs.modal');
					});
					//**************    Calc while changing single price input ***************

					$(".unit-price input").change(function() {
						var productPrice = $(this).val();
						var priceHasTax = $(this).parents("tr.single-row-wrapper").data('ifhastax');
						//		Getting prices and taxes Code
						if (Number(priceHasTax) === 0) {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) / 100));
						} else if (Number(priceHasTax) === 1) {
							var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(totalTaxes))));
							var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
							var singlePriceAfter = Number(productPrice);
						} else {
							var singlePriceBefore = Number(productPrice);
							var singlePriceAfter = Number(productPrice);
						}
						var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
						var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".single-price-before input").val();
						var theUnitTax = $(this).parents("tr.single-row-wrapper").data("tot-taxes");
						var netTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);
						var quantityXprice = Number(productPrice) * Number(theQuantity);
						$(".tempDisabled").removeClass("tempDisabled");
						$(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-before input").val(singlePriceBefore.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft', singlePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".single-price-after").text(netTax.toFixed(2));
						var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val()) * Number($(this).val());
						$(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(2));
						var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after").attr('data-sinAft')) * Number($(this).parents('.single-row-wrapper').find(".product-quantity input").val());
						$(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
						$(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
						$(this).parents("tr.single-row-wrapper").find(".product-quantity input").trigger('change');
						$('.special-discount-modal').trigger('hidden.bs.modal');
					});

					function calcInfo() {
						var amountBeforeDariba = 0;
						$(".whole-price-before").each(function() {
							amountBeforeDariba += Number($(this).text());
							$("#amountBeforeDariba1").val(amountBeforeDariba);
						});
						var amountAfterDariba = 0;
						$(".whole-price-after").each(function() {
							amountAfterDariba += Number($(this).text());
						});
						var amountOfDariba = 0;
						$("tr.single-row-wrapper").each(function() {
							var theSingleTax = $(this).find(".single-price-after").text();
							amountOfDariba += Number(theSingleTax);
						});
						$("#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba.toFixed(2));
						$("#amountAfterDariba span.dynamic-span").html(amountAfterDariba.toFixed(2));
						$("#amountOfDariba span.dynamic-span").html(amountOfDariba.toFixed(2));

						$("#amountOfDariba2").val(amountOfDariba);
						console.log($("#amountOfDariba2").val());
						var byAmount = $("input#byAmount").val();
						var byPercentage = $("input#byPercentage").val();
						$("input#byAmount").attr('max', amountAfterDariba);
						var total = 0;
						if (byAmount == 0 && byPercentage == 0) {
							$("#demandedAmount span.dynamic-span").html(amountAfterDariba.toFixed(2));
							total = $("#demandedAmount").val();
							$("#demandedAmount1").val(amountAfterDariba);
						} else {
							$("input#byPercentage").change(function() {
								if ((Number($(this).val())) > 100) {
									alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
									$(this).val(0);
								}
								total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
								$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
								$("#demandedAmount1").val(total);
							});
							$("input#byAmount").change(function() {
								if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
									alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
									$(this).val(0);
								}
								total = Number(amountAfterDariba) - (Number($(this).val()));
								$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
								$("#demandedAmount1").val(total);
							});
						}
						$("input#byPercentage").change(function() {
							if ((Number($(this).val())) > 100) {
								alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this).val()) / 100));
							$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
							$("#demandedAmount1").val(total);
						});
						$("input#byAmount").change(function() {
							if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span").html())) {
								alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' + $("#amountAfterDariba span.dynamic-span").html());
								$(this).val(0);
							}
							total = Number(amountAfterDariba) - (Number($(this).val()));
							$("#demandedAmount span.dynamic-span").html(total.toFixed(2));
							$("#demandedAmount1").val(total);
						});
					}
					//**************    Calc while changing table body ***********************
					$('#discMod' + rowNum).on('hide.bs.modal', function(e) {
						var modId = $(this).attr('id');
						var onlyModNum = modId.substr(7, modId.length);
						var theUnitPrice = $('#row' + onlyModNum).find(".single-price-before input").val();
						var theQuantity = $('#row' + onlyModNum).find(".product-quantity input").val();
						var theUnitTax = $('#row' + onlyModNum).data("tot-taxes");
						var theSingleTax = (Number(theUnitTax) / 100) * Number(theQuantity) * Number(theUnitPrice);
						$('#row' + onlyModNum).find(".single-price-after").text(theSingleTax.toFixed(2));
						$('#row' + onlyModNum).find(".product-quantity input").trigger('change');
					});

					$('#discMod' + rowNum).on('hidden.bs.modal', function(e) {
						var modId = $(this).attr('id');
						var onlyModNum = modId.substr(7, modId.length);
						var finalAftDisc = Number($('#row' + onlyModNum).find('.whole-price-before').attr('tempPriBef'));
						var discountsText = ' **** ';
						var rows = $(this).find('.single-special-dis-wrap');
						for (var i = 0; i < rows.length; i++) {
							finalAftDisc -= Number($(rows[i]).find('.singleSpecialDiscByVal').val());
							finalAftDisc -= (Number($(rows[i]).find('.singleSpecialDiscByPer').val()) / 100) * finalAftDisc;
							$('#row' + onlyModNum).find('.whole-price-before').text(finalAftDisc.toFixed(2));
							if ($(rows[i]).find(".effectTax").is(":checked")) {
								var currentDisc = Number($('#row' + onlyModNum).data('tot-taxes')) / 100;
								var newNetTax = Number(currentDisc) * Number(finalAftDisc);
								$('#row' + onlyModNum).find('.single-price-after').text(newNetTax.toFixed(2));
							} else if (!($(rows[i]).find(".effectTax").is(":checked"))) {
								var newNetTax = $('#row' + onlyModNum).find('.single-price-after').text()
							}
							var newWholePriceAfter = Number(finalAftDisc) + Number(newNetTax);
							$('#row' + onlyModNum).find('.whole-price-after').text(newWholePriceAfter.toFixed(2));
							calcInfo();
						}

						for (var i = 0; i < rows.length; i++) {
							if(($(rows[i]).find('.singleSpecialDiscByVal').val()) > 0){
								discountsText = discountsText + ($(rows[i]).find('.singleSpecialDiscByVal').val()) + 'ريال'
							}else{
								discountsText = discountsText + ($(rows[i]).find('.singleSpecialDiscByPer').val()) + '%'
							}

							if ($(rows[i]).find(".effectTax").is(":checked")) {
								discountsText = discountsText + '(مؤثر على الضرية) **** '
							}else{
								discountsText = discountsText + ' **** '
							}
						}
						$('#row' + onlyModNum).find(".whole-product-discounts").text(discountsText);
					});
					//**************    Calc while changing table body ***********************
					$(".bill-table tbody").change(calcInfo);
					//**************    Calc while removing a product ************************
					$(".remove-prod-from-list").on('click', function(e) {
						e.preventDefault();
						$(this).parents("tr").remove();
						calcInfo();
						var trLen = $(".finalTb  tbody tr").length;
						if (trLen === 0) {
							$('table tfoot').addClass('tempDisabled');
						}
					})

	}
	$(document).keydown(function(event) {
		if (event.which == 118 || event.which == 13) { //F7
			confirmSubmit(event);
			return false;
		}
	});
	function confirmSubmit(event){
			event.preventDefault();
			swal({
			  title: "تنبيه !",
			  text: "هل أنت متأكد من الحفظ ؟",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			  buttons: ['لا', 'نعم']
			})
			.then((willDelete) => {
			  if (willDelete) {
				$("#buyForm").submit();
			  } else {
				swal({
					title : 'الغاء الحفظ',
					text : 'تم إلغاء الحفظ !',
					icon : 'success',
					buttons : false,
					timer : 1500
				});
			  }
			});
	}
	$(".finalTb button[type='submit']").click(function(event){
			confirmSubmit(event)
	})
</script>

<script>
	$("#supplier_id").on('change', function() {
		var id= $(this).val();
		$.ajax({
			url: "/accounting/getBalance/" + id,
			type: "GET",
		}).done(function (data) {

			$('#balance').val(data.data);
		}).fail(function (error) {
			console.log(error);
		});
	});
	</script>
<script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
<script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>
<!---- new desfign --->
<script>
	//   For Alerting Before closing the window
	window.onbeforeunload = function(e) {
			e = e || window.event;
			if (e) {
				e.returnValue = 'هل انت متأكد من مغادرة الصفحة ؟!';
			}
			return 'هل انت متأكد من مغادرة الصفحة ؟!';
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
