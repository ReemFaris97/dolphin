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

                    <div class="col-md-8 col-sm-6 col-xs-12">
                        <div class="yurSections">

                            <div class="col-xs-12">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">الكل</a></li>
    <li role="presentation"><a href="#mobile" aria-controls="mobile" role="tab" data-toggle="tab">هواتف محمولة</a></li>
    <li role="presentation"><a href="#products" aria-controls="products" role="tab" data-toggle="tab">منتجات متنوعة</a></li>
    <li role="presentation"><a href="#computing" aria-controls="computing" role="tab" data-toggle="tab">حاسب ومستلزماته</a></li>
  </ul>
                                
                                
                            <div class="tab-content " >

                                
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="yurProdc">
                                        <div class="col-lg-4 col-sm-12 col-xs-6">
                                            <div class="prod1">
                                                <div class="inDetails"></div>
                                                <input type="checkbox" class="if-check" id="myCheckbox1" data-price="650"/>
                                                <label class="new-p" for="myCheckbox1">
                                                    <span class="price">650 ر.س</span>
                                                    <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                    <h4 class="name">منتج متوسط السعر تج متوسط السعر </h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-6">
                                            <div class="prod1">
                                                <div class="inDetails"></div>
                                                <input type="checkbox" class="if-check" id="myCheckbox2" data-price="860" />
                                                <label class="new-p" for="myCheckbox2">
                                                    <div class="inDetails"></div>
                                                    <span class="price">860 ر.س</span>
                                                    <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                    <h4 class="name">منتج متوسط السعر تج متوسط السعر </h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-6">
                                            <div class="prod1">
                                                <div class="inDetails"></div>
                                                <input type="checkbox" class="if-check" id="myCheckbox3" data-price="6300" />
                                                <label class="new-p" for="myCheckbox3">
                                                    <div class="inDetails"></div>
                                                    <span class="price">6300 ر.س</span>
                                                    <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                    <h4 class="name">منتج متوسط السعر تج متوسط السعر </h4>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-12 col-xs-6">
                                            <div class="prod1">
                                                <div class="inDetails"></div>
                                                <input type="checkbox" class="if-check" id="myCheckbox4" data-price="5000" />
                                                <label class="new-p" for="myCheckbox4">
                                                    <div class="inDetails"></div>
                                                    <span class="price">5000 ر.س</span>
                                                    <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                    <h4 class="name">السعر السعرالسعرالسعر </h4>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

