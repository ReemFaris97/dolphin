$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $("#form_store_id").on('change', function() {
        var idddd = $(this).val();
        let productSelect = $('#product_id');

        console.log(idddd);


        $.ajax({
            url: "/accounting/products_settlement/" + idddd,
            type: "GET",

        }).done(function (data) {


            console.log(data);
            productSelect.empty();
            productSelect.append('<option disabled selected>اختر الصنف</option>');
            data.forEach(product => {
                productSelect.append(`
         <option value="${product.id}">${product.name}</option>
    `);
            });
        $('.product_id option').prop('selected', false);

            $('.product_id').attr('data-live-search', true);

            productSelect.selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });



        ////////////////////////////////////////////////////////////////////////////////////////////
        var  keepers;
        $.ajax({
            url: "/accounting/keepers_store/" + idddd,
            type: "GET",

        }).done(function (data) {

            keepers = [];
            if (data.length == 0)
                data.push('لا توجد  امناء بهذا المستودع');
            var val;
            keepers.push('<option disabled selected> اختر الامين </option>');
            $.each(data, function (i, n) {
                val = i;

                keepers.push('<option value=' + i + '>' + n + '</option>');
            });
            if (val == 0)
                console.log("dsaasd");
            else

                $('.form_store_id').attr('disabled', false);
            $('.storekeeper_id').attr('data-live-search', true);
            $('.storekeeper_id').attr('placeholder', "اختر الصنف");
            $('#storekeeper_id').find('option').remove().end().append(keepers);
			$('.storekeeper_id option').prop('selected', false);

            $("#storekeeper_id").selectpicker('refresh');

        }).fail(function (error) {
            console.log(error);
        });

    });
});
