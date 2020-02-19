@extends('AccountingSystem.layouts.master')
@section('title','الفاتوره')
@section('parent_title','إدارة نقطه البيع')
@section('action', URL::route('accounting.categories.index'))
@section('styles')
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
                <div class="row">
                    <!-- Nav tabs -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label> اسم الكاشير </label> :
                            {{$session->user->name}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group"><label> اسم الوردية </label> :

                            {{$session->shift->name}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label> تاريخ الجلسة </label> :
                            {{$session->start_session}}
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label> إسم العميل </label> :
                            {!! Form::select("client_id",$clients,null,['class'=>'selectpicker form-control inline-control','placeholder'=>'اختر اسم العميل','data-live-search'=>'true'])!!}
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
                <form method="post" action="{{route('accounting.sales.store')}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$session->user_id}}">
                    <input type="hidden" name="session_id" value="{{$session->id}}">
                    <input type="hidden" name="shift_id" value="{{$session->shift_id}}">
                    <table border="1" class="finalTb mabi3at-bill bill-table">
                        <thead>
                            <tr>
                                <th rowspan="2">م</th>
                                <th rowspan="2">اسم الصنف</th>
                                <th rowspan="2">الوحدة</th>
                                <th rowspan="2">الكمية</th>
                                <th colspan="2" rowspan="1" class="th_lg">
                                    سعر الوحدة
                                </th>
                                <th colspan="2" rowspan="1" class="th_lg">
                                    الإجمالى
                                </th>
                                <th rowspan="2"> حذف </th>
                            </tr>
                            <tr>
                                <th rowspan="1">قبل الضريبة</th>
                                <th rowspan="1">بعد الضريبة</th>
                                <th rowspan="1">قبل الضريبة</th>
                                <th rowspan="1">بعد الضريبة</th>
                            </tr>
                        </thead>
                        <tbody>
<!--						Space For Appended Products-->
                        </tbody>
                        <tfoot>
                            <tr id="amountBeforeDariba">
                                <th colspan="2"> المجموع</th>
                                <input type="hidden" class="dynamic-input">
                                <th colspan="7" class="rel-cols">
                                   <span class="dynamic-span">214</span>
                                   <span class="rs"> ر.س </span>
                                </th>
                            </tr>
                            <tr id="amountOfDariba">
                                <th colspan="2"> قيمة الضريبة</th>
                                <input type="hidden" class="dynamic-input">
                                <th colspan="7" class="rel-cols">
                                   <span class="dynamic-span">484</span>
                                   <span class="rs"> ر.س </span>
                                </th>
                            </tr>
                            <tr id="amountAfterDariba">
                                <th colspan="2">المجموع بعد الضريبة</th>
                                <input type="hidden" class="dynamic-input">
                                <th colspan="7" class="rel-cols">
									<span class="dynamic-span">782</span>
                                    <span class="rs"> ر.س </span>
                                </th>
                            </tr>
                            <tr id="discountArea">
                                <th colspan="2">
                                    الخصم
                                </th>
                                <th colspan="7" >
                                    <div class="inline_divs">
                                    <div class="form-group">
                                        <div class="rel-cols">
                                            <label for="byPercentage">ادخل نسبة الخصم</label>
                                            <input type="number" placeholder="النسبة المئوية للخصم" min="0" max="100" id="byPercentage" 
                                            class="form-control dynamic-input">
                                            <span class="rs"> % </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="rel-cols">
                                            <label for="byAmount">ادخل مبلغ الخصم</label>
                                            <input type="number" placeholder="مبلغ الخصم" min="0" max="100" id="byAmount"
                                            class="form-control dynamic-input">
                                            <span class="rs"> ر.س </span>
                                        </div>
                                    </div>
                                    </div>
                                </th>
                            </tr>
                            <tr class="demandedAmount">
                                <th colspan="2">المطلوب دفعه</th>
                                <input type="hidden" name="total" id="total">
                                <th colspan="7" id="reminder" class="rel-cols">
                                    <span class="dynamic-span">8485</span>
                                    <span class="rs"> ر.س </span>
                                </th>
                            </tr>
                            <tr class="paidAmount">
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
											<span class="dynamic-span">782</span>
											<span class="rs"> ر.س </span>
										</div>
                                    </div>
                                </th>
                            </tr>
                            <tr class="remaindedAmount">
                                <th colspan="2">المتبقي</th>
                                <th colspan="7" id="lastreminder" class="rel-cols">
                                    <span class="dynamic-span">458</span>
                                    <span class="rs"> ر.س </span>
                                </th>
                                <input type="hidden" class="dynamic-input" name="reminder">
                            </tr>
                            <input type="hidden" id="totalTaxs" name="totalTaxs">
                            <tr>
                                <th colspan="9">
                                    <button type="submit">حفظ</button>
                                </th>
                            </tr>
                        </tfoot>
                    </table>

                </form>
                <div class="newly-added-2-btns-">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        اغلاق الجلسة
                    </button>
                    <a class="btn btn-danger" href="{{route('accounting.sales.returns',$session->id)}}"> اضافة فاتورة مرتجع</a>
                    <a class="btn btn-warning" href="{{route('accounting.sales.end',$session->id)}}"> تعليق الفاتورة</a>
                </div>
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
                                <form method="post" action="{{route('accounting.sales.end',$session->id)}}" id="form1">
                                    @csrf
                                    <label style="color:black"> عهده الخزنه</label>
                                    <input type="text" name="custody" class="form-control">
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary" onclick="document.getElementById('form1').submit()">حفظ</button>
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
<script>
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
				 $('#selectID').selectpicker('refresh');
				 var rowNum = 0;
				 $('#selectID').change(function(){			
					 rowNum ++;
					 var selectedProduct = $(this).find(":selected");
					 var productName = selectedProduct.text();
					 var productPrice = selectedProduct.data('price');
					 var priceHasTax = selectedProduct.data('price-has-tax');
					 var totalTaxes = selectedProduct.data('total-taxes');
					 var mainUnit = selectedProduct.data('main-unit');
					 var productUnits = selectedProduct.data('subunits');
					 let unitName = productUnits.map(a => a.name);
					 let unitPrice = productUnits.map(b => b.purchasing_price);
					 var singlePriceBefore , singlePriceAfter = 0;
					 if (Number(priceHasTax) === 0){
						 var singlePriceBefore = Number(productPrice);
						 var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes)/100));
					 }else if (Number(priceHasTax) === 1){
						 var singlePriceBefore = Number(productPrice) - (Number(productPrice) * (Number(totalTaxes)/100));
						 var singlePriceAfter = Number(productPrice);
					 }else{
						 var singlePriceBefore = Number(productPrice);
						 var singlePriceAfter = Number(productPrice);
					 }
					 var optss = `<option data-uni-price="${productPrice}">${mainUnit}</option>`;
					 for(var i=0 ; i < productUnits.length ; i++){
						 optss += '<option data-uni-price="' + unitPrice[i] + '"> ' + unitName[i] + '</option> ';
					 }
				 	 $(".bill-table tbody").append(`<tr class="single-row-wrapper">
							<td class="row-num">${rowNum}</td>
							<td class="product-name">${productName}</td>
							<td class="product-unit">
								<select class="form-control js-example-basic-single">
									${optss}
								</select>
							</td>
							<td class="product-quantity">
								<input type="number" placeholder="الكمية" min="0" value="1" id="sale" class="form-control">
							</td>
							<td class="single-price-before">${singlePriceBefore}</td>
							<td class="single-price-after">${singlePriceAfter}</td>
							<td class="whole-price-before">${singlePriceBefore}</td>
							<td class="whole-price-after">${singlePriceAfter}</td>
							<td class="delete-single-row">
								<button type="button" class="delete_tr"><i class="fas fa-times"></i></button>
							</td>
						</tr>`);
						 var wholePriceBefore , wholePriceAfter = 0;
					 	 $(".product-unit select").change(function(){
							 var selectedUnit = $(this).find(":selected");
							 var productPrice = selectedUnit.data('uni-price');
							 if (Number(priceHasTax) === 0){
								 alert('0');
								 var singlePriceBefore = Number(productPrice);
								 var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes)/100));
							 }else if (Number(priceHasTax) === 1){
								 alert('1');
								 var singlePriceBefore = Number(productPrice) - (Number(productPrice) * (Number(totalTaxes)/100));
								 var singlePriceAfter = Number(productPrice);
							 }else{
								 alert('no');
								 var singlePriceBefore = Number(productPrice);
								 var singlePriceAfter = Number(productPrice);
							 }
							 $(this).parents('tr.single-row-wrapper').find(".single-price-before").text(singlePriceBefore.toFixed(1));
							 $(this).parents('tr.single-row-wrapper').find(".single-price-after").text(singlePriceAfter.toFixed(1));
						 });
						 $(".product-quantity input").change(function(){
							 if(($(this).val()) < 0){
								 $(this).val(0);
								 $(this).text('0');
							 }
							 var wholePriceBefore = Number($(this).parents('tr.single-row-wrapper').find(".single-price-before").text()) * Number($(this).val());
							 $(this).parents('tr.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(1));
							 var wholePriceAfter = Number($(this).parents('tr.single-row-wrapper').find(".single-price-after").text()) * Number($(this).val());
							 $(this).parents('tr.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(1));
						 });
					 })
				
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
//	window.onbeforeunload = function (e) {
//		e = e || window.event;
//		if (e) {
//			e.returnValue = 'هل أنت متأكد من غلق هذه الصفحة ؟ سيتم فقدان كال البيانات التي تم ادخالها!!';
//		}
//		return 'هل أنت متأكد من غلق هذه الصفحة ؟ سيتم فقدان كال البيانات التي تم ادخالها!!';
//	};
	function refreshTime(){
		var today = new Date();
		var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
		var dateTime = date+' '+time;
		document.getElementById("theTime").innerHTML = dateTime;
	}
	setInterval(refreshTime , 1000)
</script>
@endsection