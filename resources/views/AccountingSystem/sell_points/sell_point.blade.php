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


            <div class="result" id="the-choseen-parts">
                <form method="post" action="{{route('accounting.sales.store')}}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$session->user_id}}">
                    <input type="hidden" name="session_id" value="{{$session->id}}">
                    <input type="hidden" name="shift_id" value="{{$session->shift_id}}">

                    <table border="1" class="finalTb">
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
                            <!----->
                            <tr>
<!--                                <th colspan="4" rowspan="1"></th>-->
                                <th rowspan="1">قبل الضريبة</th>
                                <th rowspan="1">بعد الضريبة</th>
                                <th rowspan="1">قبل الضريبة</th>
                                <th rowspan="1">بعد الضريبة</th>

<!--                                <th rowspan="1"></th>-->
                            </tr>
                        </thead>
                        
                        
                        <!------------ tbody ----->
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>كوب</td>
                                <td>
                                    <select class="form-control js-example-basic-single" name="product_id" placeholder="اختر الوحدة">
                                        <option>قطعة 1</option>
                                        <option>قطعة 2</option>
                                        <option>قطعة 3</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="discount" placeholder="الكمية" min="0" max="100" id="sale" class="form-control">
                                </td>
                                <td>20</td>
                                <td>25</td>
                                <td>60</td>
                                <td>85</td>
                                <td>
                                    <button type="button" class="delete_tr"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>2</td>
                                <td>كرسي</td>
                                <td>
                                    <select class="form-control js-example-basic-single" name="product_id" placeholder="اختر الوحدة">
                                        <option>قطعة 1</option>
                                        <option>قطعة 2</option>
                                        <option>قطعة 3</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="discount" placeholder="الكمية" min="0" max="100" id="sale" class="form-control">
                                </td>
                                <td>20</td>
                                <td>25</td>
                                <td>60</td>
                                <td>85</td>
                                <td>
                                    <button type="button" class="delete_tr"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                            
                        </tbody>
                        <tfoot>


                            <tr id="amountBeforeDariba">
                                <th colspan="2"> المجموع</th>
                                <input type="hidden" name="">
                                <th colspan="7" class="rel-cols">5338
                                    <span class="rs"> ر.س </span>
                                </th>
                            </tr>


                            <tr id="amountOfDariba">
                                <th colspan="2"> قيمة الضريبة</th>
                                <input type="hidden" name="">
                                <th colspan="7" class="rel-cols">5338
                                    <span class="rs"> ر.س </span>
                                </th>
                            </tr>


                            <tr id="amountAfterDariba">
                                <th colspan="2">المجموع بعد الضريبة</th>
                                <input type="hidden" name="amount" id="amount">
                                <th colspan="7" class="rel-cols" id="allResult">5338
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
                                            <label for="asPercent">ادخل نسبة الخصم</label>
                                            <input type="number" name="discount" placeholder="النسبة المئوية للخصم" min="0" max="100" id="sale" class="form-control">
                                            <span class="rs"> % </span>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="rel-cols">
                                            <label for="asVal">ادخل مبلغ الخصم</label>
                                            <input type="number" name="discount" placeholder="مبلغ الخصم" min="0" max="100" id="sale" class="form-control">
                                            <span class="rs"> ر.س </span>
                                        </div>
                                    </div>
                                    </div>
                                </th>
                            </tr>


                            <tr class="amountAfterSale">
                                <th colspan="2">المطلوب دفعه</th>
                                <input type="hidden" name="total" id="total">
                                <th colspan="7" id="reminder" class="rel-cols">
                                    456566
                                    <span class="rs"> ر.س </span>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2">المدفوع</th>
                                <th colspan="7">
                                    <div class="inline_divs">
                                    <div class="form-group rel-cols">
                                        <label>كاش</label>
                                        <input type="number" id="paid" name="payed" placeholder="المدفوع كاش" min="0" class="form-control">
                                        <span class="rs"> ر.س </span>
                                    </div>
                                    <span> + </span>
                                    <div class="form-group rel-cols">
                                        <label>شبكة</label>
                                        <input type="number" id="paid" name="payed" placeholder="المدفوع شبكة" min="0" class="form-control">
                                        <span class="rs"> ر.س </span>
                                    </div>
                                    <div class="rel-cols">
                                        <b>6767</b>
                                        <span class="rs"> ر.س </span>
                                    </div>
                                    </div>
                                </th>
                            </tr>

                            <tr>
                                <th colspan="2">المتبقي</th>
                                <th colspan="7" id="lastreminder" class="rel-cols">
                                    435
                                    <span class="rs"> ر.س </span>
                                </th>
                                <input type="hidden" id="reminder1" name="reminder">
                            </tr>
                            <!--
                                    <tr>
                                        <th colspan="2">العميل</th>
                                        <th>
                                            {!! Form::select("client_id",$clients,null,['class'=>'form-control','placeholder'=>'اسم العميل '])!!}
                                        </th>
                                    </tr>