<div role="tabpanel" class="tab-pane active" id="mobile">
    <div class="col-lg-4 col-sm-12 col-xs-6">
                                        <div class="prod1">
                                            <div class="inDetails"></div>
                                            <input type="checkbox" class="if-check" id="myCheckbox5" data-price="280" />
                                            <label class="new-p" for="myCheckbox5">
                                                <div class="inDetails"></div>
                                                <span class="price">280 ر.س</span>
                                                <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                <h4 class="name">متوسط متوسط متوسط متوسط </h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-6">
                                        <div class="prod1">
                                            <div class="inDetails"></div>
                                            <input type="checkbox" class="if-check" id="myCheckbox6" data-price="330" />
                                            <label class="new-p" for="myCheckbox6">
                                                <div class="inDetails"></div>
                                                <span class="price">330 ر.س</span>
                                                <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                <h4 class="name">منتج منتجمنتج </h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="col-lg-4 col-sm-12 col-xs-6">
                                        <div class="prod1">
                                            <div class="inDetails"></div>
                                            <input type="checkbox" class="if-check" id="myCheckbox5" data-price="280" />
                                            <label class="new-p" for="myCheckbox5">
                                                <div class="inDetails"></div>
                                                <span class="price">280 ر.س</span>
                                                <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                <h4 class="name">متوسط متوسط متوسط متوسط </h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-6">
                                        <div class="prod1">
                                            <div class="inDetails"></div>
                                            <input type="checkbox" class="if-check" id="myCheckbox6" data-price="330" />
                                            <label class="new-p" for="myCheckbox6">
                                                <div class="inDetails"></div>
                                                <span class="price">330 ر.س</span>
                                                <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                <h4 class="name">منتج منتجمنتج </h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="computing" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="col-lg-4 col-sm-12 col-xs-6">
                                        <div class="prod1">
                                            <div class="inDetails"></div>
                                            <input type="checkbox" class="if-check" id="myCheckbox5" data-price="280" />
                                            <label class="new-p" for="myCheckbox5">
                                                <div class="inDetails"></div>
                                                <span class="price">280 ر.س</span>
                                                <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                <h4 class="name">متوسط متوسط متوسط متوسط </h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-12 col-xs-6">
                                        <div class="prod1">
                                            <div class="inDetails"></div>
                                            <input type="checkbox" class="if-check" id="myCheckbox6" data-price="330" />
                                            <label class="new-p" for="myCheckbox6">
                                                <div class="inDetails"></div>
                                                <span class="price">330 ر.س</span>
                                                <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                                <h4 class="name">منتج منتجمنتج </h4>
                                            </label>
                                        </div>
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
                            <table border="1" class="finalTb">
                                <thead>
                                <tr>
                                    <th>المنتج</th>
                                    <th>الكمية</th>
                                    <th>السعر</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th colspan="2">المجموع</th>
                                    <th id="allResult"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">الخصم</th>
                                    <th> <input type="number" placeholder="نسبة الخصم" min="0" max="100" id="sale"> </th>
                                </tr>
                                <tr>
                                    <th colspan="2">المجموع بعد الخصم</th>
                                    <th id="reminder"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">المدفوع</th>
                                    <th ><input type="number" id="paid" placeholder="المدفوع" min="0" max="100"></th>
                                </tr>
                                <tr>
                                    <th colspan="2">المتبقي</th>
                                    <th id="lastreminder"></th>
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
        $(document).ready(function() {
            var numberOfItems = 0;
            $('.if-check').change(function() {
                var $this = $(this);
                if ($this.is(':checked')) {
                    var newInput = $('<div class="addme"><div class="quant"><div class="count"><div class="value-button cart-qty-plus" > <i class="fas fa-arrow-circle-up"></i> </div><input type="number" readonly min="1" value="1" id="number" class="number"><div class="value-button cart-qty-minus" > <i class="fas fa-arrow-circle-down"></i> </div></div></div></div>');
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
                console.log(numberOfItems);
                if (numberOfItems == 0) {
                    $(".fxd-btn").attr('disabled', 'true');
                } else {
                    $(".fxd-btn").removeAttr('disabled');
                }
            });
            $(".fxd-btn").click(function() {
                $(".finalTb tbody").html('');
                $('.if-check').each(function() {
                    if ($(this).is(':checked')) {
                        var itemName = $(this).parent(".prod1").find(".new-p").find('.name').html();
                        console.log(itemName);

                        var itemQuantity = parseFloat($(this).parent('.prod1').find('.inDetails').find('input').val());
                        console.log(itemQuantity);


                        var itemPrice = parseFloat($(this).attr("data-price"));

                        var totalR= parseFloat(itemQuantity) * parseFloat(itemPrice) ;

//                        var totalR =( $(itemQuantity).text() * $(itemPrice).text() );

//                        $(".totalB").text(itemQuantity * itemPrice);
//		              var totalR = $(".totalB").text();
                        console.log(totalR);

                        $(".finalTb tbody").append('<tr class="newProd"><td><input type="hidden" value="' + itemName + '"> <h4> ' + itemName + '</h4> </td><td><input type="hidden" value="' + itemQuantity + '"> <span class="qnt"> ' + itemQuantity + '</span></td><td><input type="hidden" value="' + totalR + '"> <span class="qnt singleprice"> ' + totalR + '</span><a class="close"><i class="fas fa-times"></a></td></tr>');

                        var allResult = 0;

                        $("#the-choseen-parts .singleprice").each(function(){
                            allResult += parseFloat($(this).html());
                        });

                        $("#allResult").html(allResult);


                        var sale = $("#sale").val();
                        var allReminder = 0;

                        $('#sale').change(function() {
                            allReminder =  parseFloat($("#allResult").html()) - ((parseFloat($(this).val()) * parseFloat($("#allResult").html())) / 100); console.log('change val is' + allReminder);
                            $("#reminder").html(allReminder);
                        });
                        var lastReminder = 0;
                        $('#paid').change(function() {
                            console.log('alnateg' + parseFloat($("#reminder").html()));
                            console.log('elinput' + parseFloat($(this).val()));
                            lastReminder =  parseFloat($(this).val()) - parseFloat($("#reminder").html());
                            $("#lastreminder").html(lastReminder);
                        });


                        /********************/


                    }

                    /**********************  Remove Piece *****************/
                    $(".close").click(function() {
                        $(this).parents(".newProd").remove();

                        var allResult = 0;

                        $("#the-choseen-parts .singleprice").each(function(){
                            allResult += parseFloat($(this).html());
                        });

                        $("#allResult").html(allResult);


                        var sale = $("#sale").val();
                        var allReminder = 0;

//                        $('#sale').change(function() {console.log('change val is' + allReminder);
//                            $("#reminder").html(allReminder);
//                        });


                        allReminder =  parseFloat($("#allResult").html()) - ((parseFloat($("#sale").val()) * parseFloat($("#allResult").html())) / 100);
                        $("#reminder").html(allReminder);


                        var lastReminder = 0;
//                        $('#paid').change(function() {
//                            console.log('alnateg' + parseFloat($("#reminder").html()));
//                            console.log('elinput' + parseFloat($(this).val()));
//                        });
//

                        lastReminder =  parseFloat($("#paid").val()) - parseFloat($("#reminder").html());
                        $("#lastreminder").html(lastReminder);

//                        if ($(".finalTb tbody").html('')) {
//                        $("#sale").val("0");
//                        $("#paid").val("0");
//                        $("#lastreminder").html('');
//                    }

                    });


                });

            });


        });

    </script>
@endsection
