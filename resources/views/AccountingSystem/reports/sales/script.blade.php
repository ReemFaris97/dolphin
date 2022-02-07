<script>
    $(function() {
        $(document).on('change', '#company_id', function() {
            let branchSelect = $('#branch_id');
            let categorySelect = $('#category_id');
            $.ajax({
                url: `{{ url('accounting/ajax/branches') }}/${$(this).val()}`,
                type: "get",
                success(data) {
                    //   console.log(data)
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
                    console.log(error)
                }
            })
            $.ajax({
                url: `{{ url('accounting/ajax/categories') }}/${$(this).val()}`,
                type: "get",
                success(data) {
                    //console.log(data)
                    categorySelect.empty();
                    categorySelect.append('<option value="">اختر القسم</option>');
                    data.forEach(category => {
                        categorySelect.append(`
                                <option value="${category.id}">${category.ar_name}</option>
                            `);
                    });
                    categorySelect.selectpicker('refresh');
                },
                error(error) {
                    console.log(error)
                }
            })

        })


    })
</script>
<script src="{{ asset('admin/assets/js/get_product_from_store_form_company_category.js') }}"></script>