-->

                            <input type="hidden" id="totalTaxs" name="totalTaxs">
                            <!--
                                    <tr>
                                        <th colspan="2">طريقه الدفع</th>
                                        <th colspan="2">
                                            <div class="col-xs-12">
                                                <div class="col-xs-12">
                                                    <label class="form-label"> طرق الدفع </label>
                                                </div>
                                                <div class="col-sm-6 col-xs-12">
                                                    <div class="form-group form-float">

                                                        <div class="form-line">
                                                            <label> نقدا</label>
                                                            <input type="radio" name="pay" value="1" id="cash">

                                                            <div class="form-group">
                                                                <label class="radios">كاش</label>
                                                                <input type="number" name="_pay[cash]" class="_payed form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="radios">شبكة</label>
                                                                <input type="number" name="_pay[network]" class="_payed form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-xs-12">
                                                    <div id="pay_agel">
                                                        <div class="form-group form-float">
                                                            <div class="form-line">
                                                                <label> اجل</label>
                                                                <input type="radio" name="pay" value="0" id="agel">


                                                                <div class="agel">
                                                                    <div class="row ">
                                                                        <div class="col-md-6">
                                                                            <div class="form-group ">
                                                                                <label> المبلغ المدفوع</label>
                                                                                <input type="text" name="payed" class="form-control" id="agel2" style="width:90px">
                                                                            </div>
                                                                            <div class="form-group ">
                                                                                <label> المتبقى</label>
                                                                                <input type="text" name="delayed" class="form-control" disabled="disabled" id="reminder2" style="width:90px">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </th>




                                    </tr>
-->

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

                {{-- <label class="btn btn-success"> <a href="{{route('accounting.sales.end',$session->id)}}">اغلاق الجلسة</a></label> --}}

            </div>


        </section>
        <!----------------  End Bill Content ----------------->
    </div>
</div>
@endsection

