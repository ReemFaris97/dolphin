function myFun(event) {
    event.preventDefault();
    var data = {};
    data.par_code = $('#par_code').val();
    data.name = $('#name').val();
    data.main_unit_present = $('#main_unit_present').val();
    data.selling_price = $('#selling_price').val();
    data.purchasing_price = $('#purchasing_price').val();
    data.quantity = $('#quantity').val();
    if (data.name !== '' && data.main_unit_present !== '' && data.selling_price !== '' && data.purchasing_price !== '') {
        $("tr.editted-row").remove();
        swal({
            title: "تم إضافة الوحدة الفرعية بنجاح",
            text: "",
            timer: 1000,
            icon: "success",
            buttons: ["موافق"],
            dangerMode: true,
        })
        bigData.push(data);
        $("#productsTable").show();

        var appendProducts = bigData.map(function(product) {
            return (`
        <tr class="single-product">
            <td class="prod-nam">${product.name}</td>
            <td class="prod-bar">${product.par_code}</td>
            <td class="prod-pre">${product.main_unit_present}</td>
            <td class="prod-spri">${product.selling_price}</td>
            <td class="prod-ppri">${product.purchasing_price}</td>
            <td class="prod-quantity">${product.quantity}</td>
               <td>
                <a href="#" data-toggle="modal" class="edit-this-row" data-target="#exampleModal" data-original-title="تعديل">
                    <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                </a>
                <a href="#" data-toggle="tooltip" class="delete-this-row" data-original-title="حذف">
                    <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                </a>
            </td>
    <input type="hidden" name="name[]" value="${product.name}" >
    <input type="hidden" name="par_codes[]" value="${product.par_code}" >
    <input type="hidden"name="main_unit_present[]" value="${product.main_unit_present}" >
    <input type="hidden" name="selling_price[]" value="${product.selling_price}" >
    <input type="hidden"name="purchasing_price[]"  value="${product.purchasing_price}" >
    <input type="hidden"name="unit_quantities[]"  value="${product.quantity}" >
        </tr>
        `);
        });

        // @if (isset($is_edit))


        // $('.edit-products').html(appendProducts);


        // @else
        $('.add-products').html(appendProducts);
        // @endif

        $('.delete-this-row').click(function(e) {
            var $this = $(this);
            var row_index = $(this).parents('tr').index();
            e.preventDefault();
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذة الوحدة الفرعية ؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $this.parents('tr').remove();
                    bigData.splice(row_index, 1);
                } else {
                    swal("تم االإلفاء", "حذف  الوحدة الفرعية  تم الغاؤه", 'info', {
                        buttons: 'موافق'
                    });
                }
            });
        });
        $('.edit-this-row').click(function(e) {
            var $this = $(this);
            e.preventDefault();
            $this.parents('tr').addClass('editted-row');
            $('#exampleModal #name').val($this.parents('tr').find('.prod-nam').html());
            $('#exampleModal #par_code').val($this.parents('tr').find('.prod-bar').html());
            $('#exampleModal #main_unit_present').val($this.parents('tr').find('.prod-pre').html());
            $('#exampleModal #selling_price').val($this.parents('tr').find('.prod-spri').html());
            $('#exampleModal #purchasing_price').val($this.parents('tr').find('.prod-ppri').html());
            $('#exampleModal #quantity').val($this.parents('tr').find('.prod-quantity').html());
            var row_index_edit = $(this).parents('tr').index();
            bigData.splice(row_index_edit, 1);
        });
        document.getElementById("name").val = " ";

    } else {
        swal({
            title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
            text: "",
            icon: "warning",
            buttons: ["موافق"],
            dangerMode: true,
        })
    }
}
