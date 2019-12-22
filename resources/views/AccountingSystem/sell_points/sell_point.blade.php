@extends('AccountingSystem.layouts.master')
@section('title','نقطة البيع')





{{--@section('title') الفاتورة--}}
<link href="{!! asset('dashboard/assets/bill.css')!!}" rel="stylesheet" type="text/css"/>

@section('header')
@endsection

@section('breadcrumb') @php($breadcrumbs=['المخازن'=>route('distributor.stores.index'),])
@includeWhen(isset($breadcrumbs),'distributor.layouts._breadcrumb', ['breadcrumbs' =>$breadcrumbs ])
@endsection

@section('content')

    <div class="m-portlet m-portlet--mobile">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        الفاتورة
                    </h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body">
            <!----------------  Start Bill Content ----------------->
            <section class="yourBill">
                <div class="row">

                    <div class="col-md-8 col-sm-6 col-12">
                        <div class="yurSections">
                            <ul class="nav nav-tabs">
                                {{--<li class="active"><a href="#">الكل</a></li>--}}
                                {{--<li><a href="#">هواتف محمولة</a></li>--}}
                                {{--<li><a href="#">منتجات متنوعة</a></li>--}}
                                {{--<li><a href="#">حاسب ومستلزماته</a></li>--}}

                                @foreach ($categories as $category)
                                    <li><a  data-toggle="tab" role="tab" aria-controls="menu{{$category->id}}" href="#menu{{$category->id}}">{{$category->ar_name}}</a></li>

                                @endforeach
                            </ul>
                            <div class="yurProdc" >

                                    @foreach ($categories as $category)
                                        @foreach ($category->products()->get() as $product)
                                        <div role="tabpanel" id="#menu{{$category->id}}" class="tab-pane" >

                                        <div class="col-md-3 col-sm-4 col-6" >
                                          <div class="prod1">
                                        <div class="inDetails"></div>
                                        <input type="checkbox" class="if-check" id="myCheckbox{{$product->id}}" data-price="650"/>
                                        <label class="new-p" for="myCheckbox{{$product->id}}">

                                            <span class="price">{{$product->selling_price}} ر.س</span>

                                            <img src="https://www.itl.cat/pngfile/big/30-303191_background-images-for-editing-editing-pictures-background-background.jpg">
                                            <h4 class="name"> {{$product->name}} </h4>
                                        </label>
                                           </div>
                                        </div>
                                        </div>

                                    @endforeach

                                        @endforeach

                                <div class="col-12">
                                    <input class="fxd-btn" id="fxd-btn" type="submit" value="إتمام" data-dismiss='modal' disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12">
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
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}


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

                        $(".finalTb tbody").append('<tr class="newProd"><td><a class="close"> <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="times" role="img"xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" data-fa-i2svg=""><path fill="currentColor" d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z"></path></svg></a><input type="hidden" value="' + itemName + '"> <h4> ' + itemName + '</h4> </td><td><input type="hidden" value="' + itemQuantity + '"> <span class="qnt"> ' + itemQuantity + '</span></td><td><input type="hidden" value="' + totalR + '"> <span class="qnt singleprice"> ' + totalR + '</span></td></tr>');

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
                        $(this).parent(".newProd").remove();
                    });
                });

            });
            // alert(allResult);
        });



    </script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}

@endsection
