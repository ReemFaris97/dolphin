
<script>
    $(function() {
        $(document).on('change', '#company_id', function () {
            let branchSelect = $('#branch_id');
            let categorySelect = $('#category_id');
            $.ajax({
                url: `{{ url('accounting/ajax/branches') }}/${$(this).val()}`,
                type: "get",
                success (data) {
                    //console.log(data)
                    branchSelect.empty();
                    branchSelect.append('<option value="">اختر الفرع</option>');
                    data.forEach( branch => {
                        branchSelect.append(`
                                <option value="${branch.id}">${branch.name}</option>
                            `);
                    });
                    branchSelect.selectpicker('refresh');
                },
                error (error) {
                    console.log(error)
                }
            })
            $.ajax({
                url: `{{ url('accounting/ajax/categories') }}/${$(this).val()}`,
                type: "get",
                success (data) {
                    //console.log(data)
                    categorySelect.empty();
                    categorySelect.append('<option value="">اختر القسم</option>');
                    data.forEach( category => {
                        categorySelect.append(`
                                <option value="${category.id}">${category.ar_name}</option>
                            `);
                    });
                    categorySelect.selectpicker('refresh');
                },
                error (error) {
                    console.log(error)
                }
            })

        })

        $(document).on('change', '#branch_id', function () {
            let userSelect = $('#user_id');
            let cases = $('#safe_id');
            let shifts = $('#shift_id');
            $.ajax({
                url: `{{ url('accounting/ajax/users-by-branches') }}/${$(this).val()}`,
                type: "get",
                success (data) {
                    // console.log(data)
                    userSelect.empty();
                    cases.empty();
                    shifts.empty();
                    userSelect.append('<option value=""> الكاشير </option>');
                    cases.append('<option value="">الخزينة</option>');
                    shifts.append('<option value="">الوردية</option>');
                    data.users.forEach( user => {
                        userSelect.append(`
                            <option value="${user.id}">${user.name}</option>
                        `);
                    });
                    data.safes.forEach( safe => {
                        cases.append(`
                            <option value="${safe.id}">${safe.name}</option>
                        `);
                    });
                    data.shifts.forEach( shift => {
                        shifts.append(`
                            <option value="${shift.id}">${shift.name}</option>
                        `);
                    });
                    userSelect.selectpicker('refresh');
                    cases.selectpicker('refresh');
                    shifts.selectpicker('refresh');
                },
                error (error) {
                    console.log(error)
                }
            })
        })

        $(document).on('change', '#shift_id', function () {
            let sessionSelect = $('#session_id');
            $.ajax({
                url: `{{ url('accounting/ajax/sessions') }}/${$(this).val()}`,
                type: "get",
                success (data) {
                    //console.log(data)
                    sessionSelect.empty();
                    sessionSelect.append('<option value="">الجلسة</option>');
                    data.forEach( session => {
                        sessionSelect.append(`
                            <option value="${session.id}">${session.code}</option>
                        `);
                    });
                    sessionSelect.selectpicker('refresh');
                },
                error (error) {
                    console.log(error)
                }
            })
        })

        $(document).on('change', '#category_id', function () {
            let productSelect = $('#product_id');
            $.ajax({
                url: `{{ url('accounting/ajax/products') }}/${$(this).val()}`,
                type: "get",
                success (data) {
                    //console.log(data)
                    productSelect.empty();
                    productSelect.append('<option value="">الصنف</option>');
                    data.forEach( product => {
                        productSelect.append(`
                            <option value="${product.id}">${product.name}</option>
                        `);
                    });
                    productSelect.selectpicker('refresh');
                },
                error (error) {
                    console.log(error)
                }
            })
        })


    })
</script>
<script src="{{asset('admin/assets/js/get_product_from_store_form_company_category.js')}}"></script>
