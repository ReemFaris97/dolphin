@extends('AccountingSystem.layouts.master')
@section('title','الفاتوره')
@section('parent_title','إدارة نقطه البيع')
@section('action', URL::route('accounting.categories.index'))
@section('styles')
<!--    <link href="{!! asset('dashboard/assets/bill.css')!!}" rel="stylesheet" type="text/css"/>-->

<link href="{{asset('admin/assets/css/all.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('admin/assets/css/bill.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('content')

    <div class="panel panel-flat">
        <div class="panel-heading">
            <h5 class="panel-title">نقطة البيع</h5>

                {{-- <label>اسم الكاشير  </label>
                  {{$session->user_id}} --}}



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

                            {!! Form::select("store_id",stores(),null,['class'=>'form-control js-example-basic-single store_id','id'=>'store_id','placeholder'=>' اختر اسم المخزن التابع له المنتج '])!!}

                    </div>


                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="yurSections">

                            <div class="col-xs-12">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
      @foreach ($categories as $category)
    <li role="presentation"><a href="#mobile" aria-controls="mobile" role="tab" data-toggle="tab" onclick="category({{$category->id}})" class="category">{{$category->ar_name}}</a></li>
          @endforeach
  </ul>


                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" >
                                    <div class="yurProdc">
                                        {{--<div class="col-lg-4 col-sm-12 col-xs-6">--}}
                                            {{--<div class="prod1">--}}
                                                {{--<div class="inDetails"></div>--}}
                                                {{--<input type="checkbox" class="if-check" id="myCheckbox1" data-price="650"/>--}}
                                                {{--<label class="new-p" for="myCheckbox1">--}}
                                                    {{--<span class="price">650 ر.س</span>--}}
                                                    {{--<img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">--}}
                                                    {{--<h4 class="name">منتج متوسط السعر تج متوسط السعر </h4>--}}
                                                {{--</label>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}

                                    </div>
                                </div>



                            </div>

                            <div class="col-xs-12">
                                <input class="fxd-btn" id="fxd-btn" type="submit" value="إتمام" data-dismiss='modal' disabled>
                            </div>

                        </div>
                    </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="result" id="the-choseen-parts">
                            <form method="post" action="{{route('accounting.sales.store')}}">
                                @csrf
                            <table border="1" class="finalTb">
                                <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر قبل الضريبة</th>
                                    <th>السعر بعد الضريبة</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                	<tr id="amountBeforeDariba">
										<th colspan="2"> المجموع</th>
										<input type="hidden" name="">
										<th colspan="2"></th>
									</tr>
                                	<tr id="amountOfDariba">
										<th colspan="2"> قيمة الضريبة</th>
										<input type="hidden" name="">
										<th colspan="2"></th>
									</tr>
									<tr>
										<th colspan="2">المجموع بعد الضريبة</th>
										<input type="hidden" name="amount" id="amount">
										<th colspan="2" id="allResult" ></th>
									</tr>
									<tr>
										<th colspan="2">الخصم</th>
										<th colspan="2"><input type="number" name="discount" placeholder="نسبة الخصم" min="0" max="100" id="sale"></th>
									</tr>
									<tr>
										<th colspan="2">المجموع بعد الخصم</th>
										<input type="hidden" name="total" id="total">
										<th colspan="2" id="reminder"></th>
									</tr>
									<tr>
										<th colspan="2">المدفوع</th>
										<th colspan="2"><input type="number" id="paid"name="" placeholder="المدفوع" min="0" ></th>
									</tr>
									<tr>
										<th colspan="2">المتبقي</th>
										<th colspan="2" id="lastreminder"></th>
										<input type="hidden"  id="reminder1" name="reminder">
									</tr>
									<tr>
										<th colspan="2">العميل</th>
										<th colspan="2">
											{!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>'اسم العميل '])!!}
										</th>
									</tr>
									<tr>
										<th colspan="2">طريقه الدفع</th>
										<th colspan="2">
											{!! Form::select("payment",pay_type(),null,['class'=>'form-control','placeholder'=>'طريقه الدفع '])!!}
										</th>
									</tr>
									<tr>
                                    <th colspan="4">
                                  		<button type="submit">دفع</button>
                                    </th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <!----------------  End Bill Content ----------------->
        </div>
    </div>
@endsection
@section('scripts')
    <!------------ IF Checked --------------->
    <script>
		function  category(id) {
    $.ajax({
        type: 'get',
        url: "/accounting/productsAjex/" + id,
        data: {id: id},
        dataType: 'json',
        success: function (data) {
            $('.yurProdc').html("");
            $('.yurProdc').append(data.data);
            var numberOfItems = 0;
            $('.if-check').change(function() {
                var $this = $(this);
                if ($this.is(':checked')) {
                    var newInput = $(`<div class="addme">
							<div class="quant">
								<div class="count">
									<div class="value-button cart-qty-plus"> <i class="fas fa-arrow-circle-up"></i> </div>
										<input type="number" readonly min="1" value="1" id="number" class="number">
									<div class="value-button cart-qty-minus"> <i class="fas fa-arrow-circle-down"></i> </div>
								</div>
							</div>
						</div>`);
                    $($this).prev('.inDetails').append(newInput);
                    numberOfItems++;
                    //                    input number simulator function
                    var incrementPlus;
                    var incrementMinus;
                    var buttonPlus = $(this).parents('.prod1').find(".addme").find(".cart-qty-plus");
                    var buttonMinus = $(this).parents('.prod1').find(".addme").find(".cart-qty-minus");
                    var incrementPlus = buttonPlus.click(function() {
                        var $n = $(this)
                            .parent(".count")
                            .parent(".quant")
                            .find(".number");
                        $n.val(Number($n.val()) + 1);
                    });
                    var incrementMinus = buttonMinus.click(function() {
                        var $n = $(this)
                            .parent(".count")
                            .parent(".quant")
                            .find(".number");
                        var amount = Number($n.val());
                        if (amount > 1) {
                            $n.val(amount - 1);
                        }
                    });
                } else {
                    $($this).parent(".prod1").find('.inDetails').find('.addme').remove();
                    numberOfItems--;
                }
                console.log("The Number of Selected Items is : " + numberOfItems);
                if (numberOfItems == 0) {
                    $(".fxd-btn").attr('disabled', 'true');
                } else {
                    $(".fxd-btn").removeAttr('disabled');
                }
            });
			
			function addClicked()  {
                $(".finalTb tbody").html('');
                $('.if-check').each(function() {
                    if ($(this).is(':checked')) {
						console.log("-----------------------------------------");
                        var itemName = $(this).parent(".prod1").find(".new-p").find('.name').html();
                        var itemId = $(this).parent(".prod1").find(".new-p").find('.id').val();
                        console.log("The Product Name is : " + itemName);
                        var itemQuantity = parseFloat($(this).parent('.prod1').find('.inDetails').find('input').val());
                        console.log("The " + itemName + " item Quantity is" + itemQuantity);
						var ifHasTax = $(this).parent(".prod1").find('.ifHasTax').html();
						console.log("The " + itemName + " item Tax Type is" + ifHasTax);
						var totalTaxes = $(this).parent(".prod1").find('.totalTaxes').html();
						console.log("The " + itemName + " item Total Taxes is" + totalTaxes);
                        var itemPrice = parseFloat($(this).next('.new-p').find('.pric-holder').val());
						var totalR = parseFloat(itemQuantity) * parseFloat(itemPrice) ;
                        console.log("The Total Money is : " + totalR);
						var itemAfterTax;
						var itemBeforeTax;
						if (ifHasTax == 0){
							itemAfterTax = parseFloat(itemPrice) + (parseFloat(itemPrice) * (parseFloat(totalTaxes) / 100));
							itemBeforeTax = parseFloat(itemPrice);
						} else {
							itemBeforeTax = parseFloat(itemPrice) / (1 + (parseFloat(totalTaxes) / 100));
							itemAfterTax = parseFloat(itemPrice);
						}
						console.log("The price Before : " + itemBeforeTax);
						console.log("The price After : " + itemAfterTax);
						
						var AllQuantityAfter = (parseFloat(itemAfterTax) * parseFloat(itemQuantity)).toFixed(2);
						var AllQuantityBefore = (parseFloat(itemBeforeTax) * parseFloat(itemQuantity)).toFixed(2);
                        
                        $(".finalTb tbody").append(`
							<tr class="newProd" data-id="prod${itemId}">
								<td>
									<input type="hidden" name="product_id[]" value="${itemId}">
									<input type="hidden" value="${itemName}">
									<h4>${itemName}</h4>
								</td>
								<td>
									<input type="hidden" name="quantity[]" value="${itemQuantity}">
									<span class="qnt">${itemQuantity}</span>
								</td>
								<td>
									<input type="hidden" value="${AllQuantityBefore}">
									<span class="qnt singleBefore">${AllQuantityBefore}</span>
								</td>
								<td>
									<input type="hidden" value="${AllQuantityAfter}">
									<span class="qnt singleprice">${AllQuantityAfter}</span>
									<a class="close" data-remo="prod${itemId}"><i class="fas fa-times"></i></a>
								</td>
							</tr>
						`);
                        var allResult = 0;
                        $("#the-choseen-parts .singleprice").each(function(){
                            allResult += parseFloat($(this).html());
                        });
                        $("#amount").val(allResult);
                        $("#allResult").html(allResult);
						var allBeforeResult = 0;
                        $("#the-choseen-parts .singleBefore").each(function(){
                            allBeforeResult += parseFloat($(this).html());
                        });
                        $("#amountBeforeDariba input").val(allBeforeResult);
                        $("#amountBeforeDariba input").next('th').html(allBeforeResult);
						var safyDariba = parseFloat(allResult) - parseFloat(allBeforeResult);
                        $("#amountOfDariba input").val(safyDariba);
                        $("#amountOfDariba input").next('th').html(safyDariba);
                        var sale = $("#sale").val();
                        var allReminder = 0;
                        $('#sale').change(function() {
                            allReminder =  parseFloat($("#allResult").html()) - ((parseFloat($(this).val()) * parseFloat($("#allResult").html())) / 100); console.log('change val is' + allReminder);
                            $("#total").val(allReminder);
                            $("#reminder").html(allReminder);
                        });
                        var lastReminder = 0;
                        $('#paid').change(function() {
                            console.log('alnateg' + parseFloat($("#reminder").html()));
                            console.log('elinput' + parseFloat($(this).val()));
                            lastReminder =   parseFloat($("#reminder").html())- parseFloat($(this).val());
                             $("#lastreminder").html(lastReminder);
                            $("#reminder1").val(lastReminder);
                        });
                        /********************/
                    }
                    /**********************  Remove Piece *****************/

                });
			$(".close").click(function(){
			$(this).parents('.newProd').remove();
			var allResult = 0;
			$("#the-choseen-parts .singleprice").each(function(){
				allResult += parseFloat($(this).html());
			});
			$("#allResult").html(allResult);
			var sale = $("#sale").val();
			var allReminder = 0;
			$('#sale').change(function() {console.log('change val is' + allReminder);
			   $("#reminder").html(allReminder);
			});
			allReminder =  parseFloat($("#allResult").html()) - ((parseFloat($("#sale").val()) * parseFloat($("#allResult").html())) / 100);
			$("#reminder").html(allReminder);
			var lastReminder = 0;
		   $('#paid').change(function() {
				console.log('alnateg' + parseFloat($("#reminder").html()));
			   console.log('elinput' + parseFloat($(this).val()));
			});
			lastReminder =   parseFloat($("#reminder").html()) - parseFloat($("#paid").val()) ;
			$("#lastreminder").html(lastReminder);
		   if ($(".finalTb tbody tr").length === 0) {
		   $("#sale").val("");
		   $("#paid").val("");
		   $("#lastreminder").html('');
			}
					})
            }


            $(".fxd-btn").click(function(){
				addClicked()
			});


        }
    });
}


    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>
    <script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
    <script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>

@endsection
