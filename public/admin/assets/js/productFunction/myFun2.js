function myFun2(event) {
    event.preventDefault();
    var component_data = {};
    component_data.component_name = $('#component_name option:selected').text();
    component_data.component_name_val = $('#component_name').val();
    component_data.component_quantity = $('#component_quantity').val();
    component_data.main_unit = $('#main_unit').val();
    if (component_data.component_name !== '' && component_data.component_quantity !== '' && component_data.main_unit !== '') {
        $("tr.editted-row").remove();
        swal({
            title: "تم إضافة  المكون بنجاح",
            text: "",
            icon: "success",
            buttons: ["موافق"],
            dangerMode: true,
        })

        bigDataComponent.push(component_data);
        $("#componentTable").show();
        var appendComponent = bigDataComponent.map(function(component) {
            return (`
            <tr class="single-product">
                <td class="component-name">${component.component_name}</td>
                <td class="component-qty">${component.component_quantity}</td>
                <td class="component-unit">${component.main_unit}</td>
              <td>
                <a href="#" data-toggle="modal" class="edit-this-row-component" data-target="#exampleModal2" data-original-title="تعديل">
                    <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                </a>
                <a href="#" data-toggle="tooltip" class="delete-this-row-component" data-original-title="حذف">
                    <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                </a>
            </td>
        <input type="hidden" name="component_names[]" value="${component.component_name_val}" >
        <input type="hidden" name="qtys[]" value="${component.component_quantity}" >
        <input type="hidden"name="main_units[]" value="${component.main_unit}" >
            </tr>
            `);
        });
        $('.add-components').empty().append(appendComponent);
        //////////////////////////////////////////////////////////////////////
        $('.delete-this-row-component').click(function(e) {
            var $this = $(this);
            var row_index_component = $(this).parents('tr').index();
            e.preventDefault();
            swal({
                title: "هل أنت متأكد ",
                text: "هل تريد حذف هذا  المكون؟",
                icon: "warning",
                buttons: ["الغاء", "موافق"],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {
                    $this.parents('tr').remove();
                    bigDataComponent.splice(row_index_component, 1);
                } else {
                    swal("تم االإلفاء", "حذف  المكون تم الغاؤه", 'info', {
                        buttons: 'موافق'
                    });
                }
            });
        });
        $('.edit-this-row-component').click(function(e) {
            var $this = $(this);
            e.preventDefault();
            $this.parents('tr').addClass('editted-row');
            $('#exampleModal2 #component_name').val($('.component_name option:selected').text());
            $('#exampleModal2 #component_quantity').val($this.parents('tr').find('.component-qty').html());
            $('#exampleModal2 #main_unit').val($this.parents('tr').find('.component-unit').html());
            var row_index_edit_component = $(this).parents('tr').index();
            bigDataComponent.splice(row_index_edit_component, 1);
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
    } ///if_end
}