@section('scripts')
<!------------ IF Checked --------------->
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
               
                
                $('.yurProdc').html("");
                $('.yurProdc').append(data.data);
                $('.if-check').change(function() {
                    if ($(this).is(':checked')) {
                        console.log("-----------------------------------------");
                        var itemName = $(this).parent(".prod1").find(".new-p").find('.name').html();
                        var itemId = $(this).parent(".prod1").find(".new-p").find('.id').val();
                        console.log("The Product Name is : " + itemName);
                        var ifHasTax = $(this).parent(".prod1").find('.ifHasTax').html();
                        console.log("The " + itemName + " item Tax Type is" + ifHasTax);
                        var totalTaxes = $(this).parent(".prod1").find('.totalTaxes').html();
                        console.log("The " + itemName + " item Total Taxes is" + totalTaxes);
                        var itemPrice = parseFloat($(this).next('.new-p').find('.pric-holder').val());
                        var totalR = parseFloat(itemPrice);
                        console.log("The Total Money is : " + totalR);
                        var itemAfterTax;
                        var itemBeforeTax;
                        if (ifHasTax == 0) {
                            itemAfterTax = parseFloat(itemPrice) + (parseFloat(itemPrice) * (parseFloat(totalTaxes) / 100));
                            itemBeforeTax = parseFloat(itemPrice);
                        } else {
                            itemBeforeTax = parseFloat(itemPrice) / (1 + (parseFloat(totalTaxes) / 100));
                            itemAfterTax = parseFloat(itemPrice);
                        }
                        $('#totalTaxs').val(totalTaxes);
                        console.log("The price Before : " + itemBeforeTax);
                        console.log("The price After : " + itemAfterTax);
                        $(".finalTb tbody").append(`
							<tr class="newProd" data-id="prod${itemId}">
								<td>
									<input type="hidden" name="product_id[]" value="${itemId}">
									<input type="hidden" value="${itemName}">
									<h4>${itemName}</h4>
								</td>
								<td class="quantity-controller">
									<input type="number" name="quantity[]" min="1" value="1">
								</td>
								<td class="priceBe">
									<input type="hidden" value="${itemBeforeTax}">
									<span class="qnt singleBefore" data-p="${itemBeforeTax}">${itemBeforeTax}</span>
								</td>
								<td class="priceAf">
									<input type="hidden" value="${itemAfterTax}">
									<span class="qnt singleprice" data-p="${itemAfterTax}">${itemAfterTax}</span>
									<a class="close" data-remo="prod${itemId}"><i class="fas fa-times"></i></a>
								</td>
							</tr>
						`);

                        $(".quantity-controller input").change(function() {
                            var newItemQuantity = $(this).val();
                            var priceBe = $(this).parents("tr").find(".priceBe").find(".singleBefore");
                            var priceAf = $(this).parents("tr").find(".priceAf").find(".singleprice");
                            if (newItemQuantity == null || newItemQuantity == 0) {
                                priceBe.html(priceBe.attr('data-p'));
                                priceAf.html(priceAf.attr('data-p'));
                            } else {
                                priceBe.html(parseFloat(priceBe.attr('data-p')) * parseFloat(newItemQuantity));
                                priceAf.html(parseFloat(priceAf.attr('data-p')) * parseFloat(newItemQuantity));
                                var allResult = 0;
                                $("#the-choseen-parts .singleprice").each(function() {
                                    allResult += parseFloat($(this).html());
                                });
                                $("#amount").val(allResult);
                                $("#allResult").html(allResult);
                                var allBeforeResult = 0;
                                $("#the-choseen-parts .singleBefore").each(function() {
                                    allBeforeResult += parseFloat($(this).html());
                                });
                                $("#amountBeforeDariba input").val(allBeforeResult);
                                $("#amountBeforeDariba input").next('th').html(allBeforeResult);
                                var safyDariba = parseFloat(allResult) - parseFloat(allBeforeResult);
                                $("#amountOfDariba input").val(safyDariba);
                                $("#amountOfDariba input").next('th').html(safyDariba);
                            }
                        })

                        var allResult = 0;
                        $("#the-choseen-parts .singleprice").each(function() {
                            allResult += parseFloat($(this).html());
                        });
                        $("#amount").val(allResult);
                        $("#allResult").html(allResult);
                        var allBeforeResult = 0;
                        $("#the-choseen-parts .singleBefore").each(function() {
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
                            allReminder = parseFloat($("#allResult").html()) - ((parseFloat($(this).val()) * parseFloat($("#allResult").html())) / 100);
                            console.log('change val is' + allReminder);
                            $("#total").val(allReminder);
                            $("#reminder").html(allReminder);
                        });
                        $('.discount-options span').click(function() {
                            $('#sale').val('');
                            $("#reminder").html('');
                            if ($('#asPercent').is(':checked')) {
                                $('#sale').attr('placeholder', 'النسبة المئوية للخصم');
                                $('#sale').change(function() {
                                    allReminder = parseFloat($("#allResult").html()) - ((parseFloat($(this).val()) * parseFloat($("#allResult").html())) / 100);
                                    console.log('change val is' + allReminder);
                                    $("#total").val(allReminder);
                                    $("#reminder").html(allReminder);
                                });
                            } else {
                                $('#sale').attr('placeholder', 'قيمة الخصم بالريال');
                                $('#sale').change(function() {
                                    allReminder = parseFloat($("#allResult").html()) - parseFloat($(this).val());
                                    console.log('change val is' + allReminder);
                                    $("#total").val(allReminder);
                                    $("#reminder").html(allReminder);
                                });
                            }
                        });
                        var lastReminder = 0;
                        $('#paid').change(function() {
                            console.log('alnateg' + parseFloat($("#reminder").html()));
                            console.log('elinput' + parseFloat($(this).val()));
                            lastReminder = parseFloat($("#reminder").html()) - parseFloat($(this).val());
                            $("#lastreminder").html(lastReminder);
                            $("#reminder1").val(lastReminder);
                        });
                        /********************/
                    } else {
                        var itemElseId = $(this).parent(".prod1").find(".new-p").find('.id').val();
                        $("tr[data-id='prod" + itemElseId + "']").remove()
                    }
                    /**********************  Remove Piece *****************/


                    $(".close").click(function() {
                        $(this).parents('.newProd').remove();
                        var allResult = 0;
                        $("#the-choseen-parts .singleprice").each(function() {
                            allResult += parseFloat($(this).html());
                        });
                        $("#allResult").html(allResult);
                        var sale = $("#sale").val();
                        var allReminder = 0;
                        $('#sale').change(function() {
                            console.log('change val is' + allReminder);
                            $("#reminder").html(allReminder);
                        });
                        allReminder = parseFloat($("#allResult").html()) - ((parseFloat($("#sale").val()) * parseFloat($("#allResult").html())) / 100);
                        $("#reminder").html(allReminder);
                        var lastReminder = 0;
                        $('#paid').change(function() {
                            console.log('alnateg' + parseFloat($("#reminder").html()));
                            console.log('elinput' + parseFloat($(this).val()));
                        });
                        lastReminder = parseFloat($("#reminder").html()) - parseFloat($("#paid").val());
                        $("#lastreminder").html(lastReminder);
                        if ($(".finalTb tbody tr").length === 0) {
                            $("#sale").val("");
                            $("#paid").val("");
                            $("#lastreminder").html('');
                        }
                    })

                });


                $("tbody tr.newProd").each(function() {
                    var rowID = $(this).attr('data-id').substr(4, 1);
                    console.log(rowID);
                    $(".prod1 input.if-check[data-id='" + rowID + "']").prop('checked', true);
                })



                $(".fxd-btn").click(function() {
                    addClicked()
                });

                 $('#selectID').addClass('selectpicker');
