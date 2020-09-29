function myFun3(event) {

    // console.log(event);
        event.preventDefault();
        var offer_data = {};
        offer_data.child_product = $('#child_product option:selected').text();
        offer_data.child_product_val = $('#child_product').val();
        if (offer_data.child_product !== '') {
            $("tr.editted-row").remove();
            swal({
                title: "تم إضافة  المنتج التابع بنجاح",
                text: "",
                icon: "success",
                buttons: ["موافق"],
                dangerMode: true,
            })
            bigDataOffer.push(offer_data);
            $("#offerTable-wrap").show();
            var appendOffer = bigDataOffer.map(function(offer) {
                return (`
                <tr class="single-product">
                    <td class="child_product">${offer.child_product}</td>
                  <td>
                    <a href="#" data-toggle="modal" class="edit-this-row-offer" data-target="#exampleModal3" data-original-title="تعديل">
                        <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                    </a>
                    <a href="#" data-toggle="tooltip" class="delete-this-row-offer" data-original-title="حذف">
                        <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                    </a>
                </td>
            <input type="hidden" name="offers[]" value="${offer.child_product_val}" >
                </tr>
                `);
            });
            $('.add-offers').empty().append(appendOffer);
            //////////////////////////////////////////////////////////////////////
            $('.delete-this-row-offer').click(function(e) {
                var $this = $(this);
                var row_index_offer = $(this).parents('tr').index();
                e.preventDefault();
                swal({
                    title: "هل أنت متأكد ",
                    text: "هل تريد حذف هذا  المنتج؟",
                    icon: "warning",
                    buttons: ["الغاء", "موافق"],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $this.parents('tr').remove();
                        bigDataOffer.splice(row_index_offer, 1);
                    } else {
                        swal("تم االإلفاء", "حذف  المنتج تم الغاؤه", 'info', {
                            buttons: 'موافق'
                        });
                    }
                });
            });
            $('.edit-this-row-offer').click(function(e) {
                var $this = $(this);
                e.preventDefault();
                $this.parents('tr').addClass('editted-row');
                $('#exampleModal3 #child_product').val($('.child_product option:selected').text());
                var row_index_edit_offer = $(this).parents('tr').index();
                bigDataOffer.splice(row_index_edit_offer, 1);
            });
            document.getElementById("name").val = " ";
            $('[data-dismiss=modal]').on('click', function(e) {
                var $t = $(this),
                        target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
                $(target)
                        .find("input,textarea,select")
                        .val('')
                        .end()
                        .find("input[type=checkbox], input[type=radio]")
                        .prop("checked", "")
                        .end();
            })
        } else {
            swal({
                title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
                text: "",
                icon: "warning",
                buttons: ["موافق"],
                dangerMode: true,
            })
        } ///if_end
    }
