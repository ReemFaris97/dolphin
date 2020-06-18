/*jshint esversion: 6 */

$(function () {
    $(document).on('change', '#company_id', function () {
        let branchSelect = $('#branch_id');
        let storeSelect = $('#store_id');
        var company_id= $(this).val();

        $.ajax({
            url: "/accounting/ajax/branches/" +company_id,
            type: "get",
            success(data) {
                console.log(data);
                branchSelect.empty();
                branchSelect.append('<option value="">اختر الفرع</option>');
                data.forEach(branch => {
                    branchSelect.append(`
         <option value="${branch.id}">${branch.name}</option>
    `);
                });
                branchSelect.selectpicker('refresh');
            },
            error(error) {
                console.log(error);
            }
        });

        $.ajax({
            url:"/accounting/ajax/stores-form-company/" + company_id,
            type: "get",
            success(data) {
                console.log(data)

                storeSelect.empty();
                storeSelect.append('<option value="">اختر المخزن</option>');
                data.forEach(store => {
                    storeSelect.append(`
    <option value="${store.id}">${store.ar_name}</option>
    `);
                });
                storeSelect.selectpicker('refresh');
            },
            error(error) {
                console.log(error);
            }
        });


    });


    $(document).on('change', '#branch_id', function () {
        let storeSelect = $('#store_id');
        let productSelect = $('#product_id');
        var branch_id= $(this).val();
        $.ajax({
            url:"/accounting/ajax/stores/" + branch_id,
            type: "get",
            success(data) {
                console.log(data)

                storeSelect.empty();
                storeSelect.append('<option value="">اختر المخزن</option>');
                data.forEach(store => {
                    storeSelect.append(`
    <option value="${store.id}">${store.ar_name}</option>
    `);
                });
                storeSelect.selectpicker('refresh');
            },
            error(error) {
                console.log(error);
            }
        });

        $.ajax({
            url: "/accounting/ajax/products-store-branch/" + branch_id,
            type: "get",
            success(data) {
                console.log(data)

                productSelect.empty();
                productSelect.append('<option value="">اختر الصنف</option>');
                data.forEach(product => {
                    productSelect.append(`
    <option value="${product.id}">${product.name}</option>
    `);
                });
                productSelect.selectpicker('refresh');
            },
            error(error) {
                console.log(error);
            }
        });
    })


    $(document).on('change', '#store_id', function () {

        let productSelect = $('#product_id');
        var store_id= $(this).val();
        $.ajax({
            url: "/accounting/ajax/products-store/" + store_id,
            type: "get",
            success(data) {
                console.log(data)

                productSelect.empty();
                productSelect.append('<option value="">اختر الصنف</option>');
                data.forEach(product => {
                    productSelect.append(`
    <option value="${product.id}">${product.name}</option>
    `);
                });
                productSelect.selectpicker('refresh');
            },
            error(error) {
                console.log(error);
            }
        });
    });
});
