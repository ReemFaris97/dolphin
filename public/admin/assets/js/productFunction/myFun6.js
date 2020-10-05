var bigDataBarcode = [];
function myFun6(event) {

    event.preventDefault();
    var barcode_data = {};

    barcode_data.barcode = $('#barcode').val();

    if (barcode_data.barcode !== '' ) {
        $("tr.editted-row").remove();
        swal({
            title: "تم إضافة  الباركود بنجاح",
            text: "",
            icon: "success",
            buttons: ["موافق"],
            dangerMode: true,
        })

        bigDataBarcode.push(barcode_data);

        $("#BarcodeTable").show();
        var appendBarcode = bigDataBarcode.map(function(barcode) {
            return (`
            <tr class="single-product">
                <td class="barcode">${barcode.barcode}</td>

              <td>
                <a href="#" data-toggle="modal" class="edit-this-row-barcode" data-target="#exampleModal6" data-original-title="تعديل">
                    <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                </a>
                <a href="#" data-toggle="tooltip" class="delete-this-row-barcode" data-original-title="حذف">
                    <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                </a>
            </td>
        <input type="hidden" name="barcodes[]" value="${barcode.barcode}" >

            </tr>
            `);
        });
        $('.add-Barcodes').empty().append(appendBarcode);
        //////////////////////////////////////////////////////////////////////
        $('.delete-this-row-barcode').click(function(e) {
            var $this = $(this);
            var row_index_barcode= $(this).parents('tr').index();
            e.preventDefault();
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا  الباركود",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $this.parents('tr').remove();
                    bigDataBarcode.splice(row_index_barcode, 1);
                } else {
                    swal("تم االإلفاء", "حذف  الباركود تم الغاؤه", 'info', {
                        buttons: 'موافق'
                    });
                }
            });
        });
        $('.edit-this-row-barcode').click(function(e) {
            var $this = $(this);
            e.preventDefault();
            $this.parents('tr').addClass('editted-row');
            $('#exampleModal6 #barcode').val($this.parents('tr').find('.barcode').html());
            var row_index_edit_barcode = $(this).parents('tr').index();
            bigDataBarcode.splice(row_index_edit_barcode, 1);
        });
        document.getElementById("barcode").val = " ";

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
