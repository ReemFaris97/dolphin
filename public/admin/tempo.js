            success: function(data) {
                $('.yurProdc').html(data.data);
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
                        });
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
                });
                $(".fxd-btn").click(function() {
                    addClicked()
                });
                 $('#selectID').addClass('selectpicker');
				 $('#selectID').attr('data-live-search', 'true');
				 $('#selectID').selectpicker('refresh');
            }