$('#selectID').attr('data-live-search', 'true');
$('#selectID').selectpicker('refresh');
            }
        });
    });

    $('#pro_search').keyup(function(e) {

        var pro_search = $(this).val();

        // if (e.keyCode == 13) {
        // alert(pro_search);
        $.ajax({
            url: "/accounting/pro_search/" + pro_search,
            type: "GET",


            success: function(data) {

                $('.yurProdc').empty();
                $('.yurProdc').html(data.data);
                 $('#selectID').addClass('selectpicker');
$('#selectID').attr('data-live-search', 'true');
$('#selectID').selectpicker('refresh');
            }
        });
        // }
    });


    $('#barcode_search').keyup(function(e) {

        var barcode_search = $(this).val();

        // if (e.keyCode == 13) {
        // alert(pro_search);
        $.ajax({
            url: "/accounting/barcode_search/" + barcode_search,
            type: "GET",


            success: function(data) {

                $('.yurProdc').empty();
                $('.yurProdc').html(data.data);
                 $('#selectID').addClass('selectpicker');
$('#selectID').attr('data-live-search', 'true');
$('#selectID').selectpicker('refresh');
            }
        });
        // }
    });

</script>


<script src="{{asset('admin/assets/js/get_branch_by_company.js')}}"></script>
<script src="{{asset('admin/assets/js/get_store_by_company_and_branchs.js')}}"></script>


<!---- new design --->
<script>
    /*** delete tr ***/
    $(".delete_tr").click(function(){
       $(this).parents("tr").remove(); 
    });
    
/*** time and date ***/
var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time;
document.getElementById("theTime").innerHTML = dateTime;
    
</script>


@endsection
