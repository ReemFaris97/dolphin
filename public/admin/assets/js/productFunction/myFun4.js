function myFun4(event) {
    event.preventDefault();
    var discount_data = {};
    discount_data.basic_quantity = $('#basic_quantity').val();
    discount_data.gift_quantity = $('#gift_quantity').val();
    if (discount_data.basic_quantity !== '' && discount_data.gift_quantity !== '') {
        $("tr.editted-row").remove();
        swal({
            title: "تم إضافة  الخصم بنجاح",
            text: "",
            icon: "success",
            buttons: ["موافق"],
            dangerMode: true,
            timer: 1000
        })

        bigDataDiscount.push(discount_data);
        $("#discountTable").show();
        var appendDiscount = bigDataDiscount.map(function(discount) {
            return (`
            <tr class="single-product">
                <td class="discount-basic_quantity">${discount.basic_quantity}</td>
                <td class="discount-gift_quantity">${discount.gift_quantity}</td>
              <td>
                <a href="#" data-toggle="modal" class="edit-this-row-discount" data-target="#exampleModal4" data-original-title="تعديل">
                    <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                </a>
                <a href="#" data-toggle="tooltip" class="delete-this-row-discount" data-original-title="حذف">
                    <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                </a>
            </td>
        <input type="hidden" name="basic_quantity[]" value="${discount.basic_quantity}" >
        <input type="hidden" name="gift_quantity[]" value="${discount.gift_quantity}" >
            </tr>
            `);
        });

        $('.add-discounts').empty().append(appendDiscount);
        //////////////////////////////////////////////////////////////////////
        $('.delete-this-row-discount').click(function(e) {
            var $this = $(this);
            var row_index_discount = $(this).parents('tr').index();
            e.preventDefault();
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا  الخصم؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $this.parents('tr').remove();
                    bigDataDiscount.splice(row_index_discount, 1);
                } else {
                    swal("تم االإلفاء", "حذف  الخصم تم الغاؤه", 'info', {
                        buttons: 'موافق'
                    });
                }
            });
        });
        $('.edit-this-row-discount').click(function(e) {
            // alert("dsfs");
            var $this = $(this);


            e.preventDefault();
            $this.parents('tr').addClass('editted-row');
            $('#exampleModal4 #basic_quantity').val($this.parents('tr').find('#basic_quantity').html());
            $('#exampleModal4 #gift_quantity').val($this.parents('tr').find('#gift_quantity').html());
            var row_index_discount = $(this).parents('tr').index();
             bigDataDiscount.splice(row_index_discount,1);
            // alert(bigDataDiscount);
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
