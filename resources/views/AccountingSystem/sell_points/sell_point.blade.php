@extends('AccountingSystem.layouts.master')
@section('title', 'الفاتوره')
@section('parent_title', 'إدارة نقطه البيع')
@section('action', URL::route('accounting.categories.index'))
@section('styles')
    <!--- start datatable -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"
        rel="stylesheet" type="text/css">
    <!--- end datatable -->
    <link href="{{ asset('admin/assets/css/jquery.datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/all.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/bill.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/customized.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div id="container">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">
                    <a href="#" class="btn btn-success bill-cogs go-to-full" id="enlarge-scr">
                        <div class="fullscreen-icon" onclick="toggleFullscreen()">
                            <div class="square  square-1--expand" id="square-1">
                                <div class="triangle triangle-1"></div>
                            </div>
                            <div class="square  square-2--expand" id="square-2">
                                <div class="triangle triangle-2"></div>
                            </div>
                            <div class="square  square-3--expand" id="square-3">
                                <div class="triangle triangle-3"></div>
                            </div>
                            <div class="square  square-4--expand" id="square-4">
                                <div class="triangle triangle-4"></div>
                            </div>
                        </div>
                    </a>
                    نقطة البيع
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
            <div class="panel-body" x-data="{selected:null}">
                <!----------------  Start Bill Content ----------------->
                <section class="yourBill">
                    <div class="yurSections">
                        {{-- @dd(auth()->user()->accounting_store_id) --}}

                        <div class="row table-upper-options">
                            <!-- Nav tabs -->
                            <div class="form-group block-gp col-md-4 col-sm-4 col-xs-12">
                                <label> إسم العميل: </label>
                                {!! Form::select('client', $clients, null, ['class' => 'selectpicker form-control inline-control', 'data-live-search' => 'true', 'id' => 'client_id']) !!}
                            </div>
                            <div class="form-group block-gp col-md-4 col-sm-4 col-xs-12">
                                <label for="bill_date"> تاريخ الفاتورة </label>
                                {!! Form::text('__bill_date', null, ['class' => 'inlinedatepicker form-control inline-control', 'placeholder' => ' تاريخ الفاتورة', 'id' => 'bill_date']) !!}
                            </div>
                            <input type="hidden" value="{{ getsetting('rounding_number') }}" id="ronding-number">
                            @if (getsetting('automatic_sales') == 0)
                                <div class="form-group col-sm-3">
                                    <label> اختر الحساب </label>
                                    {!! Form::select('account_id', accounts(), null, ['class' => 'form-control', 'placeholder' => ' اختر الحساب']) !!}
                                </div>

                            @endif
                            {!! Form::hidden('store_id',request('store_id')??session('store_id'),['id'=>'store_id']) !!}
                            <div class="form-group block-gp col-md-4 col-sm-4 col-xs-12">
                                <div class="yurProdc">
                                    <div class="form-group block-gp">
                                        <label>بحث بإسم الصنف أو الباركود</label>
                                        {{-- <select class=" form-control  products-select" name="product_id"
                                            data-live-search="true" placeholder="اختر المنتج" id="selectID">
                                            <option value=""> حدد المستودع اولا</option>
                                        </select> --}}

                                        <select class="form-control" name="products" id="selectID2"></select>
                                    </div>
                                </div>
                                <div class="tempobar"></div>
                            </div>
                            <div class="form-group block-gp col-md-4 col-sm-4 col-xs-12">
                                <label>بحث بالباركود </label>
                                <input class="form-control" type="text" id="barcode_search">
                            </div>
                        </div>
                    </div>
                    <div class="result">
                        <form method="post" id="sllForm" action="{{ route('accounting.sales.store') }}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $session->user_id }}">
                            <input type="hidden" name="session_id" value="{{ $session->id }}">
                            <input type="hidden" name="shift_id" value="{{ $session->shift_id }}">
                            <input type="hidden" name="bill_date" id="bill_date_val">
                            <input type="hidden" name="client_id" id="client_id_val">
                            <table border="1"
                                class="table datatable-button-init-basic finalTb mabi3at-bill bill-table
                         ace_dark   {{ getsetting('name_enable_sales') == 1 ? 'name_enable' : '' }}
                            {{ getsetting('barcode_enable_sales') == 1 ? 'barcode_enable' : '' }}
                            {{ getsetting('unit_enable_sales') == 1 ? 'unit_enable' : '' }}
                            {{ getsetting('quantity_enable_sales') == 1 ? 'quantity_enable' : '' }}
                            {{ getsetting('unit_price_enable_sales') == 1 ? 'unit_price_after_enable' : '' }}
                            {{ getsetting('total_price_enable_sales') == 1 ? 'total_price_after_enable' : '' }}
                                unit_total_tax_enable">
                                <thead>
                                    <tr>
                                        <th rowspan="2" width="40">م</th>
                                        <th rowspan="2" class="maybe-hidden name_enable">اسم الصنف</th>
                                        <th rowspan="2" class="maybe-hidden barcode_enable" width="140">باركود</th>
                                        <th rowspan="2" class="maybe-hidden unit_enable" width="110">الوحدة</th>
                                        <th rowspan="2" class="maybe-hidden quantity_enable" width="100">الكمية</th>
                                        <th rowspan="2" class="maybe-hidden unit_total_tax_enable" width="100">الضريبة %
                                        </th>
                                        <th colspan="2" class="maybe-hidden unit_price_after_enable" width="100">سعر الوحدة
                                        </th>
                                        <th colspan="2" class="maybe-hidden total_price_after_enable" width="100">صافي
                                            الإجمالى</th>
                                        <th rowspan="2" width="70"> حذف </th>
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
                                            <span id="removeTaxWrap">
                                                <input type="checkbox" id="remove-tax">
                                                <label for="remove-tax">معفي ضريبيا</label>
                                            </span>
                                            <span class="colorfulSpan"> قيمة الضريبة</span>
                                            <input type="hidden" class="dynamic-input" name="totalTaxs"
                                                id="amountOfDariba1">
                                            <span class="dynamic-span">0</span>
                                            <span class="rs"> ر.س </span>
                                        </th>
                                        <th id="amountAfterDariba" class="rel-cols" colspan="3">
                                            <span class="colorfulSpan">المجموع بعد الضريبة</span>
                                            <input type="hidden" class="dynamic-input" name="amount"
                                                id="amountAfterDarib1">
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
                                                        <input type="number" placeholder="النسبة المئوية للخصم" min="0"
                                                            value="0" max="100" step="any" id="byPercentage"
                                                            class="form-control dynamic-input" name="discount_byPercentage">
                                                        <span class="rs"> % </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="rel-cols">
                                                        <label for="byAmount">ادخل مبلغ الخصم</label>
                                                        <input type="number" step="any" placeholder="مبلغ الخصم" min="0"
                                                            value="0" max="1" id="byAmount"
                                                            class="form-control dynamic-input" name="discount_byAmount">
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
                                                    <input type="number" step="any" id="byCache" placeholder="المدفوع كاش"
                                                        min="0" class="form-control dynamic-input" name="cash">
                                                    <span class="rs"> ر.س </span>
                                                </div>
                                                <span> + </span>
                                                <div class="form-group rel-cols">
                                                    <label for="byNet">شبكة</label>
                                                    <input type="number" step="any" id="byNet" placeholder="المدفوع شبكة"
                                                        min="0" class="form-control dynamic-input" name="network">
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
                            @if (auth()->user()->is_saler == 1)
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal">
                                    اغلاق الجلسة [F8]
                                </button>
                            @endif
                            <a class="btn btn-primary" id="add-mortaga3"
                                href="{{ route('accounting.sales.returns', $session->id) }}">
                                اضافة فاتورة مرتجع [F9] </a>
                            <a class="btn btn-warning" id="ta3liik" href="#" target="_blank"> تعليق الفاتورة [F10] </a>
                        </div>
                        @if ($session->user->is_saler == 1)
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> اغلاق الجلسة </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"
                                                action="{{ route('accounting.sales.end', $session->user->is_saler) }}"
                                                id="form1">
                                                @csrf
                                                <input type="hidden" name="session_id" value="{{ $session->id }}">
                                                <label style="color:black"> الباسورد</label>
                                                <input type="password" name="password" class="form-control">
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">اغلاق</button>
                                            <button type="submit" class="btn btn-primary"
                                                onclick="document.getElementById('form1').submit()">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> إزالة الصنف </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
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
                                        <button type="submit" class="btn btn-primary confirm_delete"
                                            id="confirm_delete">تحقق</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!----------------  End Bill Content ----------------->
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <!--- scroll to the last table row -->
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"
            integrity="sha512-WFN04846sdKMIP5LKNphMaWzU7YpMyCU245etK3g/2ARYbPK9Ub18eG+ljU96qKRCWh+quCY7yefSmlkQw1ANQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--- end datatable -->
    <script src="{{ asset('admin/assets/js/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/scanner.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#sllForm').keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
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

        //	get general form data inputs values
        $("#client_id").on('change', function() {
            var client = $(this).val();
            $('#client_id_val').val(client);
        });
        $("#bill_date_val").val(new Date().toLocaleString())
        $("#bill_date").on('change', function() {
            $("#bill_date_val").val($(this).val());
        });

        var rondingNumber = $("#ronding-number").val();

        var rowNum = 0;
        $('#selectID').selectpicker('refresh');

        //	Calculation Function
        function calcBill(selectedProduct, productId, productName, productBarCode, productPrice, priceHasTax, totalTaxes,
            mainUnit, productUnits) {
            rowNum++;
            // alert(productUnits);
            let unitName = productUnits.map(a => a.name);
            let unitPrice = productUnits.map(b => b.selling_price);
            var unitId = productUnits.map(c => c.id);
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
            var optss = ``;
            for (var i = 0; i < productUnits.length; i++) {
                optss += '<option data-uni-price="' + Number(unitPrice[i]).toFixed(rondingNumber) + '" value="' + unitId[
                    i] + '"> ' + unitName[i] + '</option> ';
            }



            $(".bill-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}">
			<td class="row-num" width="40">${rowNum}</td>
			<input type="hidden" name="product_id[]" value="${productId}">
			<td class="product-name maybe-hidden name_enable">${productName}</td>
			<td class="product-name maybe-hidden barcode_enable" width="140">${productBarCode}</td>
			<td class="product-unit maybe-hidden unit_enable" width="110">
				<select class="form-control js-example-basic-single" name="unit_id[${productId}]">
					${optss}
				</select>
			</td>
			<td class="product-quantity maybe-hidden quantity_enable" width="100">
				<input type="number" placeholder="الكمية" max="" min="1" value="1" id="sale" name="quantity[]" class="form-control">
			</td>
			<td class="unit-total-tax maybe-hidden unit_total_tax_enable" width="100">
				<input type="number" placeholder="الضريبة" max="" min="0" data-original-tax="${totalTaxes}" value="${totalTaxes}" name="tax[]" class="form-control">
			</td>
			<td class="single-unit-price maybe-hidden unit_price_after_enable" width="100">${productPrice.toFixed(rondingNumber)}</td>
			<td class="single-price-before maybe-hidden">${singlePriceBefore.toFixed(rondingNumber)}</td>
			<td class="single-price-after maybe-hidden">${singlePriceAfter.toFixed(rondingNumber)}</td>
			<td class="whole-price-before maybe-hidden">${singlePriceBefore.toFixed(rondingNumber)}</td>
			<td class="whole-price-after maybe-hidden total_price_after_enable" width="100">
                ${singlePriceAfter.toFixed(rondingNumber)}
                <input  type="hidden" name="price_after_tax[]" value="${singlePriceAfter}"  class="form-control">
            </td>
			<td class="delete-single-row" width="70">
    @if ($session->user->is_admin == 1)
        <a href="#"><span class="icon-cross"></span></a>
    @else
        <button type="button" class="btn btn-primary in-row-del" data-toggle="modal" data-target="#deleteModal">
            <span class="icon-cross"></span>
        </button>
    @endif
            </td>
        </tr>`);

            var height = $("tbody").height();
            $("tbody").animate({
                scrollTop: $('tbody').prop("scrollHeight")
            }, height);

            //	Remove overlay
            $(".tempDisabled").removeClass("tempDisabled");

            // assign id for the clicked button on the deleting modal
            $(".in-row-del").on('click', function() {
                var tempRowNum = $(this).parents('tr').attr('id');
                $("#deleteModal").attr('data-tempdelrow', tempRowNum);
                $("#confirm_delete").click(function() {
                    var email = $("#email").val();
                    var password = $("#password").val();
                    $.ajax({
                        url: "/accounting/confirm_user/",
                        type: "GET",
                        data: {
                            'email': email,
                            'password': password
                        },
                        success: function(data) {
                            if (data.data == 'success') {
                                $("#" + tempRowNum).remove();
                                $(".bill-table tbody").trigger('change');
                                $('#deleteModal').modal('hide');
                            } else {
                                alert('البيانات التي ادخلتها غير صحيحة .');
                            }
                        },
                        error: function(error) {
                            alert('البيانات التي ادخلتها غير صحيحة .');
                        }
                    });
                });
            })

            $(".unit-total-tax input").each(function() {
                $(this).on('change', function() {
                    totalTaxes = $(this).val();
                    $(this).parents('.single-row-wrapper').find(".product-unit select").trigger('change');
                })
            })

            var wholePriceBefore, wholePriceAfter = 0;
            $(".product-unit select").change(function() {
                var selectedUnit = $(this).find(":selected");
                var productPrice = Number(selectedUnit.data('uni-price'));
                if (Number(priceHasTax) === 0) {
                    var singlePriceBefore = Number(productPrice);
                    var singlePriceAfter = Number(productPrice) + (Number(productPrice) * (Number(totalTaxes) /
                        100));
                } else if (Number(priceHasTax) === 1) {
                    var onllyDariba = Number(productPrice) - (Number(productPrice) * (100 / (100 + Number(
                        totalTaxes))));
                    var singlePriceBefore = Number(productPrice) - Number(onllyDariba);
                    var singlePriceAfter = Number(productPrice);
                } else {
                    var singlePriceBefore = Number(productPrice);
                    var singlePriceAfter = Number(productPrice);
                }
                $(this).parents('.single-row-wrapper').find(".single-unit-price").text(productPrice.toFixed(
                    rondingNumber));
                $(this).parents('.single-row-wrapper').find(".single-price-before").text(singlePriceBefore.toFixed(
                    rondingNumber));
                $(this).parents('.single-row-wrapper').find(".single-price-after").text(singlePriceAfter.toFixed(
                    rondingNumber));
                $(this).parents('.single-row-wrapper').find(".product-quantity input").trigger('change');
            });
            $(".product-quantity input").change(function() {

                if (($(this).val()) < 0) {
                    $(this).val(0);
                    $(this).text('0');
                }
                $(".tempDisabled").removeClass("tempDisabled");
                var wholePriceBefore = Number($(this).parents('.single-row-wrapper').find(".single-price-before")
                    .text()) * Number($(this).val());
                $(this).parents('.single-row-wrapper').find(".whole-price-before").text(wholePriceBefore.toFixed(
                    rondingNumber));
                var wholePriceAfter = Number($(this).parents('.single-row-wrapper').find(".single-price-after")
                    .text()) * Number($(this).val());
                $(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(
                    rondingNumber));
                $(" input#byAmount , input#byPercentage , input#byCache , input#byNet").val(0)
                //						$("input#byNet").trigger('change')
            });
            $(".bill-table tbody").trigger('change');
            $(".delete-single-row a").on('click', function() {
                $(this).parents('tr').remove();
                $(".bill-table tbody").trigger('change');
            })

            $("#remove-tax").change(function() {
                if ($(this).is(':checked')) {
                    $(".unit-total-tax input").each(function() {
                        $(this).val(0);
                        $(this).trigger('change');
                        $(this).attr('readonly', 'readonly')
                    })
                } else {
                    $(".unit-total-tax input").each(function() {
                        $(this).val(Number($(this).attr('data-original-tax')));
                        $(this).trigger('change');
                        $(this).attr('readonly', false)
                    })
                }
            })
        };

        var store_id = $("#store_id").val();
        // var store_id = 1;
        // $('#selectID').removeClass('hidden');
        $('#selectID2').select2({
            ajax: {
                delay: 250,
                url: "/accounting/productsAjex/" + store_id,
                data: function (params) {
                    var query = {
                        search: params.term,
                        page: params.page || 1
                    }
                    return query;
                },


                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    /*
                    *     var productBarCode = selectedProduct.data('bar-code');
            var productPrice = Number(selectedProduct.data('price'));
            var priceHasTax = selectedProduct.data('price-has-tax');
            var totalTaxes = selectedProduct.data('total-taxes');
            var mainUnit = selectedProduct.data('main-unit');
            var productUnits = selectedProduct.data('subunits');*/
                    results = _.toArray(data.data.data);
                    return {
                        results: results,
                        pagination: {
                            more: data.has_more
                        }
                    };
                },
                cache: true
            },
            placeholder: 'Search for a repository',
            minimumInputLength: 1,
            // templateResult: formatRepo,
            // templateSelection: formatRepoSelection,
            delay: 250
        });
        $('#selectID2').on('change', function (e) {
            // $('#selectID2').change(function() {
            $.ajax({
                method: 'GET',
                url: "/accounting/products-single-product/" + e.target.value,
                success: function (resp) {
                    calcBill(resp.id, resp.id, resp.name, resp.bar_code,
                        parseFloat(resp.price), resp.price_has_tax, resp.total_taxes, resp.main_unit, JSON.parse(resp.subunits))
                }
            })

        });

        function formatRepo(repo) {
            if (repo.loading) {
                return repo.text;
            }
            // debugger;

            var $container = $(
                "<div class='select2-result-products-select clearfix'>" +
                "<div class='select2-result-products-select__meta'>" +
                "<div class='select2-result-products-select__title'></div>" +
                "<div class='select2-result-products-select__desc'></div>" +
                "</div>" +
                "</div>"
            );

            $container.find(".select2-result-products-select__title").text(repo.text);
            $container.find(".select2-result-products-select__desc").text(repo.description);


            return $container;
        }



        function formatRepoSelection(repo) {
            return repo.title || repo.bar_code;
        }

        //  Tfoot general bill data calculatoin
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
            $("#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba.toFixed(rondingNumber));
            $("#amountAfterDariba span.dynamic-span").html(amountAfterDariba.toFixed(rondingNumber));
            $("#amountOfDariba span.dynamic-span").html(amountOfDariba.toFixed(rondingNumber));
            $("#amountOfDariba1").val(amountOfDariba);
            $('#amountAfterDarib1').val(amountAfterDariba);

            var byAmount = $("input#byAmount").val();
            var byPercentage = $("input#byPercentage").val();
            $("input#byAmount").attr('max', amountAfterDariba);
            var total = 0;

            if (byAmount == 0 && byPercentage == 0) {
                $("#demandedAmount span.dynamic-span").html(amountAfterDariba.toFixed(rondingNumber));
            } else {
                $("input#byPercentage").change(function() {
                    if ((Number($(this).val())) > 100) {
                        alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
                        $(this).val(100);
                    }
                    total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(
                            this)
                        .val()) / 100));
                    $("#demandedAmount span.dynamic-span").html(total.toFixed(rondingNumber));
                    $("#total").val(total);
                });
                $("input#byAmount").change(function() {
                    if ((Number($(this).val())) > Number($(
                                "#amountAfterDariba span.dynamic-span")
                            .html())) {
                        alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' +
                            $(
                                "#amountAfterDariba span.dynamic-span").html());
                        $(this).val(0);
                    }
                    total = Number(amountAfterDariba) - (Number($(this).val()));
                    $("#demandedAmount span.dynamic-span").html(total.toFixed(rondingNumber));
                    $("#total").val(total);
                });
            }
            $("input#byPercentage").change(function() {
                if ((Number($(this).val())) > 100) {
                    alert('لا يمكن ان تكون قيم الخصم بالنسبة أكبر من 100% .');
                    $(this).val(100);
                }
                total = Number(amountAfterDariba) - (Number(amountAfterDariba) * (Number($(this)
                        .val()) /
                    100));
                $("#demandedAmount span.dynamic-span").html(total.toFixed(rondingNumber));
                $("#total").val(total);
            });
            $("input#byAmount").change(function() {
                if ((Number($(this).val())) > Number($("#amountAfterDariba span.dynamic-span")
                        .html())) {
                    alert('عفوا , لا يمكن ان تكون كمية الخصم أكبر من المجموع بعد الضريبة : ' +
                        $(
                            "#amountAfterDariba span.dynamic-span").html());
                    $(this).val(0);
                }
                total = Number(amountAfterDariba) - (Number($(this).val()));
                $("#demandedAmount span.dynamic-span").html(total.toFixed(rondingNumber));
                $("#total").val(total);
            });
            $("#byCache , #byNet").change(function() {
                var allPaid = Number($("#byCache").val()) + Number($("#byNet").val());
                $("#allPaid").html(allPaid.toFixed(rondingNumber));
                $("#allPaid1").val(allPaid);
                var remaindedAmount = Number(allPaid) - Number($(
                        "#demandedAmount span.dynamic-span")
                    .html());
                $("#remaindedAmount span.dynamic-span").html(remaindedAmount.toFixed(
                    rondingNumber));
                $('#remainder-inputt').val(Math.abs(remaindedAmount));
                if (remaindedAmount > 0) {
                    $("#remaindedAmount .rel-cols").removeClass("aagel-case").removeClass(
                            "tmam-case")
                        .addClass("motabaqy-case");
                } else if (remaindedAmount < 0) {
                    $("#remaindedAmount .rel-cols").removeClass("motabaqy-case").removeClass(
                            "tmam-case")
                        .addClass("aagel-case");
                } else {
                    $("#remaindedAmount .rel-cols").removeClass("motabaqy-case").removeClass(
                            "aagel-case")
                        .addClass("tmam-case");
                }
            })
        });




        $("#store_id").on('change', function() {
            var store_id = $(this).val();
            //	For Ajax Search By Product Bar Code
            $("#barcode_search").scannerDetection({
                timeBeforeScanTest: 200, // wait for the next character for upto 200ms
                avgTimeByChar: 40, // it's not a barcode if a character takes longer than 100ms
                preventDefault: true,
                endChar: [13],
                onComplete: function(barcode, qty) {
                    validScan = true;
                    $.ajax({
                        url: "/accounting/barcode_search_sale/" + barcode,
                        type: "GET",
                        data: {
                            store_id: store_id,
                        },
                        success: function(data) {
                            if (data.data.length !== 0) {
                                $('#barcode_search').val('');
                                $(".tempobar").html(data.data);
                                var selectedID = $(".tempobar").find('option')
                                    .data(
                                        'unit-id');
                                var alreadyChosen = $(
                                    ".bill-table tbody td select option[value=" +
                                    selectedID + "]");
                                var repeatedInputVal = $(
                                        ".bill-table tbody td select option[value=" +
                                        selectedID + "]:selected").parents('tr')
                                    .find(
                                        '.product-quantity').find('input');
                                if (alreadyChosen.length > 0 && alreadyChosen
                                    .is(
                                        ':selected')) {
                                    repeatedInputVal.val(Number(repeatedInputVal
                                            .val()) +
                                        1);
                                    repeatedInputVal.text(repeatedInputVal
                                        .val());
                                    $('.product-quantity').find('input')
                                        .trigger(
                                            'change');
                                } else {
                                    $('#barcode_search').val('');
                                    rowNum++;
                                    byBarcode();
                                    $('.product-quantity').find('input')
                                        .trigger(
                                            'change');
                                }
                            }
                        }
                    });
                },
                onError: function(string, qty) {
                    $('#barcode_search').val($('#barcode_search').val() + string);
                    var barcode = $('#barcode_search').val();
                    validScan = true;
                    $.ajax({
                        url: "/accounting/barcode_search_sale/" + barcode,
                        type: "GET",
                        data: {
                            store_id: store_id,
                        },
                        success: function(data) {
                            if (data.data.length !== 0) {
                                $('#barcode_search').val('');
                                $(".tempobar").html(data.data);
                                var selectedID = $(".tempobar").find('option')
                                    .data(
                                        'unit-id');
                                var alreadyChosen = $(
                                    ".bill-table tbody td select option[value=" +
                                    selectedID + "]");
                                var repeatedInputVal = $(
                                        ".bill-table tbody td select option[value=" +
                                        selectedID + "]:selected").parents('tr')
                                    .find(
                                        '.product-quantity').find('input');
                                if (alreadyChosen.length > 0 && alreadyChosen
                                    .is(
                                        ':selected')) {
                                    repeatedInputVal.val(Number(repeatedInputVal
                                            .val()) +
                                        1);
                                    repeatedInputVal.text(repeatedInputVal
                                        .val());
                                    $('.product-quantity').find('input')
                                        .trigger(
                                            'change');
                                } else {
                                    $('#barcode_search').val('');
                                    rowNum++;
                                    byBarcode();
                                    $('.product-quantity').find('input')
                                        .trigger(
                                            'change');
                                }
                            }
                        }
                    });

                }
            });
        });

        function byBarcode() {
            $(".tempDisabled").removeClass("tempDisabled");
            $(".tempobar").find('option').prop('selected', true);
            var selectedProduct = $(".tempobar").find('option').prop('selected', true);
            var productId = $('option.ssID').val();
            var productName = selectedProduct.text();
            var productBarCode = selectedProduct.data('bar-code');
            var productPrice = Number(selectedProduct.data('price'));
            var priceHasTax = selectedProduct.data('price-has-tax');
            var totalTaxes = selectedProduct.data('total-taxes');
            var mainUnit = selectedProduct.data('main-unit');
            var productUnits = selectedProduct.data('subunits');
            console.log('in barcode')
            console.table(productUnits)
            calcBill(selectedProduct, productId, productName, productBarCode, productPrice, priceHasTax,
                totalTaxes,
                mainUnit, productUnits)
        }
        $(document).keydown(function(event) {
            if (event.which == 118) { //F7 حفظ
                confirmSubmit(event);
                return false;
            }
            if (event.which == 119) { //F8 اغلاق الجلسة
                $("button[data-target='#exampleModal']").trigger('click');
                return false;
            }
            if (event.which == 120) { //F9 اضافة مرتجع
                window.open(
                    "{{ route('accounting.sales.returns', $session->id) }}",
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

        function confirmSubmit(event) {
            var feloos = Number($("tr#remaindedAmount span.dynamic-span").text());
            if (feloos >= 0) {
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
                            swal("جار الحفظ !", {
                                icon: "success",
                                buttons: false
                            });
                            $("#sllForm").submit();
                        } else {
                            swal({
                                title: 'الغاء الحفظ',
                                text: 'تم إلغاء الحفظ !',
                                icon: 'success',
                                buttons: false,
                                timer: 1500
                            });
                        }
                    });
            } else {
                event.preventDefault();
                swal({
                    title: "تنبيه !",
                    text: "عفوا , لابد من استيفاء المبلوغ المطلوب دفعه قبل حفظ الفاتورة",
                    icon: "warning",
                    buttons: false,
                    timer: 1500
                })
            }
        }
        $(".finalTb button[type='submit']").click(function(event) {
            confirmSubmit(event)
        })
    </script>
    <script src="{{ asset('admin/assets/js/get_branch_by_company.js') }}"></script>
    <script src="{{ asset('admin/assets/js/get_store_by_company_and_branchs.js') }}"></script>
    <!---- new design --->
    <script>
        @if (!empty(session()->has('sale_id')))
            @php($sale_id = session()->get('sale_id'))
            window.open(
            "{{ route('accounting.sales.show', $sale_id) }}",
            "_blank"
            ).print();
        @endif
    </script>
    <script>
        //   For Alerting Before closing the window
        // window.onbeforeunload = function(e) {
        //     e = e || window.event;
        //     if (e) {
        //         e.returnValue = 'هل انت متأكد من مغادرة الصفحة ؟!';
        //     }
        //     return 'هل انت متأكد من مغادرة الصفحة ؟!';
        // };

        function refreshTime() {
            var today = new Date();
            var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            var dateTime = date + ' ' + time;
            document.getElementById("theTime").innerHTML = dateTime;
        }
        setInterval(refreshTime, 1000)
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#enlarge-scr").click(function() {
                $("body").toggleClass("full-scr");
                $(this).toggleClass("go-to-full go-to-min")
            })

            $(".go-to-full").click(function() {
                var elem = document.body; // Make the body go full screen.
                requestFullScreen(elem);
            })
            $(".go-to-min").click(function() {
                var ele = document.body; // Make the body go full screen.
                extFullScreen(ele);
            })

        })

        var isFullscreen = false;

        function toggleFullscreen() {
            var container = document.getElementById("container");

            if (isFullscreen) {
                document.webkitCancelFullScreen();
            } else {
                container.webkitRequestFullScreen();
            }

            isFullscreen = !isFullscreen;

            var square1 = document.getElementById("square-1");
            var square2 = document.getElementById("square-2");
            var square3 = document.getElementById("square-3");
            var square4 = document.getElementById("square-4");

            if (isFullscreen) {
                square1.className = "square  square-1--reduce";
                square2.className = "square  square-2--reduce";
                square3.className = "square  square-3--reduce";
                square4.className = "square  square-4--reduce";
            } else {
                square1.className = "square  square-1--expand";
                square2.className = "square  square-2--expand";
                square3.className = "square  square-3--expand";
                square4.className = "square  square-4--expand";
            }
        }
    </script>
@endsection
